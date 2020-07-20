@extends('web.layouts.app')
@section('title', trans('web.cart'))
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')

    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down">{{trans('web.cart')}}</h5>
                    <p data-aos="fade-up">{{trans('web.cart_text')}}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="profile margin-div text-right-dir">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="second_title second_color text-center" data-aos="fade-in">عربة التسوق</h5>

                    <!--start edit-list-->
                    <div class="prof-edit-list order-list shipping-list">
                        <ul class="list-unstyled">
                            <!--start product-->
                            @foreach ($carts as $cart)
                                <li class="gray-bg" data-aos="fade-up">
                                    <div class="packsWrap book-details">
                                        <i class="fa fa-times left-icon remove-icon" data-id="{{$cart->id}}"></i>
                                        <div class="pack_img md-center">
                                            <img src="{{$cart->bag->image}}" alt="" />
                                        </div>

                                        <div class="pack-width">
                                            <div class="pack_name">
                                                <p>{{$cart->bag->{'name_'.session('lang')} }}</p>
                                            </div>

                                            <div class="pack_rate">
                                                <form action="">
                                                    @if($cart->bag->ratings->count() > 0)
                                                        <input type="radio" id="st5" name="pack" @if(ceil($cart->bag->ratings->sum('rate') / $cart->bag->ratings->count()) == 5) checked @endif />
                                                        <label for="st5">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st4" name="pack" @if(ceil($cart->bag->ratings->sum('rate') / $cart->bag->ratings->count()) == 4) checked @endif />
                                                        <label for="st4">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st3" name="pack" @if(ceil($cart->bag->ratings->sum('rate') / $cart->bag->ratings->count()) == 3) checked @endif />
                                                        <label for="st3">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st2" name="pack" @if(ceil($cart->bag->ratings->sum('rate') / $cart->bag->ratings->count()) == 2) checked @endif />
                                                        <label for="st2">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st1" name="pack" @if(ceil($cart->bag->ratings->sum('rate') / $cart->bag->ratings->count()) == 1) checked @endif />
                                                        <label for="st1">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
                                                    @else
                                                        <input type="radio" id="st55" name="pack"/>
                                                        <label for="st55">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st44" name="pack"/>
                                                        <label for="st44">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st33" name="pack"/>
                                                        <label for="st33">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st22" name="pack"/>
                                                        <label for="st22">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>

                                                        <input type="radio" id="st11" name="pack"/>
                                                        <label for="st11">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                        </label>
                                                    @endif
                                                </form>
                                            </div>

                                            <div class="det-list first_color">
                                                <div class="second_color">{{$cart->bag->price}} {{trans('admin.sr')}}</div>
                                                <form method="" action="">
                                                    <div class="counter-div">
                                                        <span class="responsive-text">{{trans('web.count')}} : {{$cart->quantity}}</span>
                                                        <div class="inner-inputs">
                                                            <div class="counter">
                                                                <span class="minus" data-id="{{$cart->id}}" data-price="{{$cart->bag->price}}">-</span>
                                                                <input  type="number" id="count_{{$cart->id}}" class="cart-input" min="1" value="{{$cart->quantity}}" />
                                                                <span class="plus" data-id="{{$cart->id}}" data-price="{{$cart->bag->price}}">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="secondary-price first_color">{{trans('web.sub_price')}} :
                                            <span class="second_color prices" id="sub_price_{{$cart->id}}">{{$cart->bag->price * $cart->quantity}} {{trans('admin.sr')}}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <!--end product-->
                        </ul>
                    </div>
                    <!--end edit-->

                <div class="circle-list  first_color">
                    <ul class="list-unstyled shipping-list2">
                        <li>
                            {{trans('web.shipping_fees')}} : <span>{{$shipping_fees}} {{trans('admin.sr')}}</span>
                        </li>

                        <li>
                            {{trans('web.sub_price_total')}} : <span id="sub_price_total"></span>
                        </li>

                        <li>
                            {{trans('web.total')}} : <span id="total"></span>
                        </li>
                    </ul>
                </div>

                <div class="submit col-12 text-center">
                    <a href="{{route('payment.prepare_order')}}" class="custom-btn" data-toggle="modal" data-target="#payment-choose">{{trans('web.continue_pay')}}</a>
                </div>

            </div>
        </div>
    </div>
