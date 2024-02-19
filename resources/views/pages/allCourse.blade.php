@extends('layouts.pages')

@section('content')

<div class="container-fluid px-3 mt-3 mb-3">
    @foreach($data as $item)
    <div class="card" style="width: 25rem;">
        <img class="card-img-top" src="{{$item->course_image}}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{$item->course_type}}</h5>
            <p class="card-text">{{$item->course_description}}</p>

            <form action="{{ route('apply_course') }}" method="post">
                @csrf
                <input type="hidden" name="tenure" value="1">
                <input type="hidden" name="courseid" id="courseid" value="{{ $item->id }}">
                <input type="hidden" name="courseType" value="Maincourse">
                <input type="hidden" name="course_price" value="{{ $item->course_price }}">
                <input type="submit" class="btn btn-primary" value="Buy for ${{ $item->course_price }}">
            </form>
        </div>
    </div>
    @endforeach
</div>

@endsection