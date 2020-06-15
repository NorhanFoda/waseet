<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" target="_blank" href="{{route('main')}}">
                    <div class="brand-logo"><img src="{{asset(('admin/app-assets/images/logo/freuchi-logo.png'))}}" alt="logo"/></div>
                    <!--<h2 class="brand-text mb-0">ferrucci</h2>-->
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{route('dashboard')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin_sidebar.dashboard')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('questions.index')}}"><i class="fa fa-question"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.questions')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('sliders.index')}}"><i class="fa fa-arrows"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.sliders')}}</span></a>

            <li class=" nav-item"><a href="{{route('brands.index')}}"><i class="fa fa-shirtsinbulk"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.brands')}}</span></a>

            <li class=" nav-item"><a href="{{route('countries-cities.index')}}"><i class="fa fa-flag"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.countries_cities')}}</span></a>

            <li class=" nav-item"><a href="{{route('categories.index')}}"><i class="fa fa-joomla"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.categories')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('products.index')}}"><i class="fa fa-barcode"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.products')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('stores.index')}}"><i class="fa fa-life-ring"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.stores')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('users.index')}}"><i class="fa fa-user"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.users')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('packages.index')}}"><i class="fa fa-angellist"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.packages')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('subscribers')}}"><i class="fa fa-envelope"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.subscribers')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('contacts.index')}}"><i class="fa fa-phone"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.contacts')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('coupons.index')}}"><i class="fa fa-battery-full"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.coupons')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('orders.index')}}"><i class="fa fa-first-order"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.orders')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('static-pages.index')}}"><i class="fa fa-paper-plane"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.static_pages')}}</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('settings')}}"><i class="fa fa-gear"></i><span class="menu-title" data-i18n="Email">{{trans('admin_sidebar.settings')}}</span></a>
            </li>


        </ul>
    </div>
</div>
<!-- END: Main Menu-->
