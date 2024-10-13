@extends('layouts.app')
@extends('layouts.header')
@extends('layouts.footer')

@section('title')
    Customers list
@endsection
    
@section('content')
<h1>Create new Custommer</h1>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="{{route('customers.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('customers/form')

                <button class="btn btn-primary m-4" type="submit">Submit</button>
                  
            </form>
            <hr>
            
        </div>
    </div>    
</div>




@endsection