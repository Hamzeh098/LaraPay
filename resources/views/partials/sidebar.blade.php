<!-- Left Sidebar  -->
<div class="right-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label"></li>
                <li><a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-tachometer"></i>
                        <span
                                class="hide-menu">پیشخوان
                        </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('admin.dashboard.index')}}">وضعیت </a></li>
                        <li><a href="{{route('admin.dashboard.statistics')}}">آمار </a></li>
                    </ul>
                </li>
                <li><a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-users"></i><span
                                class="hide-menu">کاربران</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('admin.user.index')}}">لیست کاربران</a></li>
                        <li><a href="{{route('admin.user.create')}}">کاربر جدید</a></li>
                        <li><a href="{{route('admin.user.accounts.index')}}">لیست حساب های کاربران</a></li>
                        <li><a href="{{route('admin.user.accounts.create')}}">ثبت حساب بانکی جدید</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-book"></i><span
                                class="hide-menu">درگاه ها
                                            </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('admin.gateway.index')}}">لیست درگاه ها</a></li>
                        <li><a href="{{route('admin.gateway.create')}}">درگاه جدید</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-book"></i><span
                                class="hide-menu">لیست پلن ها
                                                          </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('admin.gateway.plan.index')}}">لیست پلن ها</a></li>
                        <li><a href="{{route('admin.gateway.plan.create')}}">پلن جدید</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-book"></i><span
                                class="hide-menu">درخواست های واریز
                                                            </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('admin.withdrawal.index')}}">لیست درخواست ها</a></li>
                        <li><a href="{{route('admin.withdrawal.create')}}">ثبت درخواست واریز</a></li>
                    </ul>
                </li>

                <li><a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-book"></i><span
                                               class="hide-menu">گزارش های درگاه
                                                                           </span></a>
                                   <ul aria-expanded="false" class="collapse">
                                       <li><a href="{{route('admin.gateway.report.index')}}">لیست گزارش ها</a></li>
                                   </ul>
                               </li>
                <li><a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-book"></i><span
                                class="hide-menu">نوشته ها
                        </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="ui-alert.html">لیست نوشته ها</a></li>
                        <li><a href="ui-button.html">نوشته جدید</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-tags"></i><span
                                class="hide-menu">دسته بندی ها
                        </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="uc-calender.html">لیست دسته بندی ها</a></li>
                        <li><a href="uc-datamap.html">دسته بندی جدید</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cog"></i><span
                                class="hide-menu">تنظیمات</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="table-bootstrap.html">عمومی</a></li>
                        <li><a href="table-datatable.html">نوشتن</a></li>
                        <li><a href="table-datatable.html">خواندن</a></li>
                        <li><a href="table-datatable.html">کاربران</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>
<!-- End Left Sidebar  -->