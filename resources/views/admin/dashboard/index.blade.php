@extends('layouts.app')

@section('title')
    <?php $ApplicationName = Config::get('settings.company_name'); ?>
    {{ $ApplicationName }} -> Dashboard
@stop

   
@section('top-bar')
    @include('includes.top-bar')
@stop

@section('left-sidebar')
    @include('includes.left-sidebar')
@stop



@push('include-js')

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('asset/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('asset/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('asset/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('asset/plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('asset/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('asset/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('asset/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('asset/plugins/flot-charts/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('asset/js/pages/index.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('asset/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>


@endpush


@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>Branch</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{ count(App\Branch::all() ) }}"
                                 data-speed="1000"
                                 data-fresh-interval="0"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>Ledger Type</h4></div>
                            <div class="number count-to" data-from="0"
                                 data-to="{{ count(App\IncomeExpenseType::all()) }}" data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-purple hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>Ledger Group</h4></div>
                            <div class="number count-to" data-from="0"
                                 data-to="{{ count(App\IncomeExpenseGroup::all()) }}" data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>Ledger </h4></div>
                            <div class="number count-to" data-from="0"
                                 data-to="{{ count(App\IncomeExpenseHead::all()) }}" data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-blue-grey hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>Bank Or Cash</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{  count(App\BankCash::all()) }}"
                                 data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>User</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{  count(App\User::all()) }}"
                                 data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-user-lock "></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>Role Manage</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{  count(App\RoleManage::all()) }}"
                                 data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-brown hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>Report</h4></div>
                            <div class="number count-to" data-from="0" data-to="14"
                                 data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>



                <!-- #END# Widgets -->

            </div>




            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Quick Access
                            </h2>
                        </div>
                        <div class="body">
                            <div class="button-demo">
                                <a  href="{{ route('reports.accounts.ledger') }}" type="button" class="btn bg-teal waves-effect">Ledger</a>
                                <a href="{{ route('reports.accounts.trial_balance')  }}" type="button" class="btn bg-green waves-effect">Trial Balance</a>
                                <a href="{{ route('reports.accounts.cost_of_revenue') }}" type="button" class="btn bg-orange waves-effect">Cost Of Revenue </a>
                                <a href="{{ route('reports.accounts.profit_or_loss_account') }}" type="button" class="btn bg-deep-purple waves-effect">Profit Or Loss Account</a>
                                <a href="{{ route('reports.accounts.retained_earnings') }}" type="button" class="btn bg-blue waves-effect">Retained Earnings</a>
                                <a href="{{ route('reports.accounts.fixed_asset_schedule') }}" type="button" class="btn bg-light-green waves-effect">Fixed Asset Schedule</a>
                                <a href="{{ route('reports.accounts.balance_sheet') }}" type="button" class="btn bg-light-blue waves-effect">Balance sheet</a>
                                <a href="{{ route('reports.accounts.cash_flow') }}" type="button" class="btn bg-cyan waves-effect">Cash Flow</a>
                                <a href="{{ route('reports.accounts.receive_payment') }}" type="button" class="btn bg-teal waves-effect">Receive Payment</a>

                                <a href="{{ route('income_expense_type') }}" type="button" class="btn bg-light-green waves-effect">Ledger Type</a>
                                <a href="{{ route('income_expense_group') }}" type="button" class="btn bg-orange waves-effect">Ledger Group</a>



                                <a href="{{ route('dr_voucher') }}" type="button" class="btn bg-lime waves-effect">Debit Voucher</a>
                                <a href="{{ route('cr_voucher') }}" type="button" class="btn bg-brown waves-effect">Credit Voucher</a>
                                <a href="{{ route('jnl_voucher') }}" type="button" class="btn bg-deep-orange waves-effect">Journal Voucher</a>
                                <a href="{{ route('contra_voucher') }}" type="button" class="btn bg-orange waves-effect">Contra Voucher</a>



                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </section>




@stop


@push('include-js')

    {{--<script src="{{ asset('asset/js/pages/ui/modals.js') }}"></script>--}}
    <script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

    <script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>
    <!-- Autosize Plugin Js -->


    <script>
        @if(Session::has('success'))
            toastr["success"]('{{ Session::get('success') }}');
        @endif

                @if(Session::has('error'))
            toastr["error"]('{{ Session::get('error') }}');
        @endif

                @if ($errors->any())
                @foreach ($errors->all() as $error)
            toastr["error"]('{{ $error }}');
        @endforeach
        @endif


    </script>

    {{--All datagrid --}}
    <script src="{{ asset('asset/js/dataTable.js')  }}"></script>
    <script>
        BaseController.init();
    </script>
@endpush

