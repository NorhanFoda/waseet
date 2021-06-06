<section class="slider text-center">
    <div class="container-fluid">
      <div class="row">
        <div class="owl-carousel owl-theme">

          @foreach($sliders as $slider)
            <div class="item" style="background-image: url({{$slider->image ? $slider->image->path : asset('images/seeding/avatar.png')}});">
              <div class="overlay">
                <h4>{{$slider->{'title_'.session('lang')} }}</h4>
                <p>
                  {{$slider->{'body_'.session('lang')} }}
                </p>
                <a href="#"> {{trans('admin.load_more')}} </a>
              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </section>