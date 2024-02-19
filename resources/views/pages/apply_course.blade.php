@extends('layouts.pages')
@section('title')
Apply Course
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-3 mt-5 mb-5">
        <div class="col-md-6">
            <h2 style="font-weight:700;">ENTER YOUR DETAILS</h2>
            <div class="form">
                <form action="{{route('pay')}}" id="apply_form" method="post">
                    @csrf
                    <input type="hidden" value={{$user['courseDetails']->course_name}}>
                    <div class="form-group">
                        <div class="col-sm-8 col-md-10">
                            <label class="control-label col-sm-2" for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm"
                                value="{{$user['userDetails']->name}}">
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <div class="col-sm-8  col-md-10">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <input type="email" name="email" readonly id="email" class="form-control form-control-sm"
                                value="{{$user['userDetails']->email}}" style="background-color: #e9ecef;opacity: 1;">
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <div class="col-sm-8  col-md-10">
                            <label class="control-label col-sm-2" for="phone">Phone:</label>
                            <input type="number" name="phone" id="phone" class="form-control form-control-sm"
                                value="{{$user['userDetails']->phone}}">
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <div class="col-sm-8  col-md-10">
                            <label class="control-label col-sm-2" for="address">Address:</label>
                            <input name="address" class="form-control" value="{{$user['userDetails']->address}}"></input>
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                        <div class="col-sm-8 col-md-5">
                            <label class="control-label col-sm-2 col-md-4" for="country">Country:</label>
                            <input type="text" id="country" name="country" class="form-control form-control-sm"
                                value="{{$user['userDetails']->country}}">
                        </div>

                        <div class="col-sm-8 col-md-5">
                            <label class="control-label col-sm-2 col-md-4" for="state">State:</label>
                            <input type="text" id="state" name="state" class="form-control form-control-sm"
                                value="{{$user['userDetails']->state}}">
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                        <div class="col-sm-8 col-md-5">
                            <label class="control-label col-sm-2 col-md-4" for="city">City:</label>
                            <input type="text" id="city" name="city" class="form-control form-control-sm"
                                value="{{$user['userDetails']->city}}">
                        </div>
                        <div class="col-sm-8 col-md-5">
                            <label class="control-label col-sm-2 col-md-4" for="zip">Zip:</label>
                            <input type="text" id="zip" name="zip" class="form-control form-control-sm"
                                value="{{$user['userDetails']->zip}}">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-8 col-md-5">
                            <label class="control-label col-sm-2 col-md-6" for="promo_code">Promo Code(optional)</label>
                            <input type="text" id="promo_code" name="promo_code" class="form-control form-control-sm"
                                placeholder="Enter Promo Code">
                        </div>
                        <div class="col-sm-8 col-md-5">
                            <button class="" style="width:100%" id="apply_promo_code">Apply Promo Code</button>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <hr>
                    </div>
                    <div class="row">
                        <p class="col-md-6">Total</p>
                        <p class="col-md-6">${{$user['courseDetails']->course_price}}</p>
                    </div>
                    <div class="mt-3">
                        <input type="checkbox" name="gift" id="gift">
                        Want to gift this to your special one!
                    </div>
                    @if ($user['courseType'] == 'Maincourse')
                    <div class="form-group form-check float-left">
                        <input type="checkbox" class="form-check-input" id="Check1" required="true">
                        <input type="hidden" name="courseType" id="courseType" value="{{ $user['courseType']}}">
                        <input type="hidden" name="courseprice" id="courseprice"
                            value="{{ $user['courseDetails']->course_price }}">
                        <input type="hidden" name="netprice" id="netprice"
                            value="{{ $user['courseDetails']->course_price }}">
                        <input type="hidden" name="courseid" id="courseid" value="{{ $user['courseDetails']->id }}">
                        <input type="hidden" name="planid" value="{{ $user['plan'] }}">
                        <label class="mb-0" class="form-check-label" for="Check1">I Agree with The <a target="_blank"
                                href="">Terms & Conditions</a> & <a target="_blank"
                                href="">Privacy Policy</a></label>
                    </div>
                    @else
                    <div class="form-group form-check float-left">
                        <input type="checkbox" class="form-check-input" id="Check1" required="true">
                        <input type="hidden" name="tenure" value="{{ $user['plan']->tenure }}">
                        <input type="hidden" name="coursename" id="coursename" value="coursename">
                        <input type="hidden" name="courseprice" id="courseprice" value="{{ $user['plan']->amount }}">
                        <input type="hidden" name="netprice" id="netprice" value="{{ $user['plan']->amount }}">
                        <input type="hidden" name="planid" value="{{ $user['plan']->id }}">
                        <input type="hidden" name="courseid" id="courseid" value="{{ $user['courseDetails']->id }}">
                        <label class="mb-0" class="form-check-label" for="Check1">I Agree with The <a target="_blank"
                                href="{{ route('terms_of_use') }}">Terms & Conditions</a> & <a target="_blank"
                                href="{{ route('privacy_policy') }}">Privacy Policy</a></label>
                    </div>
                    @endif
                    <div class="col-md-11 mt-3">
                        <button class="col-md-11" id="buy">Buy the Course</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{asset('assets/apply-course-img.png')}}" alt="apply_course_image" width="100%" height="100%">
        </div>
    </div>
</div>
@endsection