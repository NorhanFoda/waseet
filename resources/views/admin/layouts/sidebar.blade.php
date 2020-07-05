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
            <li class=" nav-item"><a href="{{route('direct_teachers.index')}}"><i class="fa fa-users"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.direct_teachers')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('users.index')}}"><i class="fa fa-users"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.users')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('jobs.index')}}"><i class="fa fa-bullhorn"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.jobs')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('nationalities.index')}}"><i class="fa fa-globe"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.nationalities')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('seekers.index')}}"><i class="fa fa-users"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.job_seekers')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('applicants.index')}}"><i class="fa fa-users"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.job_applicants')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('students.index')}}"><i class="fa fa-graduation-cap"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.students')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('methods.index')}}"><i class="fa fa-money"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.payment_methods')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('socials.index')}}"><i class="fa fa-link"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.socials')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('sliders.index')}}"><i class="fa fa-sliders"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.slider')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('cvs.index')}}"><img src="{{asset('admin/images/logo/cv.png')}}" width="20px" height="25px" style="margin: 5px"/><span class="menu-title" data-i18n="Dashboard">{{trans('admin.cvs')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('announces.index')}}"><i class="fa fa-bullhorn"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.announces')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('static_pages.index')}}"><i class="fa fa-thumb-tack"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.static_pages')}}</span></a></li>
            <li class=" nav-item"><a href="{{route('setting.edit')}}"><i class="fa fa-gear"></i><span class="menu-title" data-i18n="Dashboard">{{trans('admin.setting')}}</span></a></li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
