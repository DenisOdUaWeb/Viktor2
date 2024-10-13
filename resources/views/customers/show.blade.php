@extends('layouts.app')
@extends('layouts.header')
@extends('layouts.footer')

@section('title')
{{$customer->name}} Details <!-- !!!!!!!!!! -->
@endsection
    
@section('content')
<h1>{{$customer->name}} Details</h1> <!-- !!!!!!! -->


<div>
    <!-- <a href="/customers/{{$customer->id}}/edit">Edit</a> -->
    <a href="{{ route('customers.edit', $customer->id) }}">Edit 2</a>
</div>
            <!-- <form action="/customers/{{$customer->id}}" method="POST"> -->
            <form action="{{route('customers.destroy', $customer->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger m-4" type="submit">DELETE</button>
            </form>

<div class="row ">
    <div class="col-12 ">
        <p>Name <strong>{{$customer->name}}</strong></p>
        <p>Email <strong>{{$customer->email}}</strong></p>
        <p>Company <strong>{{$customer->company->name}}</strong></p>
        <p>Status <strong>{{$customer->active}}</strong></p>
    </div>
        <div class="m-4 p-5"></div>
</div>

@if($customer->image)

    <div class="row">
        <div class="col-12"><img src="{{ asset('/storage/' . $customer->image) }}" alt="" class="img-thumbnail"></div>
    </div>

@endif
     



@endsection