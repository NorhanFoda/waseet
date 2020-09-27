<section class="navBar">
    <div class="container">
      <nav class="row">
        <div class="humburger col-lg-3 col-sm-3 col-2">
          <img src="{{asset('web/images/menuicon.png')}}" alt="" />
        </div>

        <div class="logo col-lg-6 col-sm-6 col-8 text-center">
          <a href="{{route('home')}}">
            <img src="{{asset('web/images/Vector-Smart-Object1.png')}}" alt="" />
            <img src="{{asset('web/images/logo_text.png')}}" alt="" />
          </a>
        </div>

        <div class="search col-lg-3 col-sm-3 col-2">
          <img src="{{asset('web/images/searchicon.png')}}" alt="" />
          <form action="{{route('search')}}" method="POST">
            @csrf
            <input type="text" id="search" name="token" placeholder="{{trans('web.search')}}" />
            <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
          </form>
        </div>
      </nav>
    </div>


    <div class="menu">
      <div style="width: 100%;">
        <span id="menu-close"><img src="{{asset('web/images/close.png')}}" alt="" /></span>
      </div>
      <div class="logo text-center">
        <img src="{{asset('web/images/Vector-Smart-Object2.png')}}" alt="" />
      </div>

      <ul class="links">

        @if(!Auth::check())
          <li><a href="{{route('login.form')}}">{{trans('web.login')}}</a></li>
        @endif

        <li><a href="{{route('home')}}">{{trans('web.home')}}</a></li>

        @if(Auth::check() && auth()->user()->hasRole('admin'))
          <li><a href="{{route('admin.home')}}">{{trans('web.dashboard')}}</a></li>
        @endif

        @if(Auth::check() && auth()->user()->hasRole('organization'))
          <li><a href="{{route('jobs.get_form')}}">{{trans('web.add_job')}}</a></li>
        @endif

        @if(Auth::check() && auth()->user()->hasRole('organization'))
          <li><a href="{{route('jobs.org_jobs')}}">{{trans('web.jobs')}}</a></li>
          <li><a href="{{route('web_seekers.index')}}">{{trans('web.job_seekers')}}</a></li>
        @endif

        @if(Auth::check() && (auth()->user()->hasRole('organization') || auth()->user()->hasRole('job_seeker') || 
          auth()->user()->hasRole('direct_teacher') || auth()->user()->hasRole('online_teacher')))
            <li><a href="{{route('jobs.web_index')}}">{{trans('web.look_for_job')}}</a></li>
        @endif

        @if(Auth::check() && (auth()->user()->hasRole('organization') || auth()->user()->hasRole('student') || 
          auth()->user()->hasRole('direct_teacher') || auth()->user()->hasRole('online_teacher')))
            <li><a href="{{route('teachers.index')}}">{{trans('web.private_teacher')}}</a></li>
        @endif
        <li><a href="{{route('web_bags')}}">{{trans('web.bags')}}</a></li>

        @if(Auth::check())
          <li><a href="{{route('profile.index')}}">{{trans('web.profile')}}</a></li>
          {{-- <li><a href="">{{trans('web.orders')}}</a></li> --}}
          {{-- <li><a href="{{route('saved.index')}}">{{trans('web.saved')}}</a></li> --}}
        @endif
        
        @if(Auth::check())
          <li><a href="{{route('payment.banks')}}">{{trans('web.banks')}}</a></li>
        @endif
        
        <li><a href="{{route('contact_us')}}">{{trans('web.contact_us_nav')}}</a></li>
        @if(Auth::check())
          <li>
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit">{{trans('web.logout')}}</button>
            </form>
          </li>
        @endif
      </ul>

      <div class="border"></div>

      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div><i class="fas fa-globe"></i> {{trans('web.lang')}} :</div>
            <div class="lang"> {{\App::getLocale() == 'ar' ? 'العربية' : 'English'}}</div>
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="{{route('change_locale', 'ar')}}">العربية</a>
          <a class="dropdown-item" href="{{route('change_locale', 'en')}}">English</a>
        </div>
      </div>

      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink2"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="drop-icon">
            <i class="fas fa-globe-americas"></i> {{trans('web.country')}} :
          </div>
          {{-- <div class="lang">المملكة العربية السعودية</div> --}}
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
          @foreach($countries as $country)
            <a class="dropdown-item" href="#">{{$country->{'name_'.session('lang')} }}</a>
          @endforeach
        </div>
      </div>

      <div class="border"></div>

      <ul class="support">
        @foreach ($pages as $page)
        <li><a href="{{route('pages', $page->name_en)}}">{{$page->{'name_'.session('lang')} }}</a></li>
        @endforeach
      </ul>

      <div class="border"></div>

      <ul class="social">
        <li>
          <a href="{{$socials[0]->link}}"><i class="fab fa-facebook"></i></a>
        </li>
        <li>
          <a href="{{$socials[1]->link}}"><i class="fab fa-twitter"></i></a>
        </li>
        <li>
          <a href="{{$socials[2]->link}}"><i class="fab fa-snapchat"></i></a>
        </li>
        <li>
          <a href="{{$socials[3]->link}}"><i class="fab fa-instagram"></i></a>
        </li>
      </ul>
    </div>
  </section>