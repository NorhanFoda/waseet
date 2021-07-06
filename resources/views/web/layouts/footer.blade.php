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
        
        <div class="download-applications">
<h4> {{trans('web.download_from')}} : ‎</h4>
<a href="https://play.google.com/store/apps/details?id=com.jadara.waseetalmoalem" target="_blank"><img src="{{asset('web/images/app1.png')}}" alt="google play"></a>
             <a href="https://apps.apple.com/app/id1529079030" target="_blank"><img src="{{asset('web/images/app2.png')}}" alt="app store"></a>
        </div>
      </div>

      <div class="col-lg-2 col-md-6 col-11" data-aos="fade-in">
        <ul>
          @foreach($pages as $page)
            <li><a href="{{route('pages', $page->name_en)}}">{{$page->{'name_'.session('lang')} }}</a></li>
          @endforeach
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 col-11" data-aos="fade-in">
        <ul>
          <li>{{trans('web.mailing')}}</li>
        </ul>

        <h6>{{trans('web.subscribe_now')}}</h6>

        <form action="{{route('users.subscribe')}}" method="POST">
          @csrf
          <div class="form-group row">
            <div class="col-sm-12">
              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label"><button><img
                    src="{{asset('web/images/interface.svg')}}" alt="" /></button></label>
              <input type="email" name="email" class="form-control form-control-sm" id="colFormLabel" placeholder="{{trans('web.email')}}" />
            </div>
          </div>
        </form>

        <div class="social-icons footer-social">
            @if(isset($socials[0]) && $socials[0]->appear_in_footer == 1)
                <a href="{{$socials[0]->link}}" class="fc"><i class="fab fa-facebook-f"></i></a>
            @endif
            @if(isset($socials[1]) && $socials[1]->appear_in_footer == 1)
                <a href="{{$socials[1]->link}}" class="tw"><i class="fab fa-twitter"></i></a>
            @endif
            @if(isset($socials[2]) && $socials[2]->appear_in_footer == 1)
                <a href="{{$socials[2]->link}}" class="sn"><i class="fab fa-snapchat"></i></a>
            @endif
            @if(isset($socials[3]) && $socials[3]->appear_in_footer == 1)
                <a href="{{$socials[3]->link}}" class="nst"><i class="fab fa-instagram"></i></a>
            @endif
        </div>

      </div>

    </div>
  </div>

  <div class="copyright text-center">
    <p class="text-center">
        {{trans('web.designed')}} <a href="https://jaadara.com/">{{trans('web.jadara')}} </a> . {{trans('web.all_rights')}}
      <i class="far fa-copyright"></i> {{trans('web.reserved_for')}}  <span> {{trans('admin.waseet')}}</span>
    </p>
  </div>

</footer>