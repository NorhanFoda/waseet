@extends('web.layouts.register')
@section('title', trans('web.register'))
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')
<div class="background"></div>

  <div class="cardBody">
    <div class="goLogin" data-aos="fade-in">
      <div class="logo">
        <img src="./images/Vector-Smart-Object2.png" alt="" />
      </div>

      <div class="welcome">
        <p>
          مرحبا بك فى <br />
          موقع وسيط المعلم ..!
        </p>
      </div>

      <div class="login-btn">
        <a href="./login.html" class="white-btn">تسجيل الدخول</a>
      </div>
    </div>

    <div class="signUp" data-aos="fade-in">
      <form action="" id="signUp">
        <h5>انشاء حساب</h5>

        <div class="inputs-contain">
          <div class="userName">
            <input type="text" id="username" required />
            <label for="username" id="label">
              <i class="far fa-user"></i> اسم المستخدم
            </label>
          </div>

          <div class="userName">
            <input type="email" id="mail" required />
            <label for="mail">
              <i class="far fa-envelope"></i> البريد الالكترونى
            </label>
          </div>

          <div class="userName">
            <input type="tel" id="mob" required />
            <label for="mob">
              <i class="fa fa-mobile-alt"></i> رقم الجوال
            </label>
          </div>

          <div class="userName">
            <input type="number" id="country" required />
            <label for="country">
              <i class="fa fa-mobile-alt"></i> العمر
            </label>
          </div>

          <div class="userName custom-select2">
            <select class="custom-input">
              <option selected disabled>الصف</option>
              <option>الصف</option>
              <option>الصف</option>
            </select>
            <span class="form-icon">
              <i class="fa fa-list-alt"></i>
            </span>
          </div>

          <div class="userName custom-select2">
            <select class="custom-input">
              <option selected disabled>الدولة</option>
              <option>الدولة</option>
              <option>الدولة</option>
            </select>
            <span class="form-icon">
              <i class="fa fa-map-marker-alt"></i>
            </span>
          </div>

          <div class="userName custom-select2">
            <select class="custom-input">
              <option selected disabled>المدينة</option>
              <option>المدينة</option>
              <option>المدينة</option>
            </select>
            <span class="form-icon">
              <i class="far fa-flag"></i>
            </span>
          </div>
       
          <div class="userName">
            <input type="text"  required />
            <label for="username">
              <i class="far fa-map"></i> العنوان
            </label>
          </div>
          
          <div class="userName">
            <input type="password" id="pass" required />
            <label for="pass">
              <i class="fa fa-lock"></i> كلمة المرور
            </label>
          </div>

          <div class="userName">
            <input type="password" id="confirm" required />
            <label for="confirm">
              <i class="fa fa-lock"></i> تأكيد كلمة المرور
            </label>
          </div>
        </div>

        <div class="submit">
          <button type="submit" class="custom-btn">تسجيل</button>
        </div>
      </form>
    </div>
  </div>
@endsection