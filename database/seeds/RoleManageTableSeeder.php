<?php

use Illuminate\Database\Seeder;

class RoleManageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\RoleManage::create([
            'name' => 'Super Admin',
            'content' => '{"User":["User ",1,1,1,1,1,1,1,1,1],"RoleManager":["Role Manager",1,1,1,1,1,1,1,1,1],"Settings":["Settings",1,1,1,1,1,1,1,1,1],"Branch":["Branch",1,1,1,1,1,1,1,1,1],"LedgerType":["Ledger Type",1,1,1,1,1,1,1,1,1],"LedgerGroup":["Ledger Group",1,1,1,1,1,1,1,1,1],"LedgerName":["Ledger Name",1,1,1,1,1,1,1,1,1],"BankCash":["Bank Cash",1,1,1,1,1,1,1,1,1],"InitialIncomeExpenseHeadBalance":["Initial Income Expense Head Balance",1,1,1,1,1,1,1,1,1],"InitialBankCashBalance":["Initial Bank Cash Balance",1,1,1,1,1,1,1,1,1],"DrVoucher":["Dr Voucher",1,1,1,1,1,1,1,1,1],"CrVoucher":["Cr Voucher",1,1,1,1,1,1,1,1,1],"JnlVoucher":["Jnl Voucher",1,1,1,1,1,1,1,1,1],"ContraVoucher":["Contra Voucher",1,1,1,1,1,1,1,1,1],"Ledger":["Ledger",1,1,1,1,1,1,1,1,1],"TrialBalance":["Trial Balance",1,1,1,1,1,1,1,1,1],"CostOfRevenue":["Cost Of Revenue",1,1,1,1,1,1,1,1,1],"ProfitOrLossAccount":["Profit Or Loss Account",1,1,1,1,1,1,1,1,1],"RetainedEarning":["Retained Earning",1,1,1,1,1,1,1,1,1],"FixedAssetsSchedule":["Fixed Assets Schedule",1,1,1,1,1,1,1,1,1],"StatementOfFinancialPosition":["Statement Of Financial Position",1,1,1,1,1,1,1,1,1],"CashFlow":["Cash Flow",1,1,1,1,1,1,1,1,1],"ReceiveAndPayment":["Receive And Payment",1,1,1,1,1,1,1,1,1],"Notes":["Notes",1,1,1,1,1,1,1,1,1],"GeneralBranch":["General Branch Report",1,1,1,1,1,1,1,1,1],"GeneralLedger":["General Ledger Report",1,1,1,1,1,1,1,1,1],"GeneralBankCash":["General Bank Cash Report",1,1,1,1,1,1,1,1,1],"GeneralVoucher":["General Voucher Report",1,1,1,1,1,1,1,1,1]}',
            'create_by' => 'admin@gmail.com',
        ]);

        /*
        App\RoleManage::create([
            'name'=>'Admin',
            'content'=>'[["User ","on","on","on","on","on","on","on","on","on"],["Role Manager","on","on","on","on","on","on","on","on","on"],["Settings","on","on","on","on","on","on","on","on","on"],["Branch","on","on","on","on","on","on","on","on","on"],["Income Expense Type","on","on","on","on","on","on","on","on","on"],["Income Expense Head","on","on","on","on","on","on","on","on","on"],["Bank Cash","on","on","on","on","on","on","on","on","on"],["Initial Income Expense Head Balance","on","on","on","on","on","on","on","on","on"],["Initial Bank Cash Balance","on","on","on","on","on","on","on","on","on"],["Dr Voucher","on","on","on","on","on","on","on","on","on"],["Cr Voucher","on","on","on","on","on","on","on","on","on"],["Jnl Voucher","on","on","on","on","on","on","on","on","on"],["Contra Voucher","on","on","on","on","on","on","on","on","on"]]'
            'create_by'=>'admin@gmail.com',
        ]);

        App\RoleManage::create([
            'name'=>'User Manager',
            'content'=>'[["User ","on","on","on","on","on","on","on","on","off"],["Role Manager","off","off","off","off","off","off","off","off","off"],["Settings","off","off","off","off","off","off","off","off","off"]]',
            'create_by'=>'admin@gmail.com',
        ]);
        App\RoleManage::create([
            'name'=>'Role Manager',
            'content'=>'{"User":["User ",1,0,0,0,0,0,0,0,0],"RoleManager":["Role Manager",0,1,0,0,0,0,0,0,0],"Settings":["Settings",0,0,1,0,0,0,0,0,0],"Branch":["Branch",0,0,0,0,1,0,0,0,0],"LedgerType":["Ledger Type",0,0,0,1,0,0,0,0,0],"LedgerGroup":["Ledger Group",0,0,0,0,1,0,0,0,0],"LedgerName":["Ledger Name",0,0,0,1,0,0,0,0,0],"BankCash":["Bank Cash",0,0,0,0,1,0,0,0,0],"InitialIncomeExpenseHeadBalance":["Initial Income Expense Head Balance",0,0,0,1,0,0,0,0,0],"InitialBankCashBalance":["Initial Bank Cash Balance",0,0,0,0,1,0,0,0,0],"DrVoucher":["Dr Voucher",0,0,0,1,0,0,0,0,0],"CrVoucher":["Cr Voucher",0,0,0,0,1,0,0,0,0],"JnlVoucher":["Jnl Voucher",0,0,0,1,0,0,0,0,0],"ContraVoucher":["Contra Voucher",0,0,0,1,0,0,0,0,0]}'
        'create_by'=>'admin@gmail.com',
        ]);
        App\RoleManage::create([
            'name'=>'Setting Manager',
            'content'=>'[["User ","off","off","off","off","off","off","off","off","off"],["Role Manager","off","off","off","off","off","off","off","off","off"],["Settings","on","on","on","on","on","on","on","on","off"]]',
            'create_by'=>'admin@gmail.com',
        ]);*/

    }
}
