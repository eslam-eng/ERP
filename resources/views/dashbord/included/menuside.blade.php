<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <style>
        li {
            font-size: large;
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
            font-weight: bold;

        }
    </style>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-right image">
                <img src="{{asset('upload/user.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> {{trans('trans.online')}}</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{trans('trans.Dashbord')}}</li>
            <li class="active">
                <a href="{{route('home')}}">
                    <i class="fa fa-dashboard"></i> <span>{{trans('trans.home')}}</span>
                </a>
            </li>
            @if(auth()->user()->hasPermission(['read_employees','read_empproductable','read_acountemployees','read_AttLeave','read_employee_move_report']))
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{trans('trans.employees')}}</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if(auth()->user()->hasPermission('read_employees'))
                        <li><a href="{{route('employee.index')}}"><i class="fa fa-circle-o"></i>{{trans('trans.employees_data')}}</a></li>
                    @endif

                    @if(auth()->user()->hasPermission('read_AttLeave'))
                        <li><a href="{{route('all.AttendanceAndLeave')}}"><i class="fa fa-circle-o"></i> {{trans('trans.AttLeave')}}</a></li>
                    @endif
                    @if(auth()->user()->hasPermission('read_acountemployees'))
                         <li><a href="{{route('expense.index')}}"><i class="fa fa-circle-o"></i>{{trans('trans.acountemployees')}}</a></li>
                    @endif
                    @if(auth()->user()->hasPermission('read_empproductable'))
                          <li><a href="{{route('employeeproductable.index')}}"><i class="fa fa-circle-o"></i>{{trans('trans.empspecial')}}</a></li>
                   @endif
                   @if(auth()->user()->hasPermission('read_employee_move_report'))
                        <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file-archive-o"></i>
                            <span>{{trans('trans.reports')}}</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
{{--                            <li><a href="{{route('fulltime.report.view')}}"><i class="fa fa-area-chart"></i> {{trans('trans.report_attLeave')}}</a></li>--}}
                            <li><a href="{{route('expenses.report')}}"><i class="fa fa-bar-chart-o"></i> {{trans('trans.employee_move_report')}}</a></li>
{{--                            <li><a href="{{route('complete.emp.report')}}"><i class="fa fa-line-chart"></i> {{trans('trans.complete_emp_report')}}</a></li>--}}
                            <li><a href="{{route('emp_peoductableReport')}}"><i class="fa fa-circle-o"></i>{{trans('trans.empspecialreport')}}</a></li>
                        </ul>
                    </li>
                   @endif
                </ul>
            </li>
            @endif

            @if(auth()->user()->hasPermission(['read_customers','read_customerdeal','read_cost_deal_customer','read_customerpaid','read_customerreport']))
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-o"></i> <span>{{trans('trans.customers')}}</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                        <li><a href="{{route('customers.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.customers_data')}}</a></li>
                    @if(auth()->user()->hasPermission('read_customerdeal'))
                            <li><a href="{{route('customer-Deal.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.customerdeal')}}</a></li>
                    @endif


                    @if(auth()->user()->hasPermission('read_cost_deal_customer'))
                            <li><a href="{{route('customer-Deal-order.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.cost_deal_customer')}}</a></li>
                    @endif

                    @if(auth()->user()->hasPermission('read_customerpaid'))
                            <li><a href="{{route('customer-paid.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.customerpaid')}}</a></li>
                    @endif
                    @if(auth()->user()->hasPermission('read_customerreport'))
                        <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file-o"></i> <span>{{trans('trans.reports')}}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('customer.payments.report')}}"><i class="fa fa-circle-o"></i> {{trans('trans.customers_paid_report')}}</a></li>
{{--                            <li><a href="{{route('customer.deal.report')}}"><i class="fa fa-circle-o"></i> {{trans('trans.customers_deal_report')}}</a></li>--}}
                        </ul>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(auth()->user()->hasPermission(['read_suppliers','read_supplier_paid','read_supplierreport']))
                 <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-circle-o"></i> <span>{{trans('trans.suppliers')}}</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(auth()->user()->hasPermission('read_suppliers'))
                        <li><a href="{{route('supplier.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.suppliers_data')}}</a></li>
                   @endif
                    @if(auth()->user()->hasPermission('read_supplier_paid'))
                        <li><a href="{{route('catchreceipt.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.supplier_paid')}}</a></li>
                    @endif
                   @if(auth()->user()->hasPermission('read_supplierreport'))
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file-o"></i> <span>{{trans('trans.reports')}}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('supplier.payments.report')}}"><i class="fa fa-circle-o"></i> {{trans('trans.suppliers_paid_report')}}</a></li>
                            <li><a href="{{route('supplier.full.report')}}"><i class="fa fa-circle-o"></i> {{trans('trans.suppliers_full_report')}}</a></li>
                        </ul>
                    </li>
                   @endif
                </ul>
            </li>
            @endif

            @if(auth()->user()->hasPermission(['read_buypurchase','read_salepurchase']))
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i> <span>{{trans('trans.acounts')}}</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @if(auth()->user()->hasPermission('read_buypurchase'))
                         <li><a href="{{route('purchaseInvoice.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.buypurchase')}}</a></li>
                    @endif
                    @if(auth()->user()->hasPermission('read_salepurchase'))
                         <li><a href="{{route('customersalebill.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.salepurchase')}}</a></li>
                    @endif
                </ul>
            </li>
            @endif

            @if(auth()->user()->hasPermission(['read_store','read_products','read_product_report']))
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-align-center"></i> <span>{{trans('trans.product_category')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if(auth()->user()->hasPermission('read_products'))
                    <li>
                        <a href="{{route('product.index')}}">
                            <i class="fa fa-cube"></i>
                            <span>{{trans('trans.products')}}</span>
                        </a>
                    </li>
                    @endif
                   @if(auth()->user()->hasPermission('read_store'))
                    <li>
                        <a href="{{route('stock.index')}}">
                            <i class="fa fa-home"></i>
                            <span>{{trans('trans.store')}}</span>
                        </a>
                    </li>
                   @endif

                    @if(auth()->user()->hasPermission('read_product_report'))
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-file-o"></i> <span>{{trans('trans.reports')}}</span>
                                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{route('productreport')}}"><i class="fa fa-circle-o"></i> {{trans('trans.product_report')}}</a></li>
                                </ul>
                            </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(auth()->user()->hasPermission('read_product_order'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cubes"></i> <span>{{trans('trans.add_pay_product')}}</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @if(auth()->user()->hasPermission('read_product_order'))
                            <li><a href="{{route('productorder.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.pay_request_product')}}</a></li>
                        @endif
                        @if(auth()->user()->hasPermission('read_product_addrequest'))
                            <li><a href="{{route('productaddrequest.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.product_addrequest')}}</a></li>
                        @endif
                    </ul>
                </li>
            @endif


{{--        @if(auth()->user()->hasPermission('read_product_order'))--}}
{{--                <li>--}}
{{--                <a href="{{route('productOrder')}}">--}}
{{--                    <i class="fa fa-cube"></i>--}}
{{--                    <span>{{trans('trans.product_order')}}</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @endif--}}

            @if(auth()->user()->hasPermission(['read_mony','read_monyreport','read_monyreport']))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i> <span>{{trans('trans.mony')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('Monymove.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.mony_data')}}</a></li>
                    @if(auth()->user()->hasPermission('read_monyreport'))
                        <li><a href="{{route('DailyExpense.index')}}"><i class="fa fa-circle-o"></i> {{trans('trans.dailyexpense')}}</a></li>
                   @endif
                    @if(auth()->user()->hasPermission('read_monyreport'))
                         <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file-o"></i> <span>{{trans('trans.reports')}}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('mony.report')}}"><i class="fa fa-circle-o"></i> {{trans('trans.mony_expense')}}</a></li>
{{--                            <li><a href="{{route('monyreport')}}"><i class="fa fa-circle-o"></i> {{trans('trans.mony_data')}}</a></li>--}}
                        </ul>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(auth()->user()->hasPermission('read_users'))
                <li>
                <a href="{{route('users.index')}}">
                    <i class="fa fa-user-o"></i> <span>{{trans('trans.users')}}</span>
                </a>
            </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