</section>

    <div class="modal fade" id="payment-choose" tabindex="-1" role="dialog" aria-labelledby="payment-choose" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title first_color">اختر طريقة الدفع</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right-dir">
                    <div class="custom-checkboxes" data-aos="fade-in">
                        <div class="custom-check">
                            <img src="{{asset('web/images/pay-1.png')}}" alt="pay">
                            <input type="radio" name="pay" id="check-1" checked>
                            <label for="check-1">بطاقة فيزا</label>
                        </div>
                        <div class="custom-check">
                            <img src="{{asset('web/images/pay-2.png')}}" alt="pay">
                            <input type="radio" name="pay" id="check-2">
                            <label for="check-2">بطاقة ماستر</label>
                        </div>
                        <div class="custom-check">
                            <img src="{{asset('web/images/pay-3.png')}}" alt="pay">
                            <input type="radio" name="pay" id="check-3">
                            <label for="check-3">بطاقة باي بال</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

            // Calculate Cart total prices on page load
            var sub_price_total = 0;
            var total = 0;
            var fees = parseFloat('{{$shipping_fees}}');
            var carts = '{{$carts}}';

            var prices = $('.prices');
            for(var i = 0; i < prices.length; i++){
                var single_price = parseFloat(prices[i].innerHTML.split(' ')[0]);
                sub_price_total += single_price;
            }
            total = sub_price_total += fees;
            $('#sub_price_total').text(sub_price_total+' {{trans("admin.sr")}}');
            $('#total').text(total+' {{trans("admin.sr")}}');

            // Update data on plus click
            $(".plus").click(function(){
                var input_val = parseInt ($(this).parent().find(".cart-input").val()) + 1;
                $(this).parent().find(".cart-input").val(input_val);

                // Update sub price
                var cart_id = $(this).data('id');
                var price = parseFloat($(this).data('price'));
                price = price * input_val;
                $('#sub_price_'+cart_id).text(price+' {{trans("admin.sr")}}');

                $.ajax({
                    url: "{{route('carts.update')}}",
                    type: "PUT",
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", cart_id: cart_id, total_price: price, quantity: input_val },
                    success: function(data){
                    }
                });

                // Update totals
                var diff = price / input_val;
                sub_price_total += diff;
                total += diff;

                $('#sub_price_total').text(sub_price_total+' {{trans("admin.sr")}}');
                $('#total').text(total+' {{trans("admin.sr")}}');
            });

            // Update data on minus click
            $(".minus").click(function(){
                if ($(this).parent().find(".cart-input").val() > 1){
                    var input_val = parseInt ($(this).parent().find(".cart-input").val()) - 1;
                    $(this).parent().find(".cart-input").val(input_val);

                    // Update sub price
                    var cart_id = $(this).data('id');
                    var price = parseFloat($(this).data('price'));
                    price = price * input_val;
                    $('#sub_price_'+cart_id).text(price+' {{trans("admin.sr")}}');

                    $.ajax({
                        url: "{{route('carts.update')}}",
                        type: "PUT",
                        dataType: 'json',
                        data: {"_token": "{{ csrf_token() }}", cart_id: cart_id, total_price: price, quantity: input_val },
                        success: function(data){
                        }
                    });

                    // Update totals
                    var diff = price / input_val;
                    sub_price_total -= diff;
                    total -= diff;

                    $('#sub_price_total').text(sub_price_total+' {{trans("admin.sr")}}');
                    $('#total').text(total+' {{trans("admin.sr")}}');
                }
                else{}
            });

            // Delete cart
            $('.remove-icon').click(function(){
                var cart_id = $(this).data('id');
                $(this).parent().parent().remove();

                // Update totals
                sub_price_total = 0;
                total = 0;
                var prices = $('.prices');
                for(var i = 0; i < prices.length; i++){
                    var single_price = parseFloat(prices[i].innerHTML.split(' ')[0]);
                    sub_price_total += single_price;
                }
                total = sub_price_total += fees;
                $('#sub_price_total').text(sub_price_total+' {{trans("admin.sr")}}');
                $('#total').text(total+' {{trans("admin.sr")}}');

                $.ajax({
                    url: "{{route('carts.delete')}}",
                    type: "DELETE",
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", cart_id: cart_id},
                    success: function(data){
                    }
                });
            });
        });
    </script>
@endsection