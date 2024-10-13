@extends('layouts.app')
@extends('layouts.header')
@extends('layouts.footer')

@section('title')
    Customers list
@endsection
    
@section('content')
<h1>Edit Custommer {{$customer->name}}</h1>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <!-- <form action="/customers/{{$customer->id}}" method="POST"> -->
                <!-- or BElow using the ROUTE URL helper with parametrs -->
            <form enctype="multipart/form-data" action="{{ route('customers.update', ['customer' => $customer])}}" method="POST">
                @csrf
                @method('PATCH')
                @include('customers/form')

                <button class="btn btn-primary m-4" type="submit">Save Changes</button>
                  
            </form>
            <hr>
            
        </div>
    </div>    
</div>




@endsection