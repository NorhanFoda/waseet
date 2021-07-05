<!DOCTYPE html>
<!--
  To change this license header, choose License Headers in Project Properties.
  To change this template file, choose Tools | Templates

  and open the template in the editor.
-->
<html lang="ar">

<head>
    <title>{{trans('web.job_approved')}}</title>
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
            @if($status == 'approved')
                {{trans('web.job_approved_text')}}
                <div style="color:#333; margin: 30px auto 20px; text-align: center;">
                    <div>
                        <a href="{{$link}}">{{trans('web.click_here')}}</a>
                    </div>        
                </div>
            @endif

            @if($status == 'refused')
                {{trans('web.job_refused_text')}}
                <div style="color:#333; margin: 30px auto 20px; text-align: center;">
                    <div>
                        @if(is_object($link))
                            {{trans('web.phone')}}: {{isset($link) && $link != null ? $link->phone : ''}}<br>
                            {{trans('web.email')}}: {{isset($link) && $link != null ? $link->email : ''}}
                        @else
                            {{$link}}
                        @endif
                        
                    </div>        
                </div>
            @endif
        </div>
    </div>
    <!--end mail-->



</body>

</html>