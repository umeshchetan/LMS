@extends('layouts.pages')

@section('content')
<div class="container-fluid mt-3 mb-3">
    <h2>Payment Info</h2>
        @if (session('success_msg'))
        <div class="alert alert-success">{{session('success_msg')}}</div>
        @endif
        
        @if (session('error_msg'))
        <div class="alert alert-danger">{{session('error_msg')}}</div>
        @endif
        
<div class="container">
    <form action="{{route("dopay.online")}}" method="post">
        @csrf
        <input type="hidden" value="{{$data['name']}}" name="name" id="name">
        <input type="hidden" value="{{$data['email']}}" name="email" id="email">
        <input type="hidden" value="{{$data['phone']}}" name="phone" id="phone">
        <input type="hidden" value="{{$data['address']}}" name="address" id="address">
        <input type="hidden" value="{{$data['country']}}" name="country" id="country">
        <input type="hidden" value="{{$data['state']}}" name="state" id="state">
        <input type="hidden" value="{{$data['zip']}}" name="zip" id="zip">
        <input type="hidden" value="{{$data['courseType']}}" name="courseType" id="courseType">
        <input type="hidden" value="{{$data['courseid']}}" name="courseid" id="courseid">
        <div class="mb-3 col-md-6">
            <label for="owner" class="form-label">Owner</label>
            <input type="text" name="owner" class="form-control" id="owner" value = {{$data['name']}}>
        </div>
        <div class="mb-3 col-md-6">
            <label for="cvv" class="form-label">CVV</label>
            <input type="number" name="cvv" class="form-control" id="cvv">
        </div>
        <div class="mb-3 col-md-6">
            <label for="card_number" class="form-label">Card number</label>
            <input type="number" name="card_number" class="form-control" id="card_number">
        </div>
        <div class="mb-3 col-md-6">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" class="form-control" style="background-color: #e9ecef;opacity: 1;" readonly id="amount" value={{$data['courseprice']}}>
        </div>
        <div class="mb-3 col-md-6">
            @php
            $months =
            ['1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'July','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec']
            @endphp
            <label for="expiration_month" class="form-label">Expiration month</label>
            <select name="expiration_month" id="expiration_month">
                @foreach ($months as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="expiration_year" class="form-label">Expiration month</label>
            <select name="expiration_year" id="expiration_year">
                @for ($i = date('Y'); $i <= (date('Y') + 15); $i++) <option value="{{$i}}">{{$i}}</option>
                    @endfor
            </select>
        </div>
        <button class="col-md-6">Make Payment</button>
    </form>
</div>
</div>
@endsection