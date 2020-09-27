<!DOCTYPE html>
<!--
  To change this license header, choose License Headers in Project Properties.
  To change this template file, choose Tools | Templates

  and open the template in the editor.
-->
<html lang="ar">

<head>
    <title>{{trans('web.bags')}}</title>
    <!--
      Meta tags
      ================
    -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

</head>

<body style="direction: rtl">

    <!--start mail
             ================-->
    <div class="mail-div"
        style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 700px; text-align: center; margin: auto; border: 1px solid #e2e0e0">
        <div class="mail-content"
            style="color:#fff;background: #333; line-height:30px; font-size: 20px; padding: 20px 30px">
            {{trans('api.wasset_website')}}
        </div>
        <div
            style="background: #f6f6f6; z-index: 5; font-size: 14px; line-height: 24px; color: #333; position: relative; padding:  20px; text-align: center;">
            <h3 style="margin-bottom: 10px;font-size: 17px; text-align:center"> {{trans('api.dear_cient')}} </h3>
            {{trans('web.bag_contents')}}
            <div style="color:#333; margin: 30px auto 20px; text-align: center;">
                @foreach($bags as $bag)

                    <div>
                        <h2  style="text-align:center">{{$bag->{'name_'.session('lang')} }}</h2>
                        <img src="{{$bag->image}}" alt="">
                        <p  style="text-align:center">{{$bag->{'description_'.session('lang')} }}</p>
                        <video width="100%" height="290" poster="{{$bag->poster}}" controls>
                            <source src="{{$bag->video}}" type="video/mp4">
                            <source src="{{$bag->video}}" type="video/ogg">
                            <source src="{{$bag->video}}" type="video/webm">
                        </video>
                    </div>

                    <div>
                        <h3 style="text-align:center">{{trans('web.contents')}} :</h3>
                    </div>

                    <div>
                        @if($bag->videos->count() > 0)
                            <h4>
                                {{trans('web.videos')}} : 
                            </h4>
                            @foreach($bag->videos as $video)
                                <a href="{{$video->path}}">{{trans('web.click_here')}}</a>
                            @endforeach
                        @endif

                        @if($bag->images->count() > 0)
                            <h4>
                                {{trans('web.images')}} : 
                            </h4>
                            @foreach($bag->images as $image)
                                <a href="{{$image->path}}">{{trans('web.click_here')}}</a>
                            @endforeach
                        @endif

                        @if($bag->documents->count() > 0)
                            <h4>
                                {{trans('web.documents')}} : 
                            </h4>
                            @foreach($bag->documents as $pdf)
                                <a href="{{$pdf->path}}">{{trans('web.click_here')}}</a>
                            @endforeach
                        @endif
                    </div>
                @endforeach            
            </div>
        </div>
    </div>
    <!--end mail-->



</body>

</html>