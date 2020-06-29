<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" target="_blank" href="{{route('admin.home')}}">
                    <div class="brand-logo"><img src="{{asset(('admin/app-assets/images/logo/freuchi-logo.png'))}}" alt="logo"/></div>
                    <!--<h2 class="brand-text mb-0">ferrucci</h2>-->
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" nav-item"><a href="{{route('bag_categories.index')}}"><i class="fa fa-th-large"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.bag_categories')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('bags.index')}}"><i class="fa fa-briefcase"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.bags')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('stages.index')}}"><i class="fa fa-level-up"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.stages')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('materials.index')}}"><i class="fa fa-book"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.materials')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('countries.index')}}"><i class="fa fa-flag"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.countries')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('cities.index')}}"><i class="fa fa-map-marker"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.cities')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('organizations.index')}}"><i class="fa fa-university"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.organizations')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('edu_types.index')}}"><i class="fa fa-th"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.edu_types')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('edu_levels.index')}}"><i class="fa fa-level-up"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.edu_levels')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('online_teachers.index')}}"><i class="fa fa-users"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.online_teachers')}}</span></a></li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
