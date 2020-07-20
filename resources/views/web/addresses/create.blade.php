@extends('web.layouts.app')
@section('title', trans('web.addresses'))
@section('description', 'waseet description')
@section('image', asset('/images/logo.png'))

@section('content')

    <section class="helpCenter text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 data-aos="fade-down">{{trans('web.profile')}}</h5>
                    <p data-aos="fade-up">
                        {{trans('web.profile_text')}}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="profile margin-div text-right-dir">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="second_title second_color text-center">{{trans('web.addresses')}}</h5>
                    <div class="gray-bg">


                        <!--start edit-list-->
                        <div class="prof-edit-list shipping-list">
                            <div class="modal-header text-center">
                                <h5 class="modal-title first_color">{{trans('web.add_address')}}</h5>
                            </div>
                            <div class="modal-body text-right-dir">
                                <div class="signUp gray-form aos-init aos-animate" data-aos="fade-in">
                                    <form action="{{route('addresses.store')}}" method="POST">
                                        @csrf
                                        <div class="inputs-contain">
                                            <div class="userName custom-select2">
                                                <select  class="custom-input" name="country_id" id="country_id" required>
                                                    <option selected disabled value="{{null}}">{{trans('web.country')}}</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->{'name_'.session('lang')} }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="form-icon">
                                                    <i class="fa fa-map-marker-alt"></i>
                                                </span>
                                            </div>
            
                                            <div class="userName custom-select2">
                                                <div class="add-address">
                                                    <select  class="custom-input" name="city_id" id="city_id" required>
                                                        <option selected disabled value="{{null}}">{{trans('web.city')}}</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{$city->id}}">{{$city->{'name_'.session('lang')} }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="sub-add-address" data-toggle="modal" data-target="#add-city">
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                </div>
                                                <span class="form-icon">
                                                    <i class="fa fa-map-marker-alt"></i>
                                                </span>
                                            </div>
            
                                            <div class="userName">
                                                <input type="text" name="address" required="">
                                                <label>
                                                    <i class="fa fa-map"></i> {{trans('web.address_details')}}
                                                </label>
                                            </div>
                                            
                                            <div class="userName">
                                                <input type="number" name="postal_code" required="">
                                                <label>
                                                    <i class="fa fa-envelope"></i>{{trans('web.postal_code')}} 
                                                </label>
                                            </div>
            
                                        </div>
                                        <div class="submit">
                                            <button type="submit" class="custom-btn">{{trans('web.add')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end edit-->
                </div>
            </div>
        </div>
    </section>

    {{-- add city modal start --}}
    <div class="modal fade" id="add-city" tabindex="-1" role="dialog" aria-labelledby="add-city" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title first_color">{{trans('web.add_city')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right-dir">
                    <div class="signUp gray-form aos-init aos-animate" data-aos="fade-in">
                        <form action="{{route('addresses.add_city')}}" method="POST">
                            @csrf
                            <div class="inputs-contain">
                                <div class="userName custom-select2">
                                    <select  class="custom-input" name="country_id" required>
                                        <option selected disabled value="{{null}}">{{trans('web.country')}}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->{'name_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>
                                    <span class="form-icon">
                                        <i class="fa fa-map-marker-alt"></i>
                                    </span>
                                </div>

                                <div class="userName">
                                    <input type="text" name="name_ar"  required>
                                    <label>
                                        {{trans('admin.name_ar')}}
                                    </label>
                                </div>

                                <div class="userName">
                                    <input type="text" name="name_en"  required>
                                    <label>
                                        {{trans('admin.name_en')}}
                                    </label>
                                </div>
                            </div>

                            <div class="submit">
                                <button type="submit" class="custom-btn">{{trans('web.add')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- add sity modal end --}}

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            //  Get cities of selected country
            $('#country_id').change(function(){
                $.ajax({
                    url: "{{route('countries.getCities')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", id: $(this).val() },
                    success: function(data){
                        $('#city_id').html(data);
                    }
                });
            });
        });
    </script>
@endsection