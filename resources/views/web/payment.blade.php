@extends('web.layouts.app')
@section('title', trans('web.look_for_job'))
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')
        <section class="helpCenter text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 data-aos="fade-down">الدفع البنكي</h5>
                        <p data-aos="fade-up">
                            هذا النص هو مثال لنص يمكن ان يستبدل فى نفس المساحة
                        </p>
                    </div>
                </div>
            </div>
        </section>

  <section class="profile margin-div text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 class="second_title second_color text-center" data-aos="fade-in">الدفع البنكي</h5>
                        <div class="signUp gray-form  gray-bg" data-aos="fade-in">
                            <form action="#" method="POST">
                                <div class="inputs-contain">

                                    <div class="userName">
                                        <input type="text" name="name_ar" required>
                                        <label>
                                            <i class="fa fa-user"></i> الإسم بالكامل
                                        </label>
                                    </div>

                                    <div class="userName">
                                        <input type="email" name="name_en" required>
                                        <label>
                                            <i class="fa fa-envelope"></i> البريد الإلكتروني
                                        </label>
                                    </div>

                                    <div class="userName">
                                        <input type="tel" name="name_en" minlength="9" maxlength="11" required>
                                        <label>
                                            <i class="fa fa-phone"></i> الجوال
                                        </label>
                                    </div>

                                    <div class="userName custom-select2">
                                        <select class="custom-input"  required="">
                                            <option selected="" disabled="" value="">اسم البنك</option>
                                            <option value="1">بنك الرياض</option>
                                            <option value="2">بنك الرياض</option>
                                        </select>
                                        <span class="form-icon">
                                            <i class="fa fa-university"></i>
                                        </span>
                                    </div>

                                    <div class="userName">
                                        <input type="number" name="name_ar" min="1" required>
                                        <label>
                                            <i class="fa fa-money-bill-wave-alt"></i> المبلغ
                                        </label>
                                    </div>
                                    <div class="userName custom-file right-custom-file">
                                        <input type="file" id="file-up" required="">
                                        <label for="file-up">
                                            <i class="fa fa-upload"></i> <span>صورة الإيصال</span>
                                        </label>
                                    </div>
                                    <div class="userName">
                                        <textarea style="min-height: 100px;"></textarea>
                                        <label>
                                            <i class="fa fa-file"></i> تفاصيل إضافية
                                        </label>
                                    </div>
                                    <div class="userName img-show">
                                        <img src="#" class="file-upload-image" alt="">
                                    </div>
                                    <button type="submit" class="custom-btn">إرسال</button>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.file-upload-image').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0])

            }
        }
        $(".custom-file input").change(function () {
            var self = $(this).val().replace(/C:\\fakepath\\/i, '');
            $(this).next("label").find("span").text(self);
             $(".img-show").fadeIn();
            readURL(this)
        });
    </script>
@endsection