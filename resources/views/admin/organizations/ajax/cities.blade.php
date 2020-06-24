@foreach($cities as $city)
    <option value="{{$city->id}}">{{$city->{'name_'.session('lang')} }}</option>
@endforeach