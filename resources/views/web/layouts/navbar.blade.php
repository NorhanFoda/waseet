<section class="navBar">
    <div class="container">
      <nav class="row">
        <div class="humburger col-lg-3 col-sm-3 col-2">
          <!-- <span></span>
          <span></span>
          <span></span> -->

          <img src="{{asset('web/images/menuicon.png')}}" alt="" />
        </div>

        <div class="logo col-lg-6 col-sm-6 col-8 text-center">
          <a href="index.html">
            <img src="{{asset('web/images/Vector-Smart-Object1.png')}}" alt="" />
            <img src="{{asset('web/images/وسيط-المعلم.png')}}" alt="" />
          </a>
        </div>

        <div class="search col-lg-3 col-sm-3 col-2">
          <!-- <span><i class="fas fa-search fa-2x"></i></span> -->
          <img src="{{asset('web/images/searchicon.png')}}" alt="" />
          <form action="" method="">
            <input type="text" id="search" placeholder="البحث" />
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
        <li><a href="#" data-toggle="modal" data-target="#login-choose">تسجيل الدخول</a></li>
        <li><a href="">البحث عن عمل</a></li>
        <li><a href="">المعلم الخصوصى</a></li>
        <li><a href="">الحقائب التعليمية</a></li>
        <li><a href="">حسابي</a></li>
        <li><a href="">الطلبات</a></li>
        <li><a href="">المحفوظات</a></li>
        <li><a href="">تواصل معنا</a></li>
      </ul>

      <div class="border"></div>

      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div><i class="fas fa-globe"></i> اللغة :</div>
          <div class="lang">اللغة العربية</div>
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#">EN</a>
        </div>
      </div>

      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink2"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="drop-icon">
            <i class="fas fa-globe-americas"></i> الدولة :
          </div>
          <div class="lang">المملكة العربية السعودية</div>
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
          <a class="dropdown-item" href="#">مصر</a>
        </div>
      </div>

      <div class="border"></div>

      <ul class="support">
        <li><a href="aboutUs.html">من نحن</a></li>
        <li><a href="privacy.html">سياسة الخصوصية</a></li>
        <li><a href="terms.html">الشروط و الاحكام</a></li>
        <li><a href="helpCenter.html">مركز المساعدة</a></li>
      </ul>

      <div class="border"></div>

      <ul class="social">
        <li>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </li>
        <li>
          <a href="#"><i class="fab fa-facebook"></i></a>
        </li>
        <li>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </li>
        <li>
          <a href="#"><i class="fab fa-snapchat"></i></a>
        </li>
      </ul>
    </div>
  </section>