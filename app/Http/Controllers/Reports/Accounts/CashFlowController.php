<?php

namespace App\Http\Controllers\Reports\Accounts;

use App\BankCash;
use App\Branch;
use App\Exports\CashFlowStatement\BranchWise;
use App\Http\Controllers\AccountsReportController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RoleManageController;
use App\Http\Controllers\TransactionController;
use App\IncomeExpenseHead;
use App\IncomeExpenseType;
use App\Setting;
use App\Transaction;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class CashFlowController extends Controller
{
    public function index()
    {
        return view('admin.accounts-report.cash-flow.index');
    }

    public function branch_wise(Request $request)
    {
        $request->validate([
            'end_from' => 'required',
            'end_to' => 'required',

            'start_from' => 'required',
            'start_to' => 'required',

        ]);

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format').' h:i:s');

        $extra = [
            'current_date_time' => $date,
            'module_name' => 'Cash Flow Statement Branch Wise Report',
            'voucher_type' => 'CASH FLOW STATEMENT',
        ];

        $CashFlowStatementDetails = $this->getCashFlowStatement(
            $request->branch_id,
            $request->start_from,
            $request->start_to,
            $request->end_from,
            $request->end_to

        );

        // Common items

        if ($request->branch_id == 0) {
            $branch_name = 'All Branch';
        } else {
            $branch_name = Branch::find($request->branch_id)->name;
        }

        $start_from = date(config('settings.date_format'), strtotime($request->start_from));
        $start_to = date(config('settings.date_format'), strtotime($request->start_to));

        $end_from = date(config('settings.date_format'), strtotime($request->end_from));
        $end_to = date(config('settings.date_format'), strtotime($request->end_to));

        $search_by = [
            'branch_name' => $branch_name,
            'branch_id' => $request->branch_id,
            'start_from' => $start_from,
            'start_to' => $start_to,

            'end_from' => $end_from,
            'end_to' => $end_to,
        ];

        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.cash-flow.branch-wise.index')
                ->with('particulars', $CashFlowStatementDetails)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {
            $pdf = PDF::loadView('admin.accounts-report.cash-flow.branch-wise.pdf', [
                'particulars' => $CashFlowStatementDetails,
                'extra' => $extra,
                'search_by' => $search_by,
            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'].'_'.$extra['module_name'].'.pdf');
        }

        // Excel Action
        if ($request->action == 'Excel') {
            $BranchWise = new BranchWise([
                'particulars' => $CashFlowStatementDetails,
                'extra' => $extra,
                'search_by' => $search_by,
            ]);

            return Excel::download($BranchWise, $extra['current_date_time'].'_'.$extra['module_name'].'.xlsx');
        }
    }

    /**
     * @param $branch_id
     * @param $start_from
     * @param $start_to
     * @param $end_from
     * @param $end_to
     */
    public function getCashFlowStatement($branch_id, $start_from, $start_to, $end_from, $end_to)
    {

        //Cash Flow Statement

        // A. Cash flow from Operating actives:

        // Profit/(Loss) for the year  ( getProfitOrLoss() )
        //
        // Adjustment for:
        //
        // Depreciation
        //
        // (Increase)/Decrease in Current Assets:
        //
        //
        // Advance, Deposit & Receivable Code ( 103 )
        // Inventories Code ( 101 )
        // Preliminary expense code (121)
        //
        // Increase/(Decrease) in Current Liabilities:
        //
        // Account Payable Code ( 107)
        // Short Term Loan Code ( 110 )
        // Advance Against Sales Code ( 112 )
        // Other Payable Code ( 111 )
        // Advance Receive from Investor Code( 120 )
        //
        // Net Cash used in Operating Actives ( Above Added )
        //
        //
        // B. Cash flow from Investing actives: (Increase) / Decrease
        //
        // Acquisition of Property, Plant & Equipment ( getFixedAssetSchedule() )
        // Net Cash used in Investing Actives ( same Acquisition of Property, Plant & Equipment  )
        //
        //
        // C. Cash flow from Financing actives: Increase / (Decrease)
        //
        // Paid Up Capital  Code( 108 )
        // Share Money Deposit Code ( 113 )
        // Long Term Loan ( 109 )
        //
        // Net Cash used in Finance Actives ( 108 + 113 + 109 )
        //
        // D. Cash inflow/(outflow) from total activities (A+B+C)
        //
        // E. Opening Cash & Bank Balance (
        //  $AccountReportsController->getBankCashBalance(
        //            $transaction_unique_branches,
        //            $start_from,
        //            $start_to,
        //            $end_from,
        //            $end_to )
        //  )
        //
        // F. Closing Cash & Bank Balance (D+E)
        //

        // Unique Branches or single
        $TransactionsController = new TransactionController();
        $transaction_unique_branches = $TransactionsController->getUniqueBranches($branch_id);

        $LedgerTypes = IncomeExpenseType::whereIn('code', [103, 101, 121, 107, 110, 112, 111, 120, 108, 113, 109])
            ->orderBy('code', 'asc')
            ->get();

        $Transactions = new Transaction();

        foreach ($LedgerTypes as $LedgerType) {
            $Types[$LedgerType->code] = $LedgerType;
            $Balance[$LedgerType->code] = $Transactions->getBalanceByIncExpHeadTypeIdBranchesTwoDate(
                $LedgerType->id,
                $transaction_unique_branches,
                $start_from,
                $start_to,
                $end_from,
                $end_to
            );
        }

        // A. Cash flow from Operating actives:

        // Profit/(Loss) for the year

        $ProfitOrLossController = new ProfitAndLossAccountController();
        $profitOrLossForTheYear = $ProfitOrLossController->getProfitOrLoss($branch_id, $start_from, $start_to, $end_from, $end_to);

        $FixedAssetsScheduleController = new FixedAssetScheduleController();
        $FixedAssetsSchedule = $FixedAssetsScheduleController->getFixedAssetSchedule($branch_id, $start_to, $end_to);

        $AccountReportsController = new AccountsReportController();

        $CashAndBankBalance = $AccountReportsController->getBankCashBalance(
            $transaction_unique_branches,
            $start_from,
            $start_to,
            $end_from,
            $end_to);

        $ProfitOrLossForTheYearBalance = [
            'start_balance' => $profitOrLossForTheYear['NetProfitOrLoss']['start_balance'],
            'end_balance' => $profitOrLossForTheYear['NetProfitOrLoss']['end_balance'],
        ];

        $DepreciationBalance = [
            'start_balance' => 0,
            'end_balance' => 0,
        ];

        $AdvanceDepositAndReceivableBalance = [
            'start_balance' => $Balance[103]['balance']['start_balance'],
            'end_balance' => $Balance[103]['balance']['end_balance'],
        ];
        $InventoriesBalance = [
            'start_balance' => $Balance[101]['balance']['start_balance'],
            'end_balance' => $Balance[101]['balance']['end_balance'],
        ];
        $PreliminaryExpenseBalance = [
            'start_balance' => $Balance[121]['balance']['start_balance'],
            'end_balance' => $Balance[121]['balance']['end_balance'],
        ];

        $AccountPayableBalance = [
            'start_balance' => $Balance[107]['balance']['start_balance'],
            'end_balance' => $Balance[107]['balance']['end_balance'],
        ];
        $ShortTermLoanBalance = [
            'start_balance' => $Balance[110]['balance']['start_balance'],
            'end_balance' => $Balance[110]['balance']['end_balance'],
        ];
        $AdvanceAgainstSalesBalance = [
            'start_balance' => $Balance[112]['balance']['start_balance'],
            'end_balance' => $Balance[112]['balance']['end_balance'],
        ];
        $OtherPayableBalance = [
            'start_balance' => $Balance[111]['balance']['start_balance'],
            'end_balance' => $Balance[111]['balance']['end_balance'],
        ];
        $AdvanceReceiveFromInvestorBalance = [
            'start_balance' => $Balance[120]['balance']['start_balance'],
            'end_balance' => $Balance[120]['balance']['end_balance'],
        ];

        $NetCashUsedInOperatingActivesBalance = [
            'start_balance' => $ProfitOrLossForTheYearBalance['start_balance'] + $DepreciationBalance['start_balance'] + $AdvanceDepositAndReceivableBalance['start_balance'] + $InventoriesBalance['start_balance'] + $PreliminaryExpenseBalance['start_balance'] + $AccountPayableBalance['start_balance'] + $ShortTermLoanBalance['start_balance'] + $AdvanceAgainstSalesBalance['start_balance'] + $OtherPayableBalance['start_balance'] + $AdvanceReceiveFromInvestorBalance['start_balance'],
            'end_balance' => $ProfitOrLossForTheYearBalance['end_balance'] + $DepreciationBalance['end_balance'] + $AdvanceDepositAndReceivableBalance['end_balance'] + $InventoriesBalance['end_balance'] + $PreliminaryExpenseBalance['end_balance'] + $AccountPayableBalance['end_balance'] + $ShortTermLoanBalance['end_balance'] + $AdvanceAgainstSalesBalance['end_balance'] + $OtherPayableBalance['end_balance'] + $AdvanceReceiveFromInvestorBalance['end_balance'],
        ];

        $AcquisitionOfPropertyPlantAndEquipmentBalance = [
            'start_balance' => $FixedAssetsSchedule['TotalBalance']['start_balance'],
            'end_balance' => $FixedAssetsSchedule['TotalBalance']['end_balance'],
        ];

        $PaidUpCapitalBalance = [
            'start_balance' => $Balance[108]['balance']['start_balance'],
            'end_balance' => $Balance[108]['balance']['end_balance'],
        ];
        $ShareMoneyDepositBalance = [
            'start_balance' => $Balance[113]['balance']['start_balance'],
            'end_balance' => $Balance[113]['balance']['end_balance'],
        ];
        $LongTermLoanBalance = [
            'start_balance' => $Balance[109]['balance']['start_balance'],
            'end_balance' => $Balance[109]['balance']['end_balance'],
        ];

        $NetCashUsedInFinanceActivesBalance = [
            'start_balance' => $PaidUpCapitalBalance['start_balance'] + $ShareMoneyDepositBalance['start_balance'] + $LongTermLoanBalance['start_balance'],
            'end_balance' => $PaidUpCapitalBalance['end_balance'] + $ShareMoneyDepositBalance['end_balance'] + $LongTermLoanBalance['end_balance'],
        ];

        $TotalActivitiesABCBalance = [
            'start_balance' => $NetCashUsedInOperatingActivesBalance['start_balance'] + $AcquisitionOfPropertyPlantAndEquipmentBalance['start_balance'] + $NetCashUsedInFinanceActivesBalance['start_balance'],
            'end_balance' => $NetCashUsedInOperatingActivesBalance['end_balance'] + $AcquisitionOfPropertyPlantAndEquipmentBalance['end_balance'] + $NetCashUsedInFinanceActivesBalance['end_balance'],
        ];

        $OpeningCashAndBankBalance = [
            'start_balance' => $CashAndBankBalance['balance']['start_balance'],
            'end_balance' => $CashAndBankBalance['balance']['end_balance'],
        ];

        $ClosingCashAndBankBalanceDEBalance = [
            'start_balance' => $TotalActivitiesABCBalance['start_balance'] + $OpeningCashAndBankBalance['start_balance'],
            'end_balance' => $TotalActivitiesABCBalance['end_balance'] + $OpeningCashAndBankBalance['end_balance'],
        ];

        $particulars = [
            'ProfitLossForTheYear' => [
                'name' => 'Profit/(Loss) for the year',
                'code' => 'ProfitLossForTheYear',
                'balance' => $ProfitOrLossForTheYearBalance,
            ],
            'Depreciation' => [
                'name' => 'Depreciation',
                'code' => 'Depreciation',
                'balance' => $DepreciationBalance,
            ],
            'AdvanceDepositAndReceivable' => [
                'name' => $Types[103]->name,
                'code' => 103,
                'balance' => $AdvanceDepositAndReceivableBalance,
            ],
            'Inventories' => [
                'name' => $Types[101]->name,
                'code' => 101,
                'balance' => $InventoriesBalance,
            ],
            'PreliminaryExpense' => [
                'name' => $Types[121]->name,
                'code' => 121,
                'balance' => $PreliminaryExpenseBalance,
            ],

            'AccountPayable' => [
                'name' => $Types[107]->name,
                'code' => 107,
                'balance' => $AccountPayableBalance,
            ],
            'ShortTermLoan' => [
                'name' => $Types[110]->name,
                'code' => 110,
                'balance' => $ShortTermLoanBalance,
            ],
            'AdvanceAgainstSales' => [
                'name' => $Types[112]->name,
                'code' => 112,
                'balance' => $AdvanceAgainstSalesBalance,
            ],
            'OtherPayable' => [
                'name' => $Types[111]->name,
                'code' => 111,
                'balance' => $OtherPayableBalance,
            ],
            'AdvanceReceiveFromInvestor' => [
                'name' => $Types[120]->name,
                'code' => 120,
                'balance' => $AdvanceReceiveFromInvestorBalance,
            ],

            'NetCashUsedInOperatingActives' => [
                'name' => 'Net Cash Used in Operating Actives',
                'code' => 'NetCashUsedInOperatingActives',
                'balance' => $NetCashUsedInOperatingActivesBalance,
            ],

            'AcquisitionOfPropertyPlantAndEquipment' => [
                'name' => 'Acquisition of Property, Plant And Equipment',
                'code' => 'AcquisitionOfPropertyPlantAndEquipment',
                'balance' => $AcquisitionOfPropertyPlantAndEquipmentBalance,
            ],

            'NetCashUsedInInvestingActives' => [
                'name' => 'Net Cash Used in Investing Actives',
                'code' => 'NetCashUsedInInvestingActives',
                'balance' => $AcquisitionOfPropertyPlantAndEquipmentBalance,
            ],

            'PaidUpCapital' => [
                'name' => $Types[108]->name,
                'code' => 108,
                'balance' => $PaidUpCapitalBalance,
            ],
            'ShareMoneyDeposit' => [
                'name' => $Types[113]->name,
                'code' => '113',
                'balance' => $ShareMoneyDepositBalance,
            ],
            'LongTermLoan' => [
                'name' => $Types[109]->name,
                'code' => 109,
                'balance' => $LongTermLoanBalance,
            ],

            'NetCashUsedInFinanceActives' => [
                'name' => 'Net Cash Used in Finance Actives',
                'code' => 'NetCashUsedInFinanceActives',
                'balance' => $NetCashUsedInFinanceActivesBalance,
            ],

            'TotalActivitiesABC' => [
                'name' => 'D. Cash inflow/(outflow) from total activities (A+B+C)',
                'code' => 'TotalActivitiesABC',
                'balance' => $TotalActivitiesABCBalance,
            ],

            'OpeningCashAndBank' => [
                'name' => 'E. Opening Cash & Bank Balance',
                'code' => 'TotalActivities(A+B+C)',
                'balance' => $OpeningCashAndBankBalance,
            ],

            'ClosingCashAndBankBalanceDE' => [
                'name' => 'F. Closing Cash & Bank Balance (D+E)',
                'code' => 'ClosingCashAndBankBalanceDE',
                'balance' => $ClosingCashAndBankBalanceDEBalance,
            ],

        ];

        return $particulars;
    }
}
