@extends('layouts.app')
@extends('layouts.header')
@extends('layouts.footer')

@section('title')
    CONTACT US
@endsection


@section('content')
<h1>Contacts us</h1>

<p>Phone </p>
<phone>+380(63)123 123 123</phone>

@if( ! session()->has('message'))
<form action="/contacts" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" class="form-control" placeholder="Name" value="{{old('name')}}" name="name" type="text">
    </div>
    <div><strong>{{ $errors->first('name') }}</strong></div>

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" class="form-control" placeholder="Email" value="{{old('email')}}" name="email" type="text">
    </div>
    <div><strong>{{ $errors->first('email') }}</strong></div>

    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control"  rows="7" name="message" id="message">{{old('message')}}</textarea>
        <div><strong>{{ $errors->first('message') }}</strong></div>
    </div>
    

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endif 
@endsection