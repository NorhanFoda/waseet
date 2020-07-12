<footer>
    <div class="container">
      <div class="row">
        <div class="footer-logo col-lg-2 col-md-6 col-11" data-aos="fade-in">
          <img src="{{asset('web/images/Vector-Smart-Object1.png')}}" alt="" />
        </div>

        <div class="col-lg-3 col-md-6 col-11" data-aos="fade-in">
          <p>
            {!! $set->{'footer_text_'.session('lang')} !!}
          </p>
        </div>

        <div class="col-lg-2 col-md-6 col-11" data-aos="fade-in">
          <ul>
            @foreach($pages as $page)
              <li><a href="#">{{$page->{'name_'.session('lang')} }}</a></li>
            @endforeach
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 col-11" data-aos="fade-in">
          <ul>
            <li>النشرة البريدية</li>
          </ul>

          <h6>قم بالاشتراك الان ليصلك كل جديد</h6>

          <form action="">
            <div class="form-group row">
              <div class="col-sm-12">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label"><button><img
                      src="{{asset('web/images/interface.svg')}}" alt="" /></button></label>
                <input type="email" class="form-control form-control-sm" id="colFormLabel"
                  placeholder="البريد الالكترونى" />
              </div>
            </div>
          </form>

          <div class="social-icons footer-social">
            {{-- @foreach($socials as $social)
              <a href="{{$social->link}}" class="fc"><i class="{{$social->icon}}"></i></a>
            @endforeach --}}

            <a href="#" class="fc"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="tw"><i class="fab fa-twitter"></i></a>
            <a href="#" class="sn"><i class="fab fa-snapchat"></i></a>
            <a href="#" class="nst"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="copyright text-center">
      <p class="text-center">
         {{trans('web.designed')}} <a href="jaadara.com">{{trans('web.jadara')}} </a> . {{trans('web.all_rights')}}
        <i class="far fa-copyright"></i> {{trans('web.reserved_for')}}  <span> {{trans('admin.waseet')}}</span>
      </p>
    </div>
  </footer>