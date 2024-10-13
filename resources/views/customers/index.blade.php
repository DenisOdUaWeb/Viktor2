@extends('layouts.app')
@extends('layouts.header')
@extends('layouts.footer')

@section('title')
    Customers list
@endsection
    
@section('content')
<!-- LANGUAGES TESTING HERE !!!!!!! -->
<h1>{{__('text.main_title_h1')}} THIS IS A LANGUAGE TEST HERE with __() </h1>
<h1>{{trans_choice('text.subtitle_2', 2)}} THIS IS A LANGUAGE TEST HERE with __() </h1>
<h2>{{trans_choice('text.subtitle_2', 1)}}</h2>
<h2>{{trans_choice('text.our_customer_description', 1)}}</h3>
<h3>{{trans_choice('text.our_customer_description', 2)}}</h3>
{{$username = "Viktor"}} <!-- as we can see its making ECHO automaticaly -->
<h4>{{__('text.user_gretings', ['user' => $username])}} !!!</h4>

<!--END  LANGUAGES TESTING HERE !!!!!!! -->
<h1>Custommers list</h1>
<h2>Only if you loged in like an Admin (admin@admin,com) you can see details, create or delete customers</h2>
<h3>BECAUSE OF CustomerController, route/web, CustomerPolicy</h3>



<div class="row">
    <div class="col-6">
        <ul>
        <?php 
        /*
        foreach($ourCustomers as $customer){
            echo '<li>' .$customer .'</li>';
        }
        */
        ?>

        <!-- POLICY -->
        @can('create', \App\Models\Customer::class)
        <!-- using url helper insted of bellow -->       
        <!-- <a class="nav-link" href="/customers/create">Add New Customer</a> -->
        <a class="" href="{{ url('customers/create') }}">Add New Customer</a>
        @endcan

        @foreach($ourActiveCustomers as $customer)
            <li>{{$customer->name}}<br>(company: {{$customer->company->name}})</li><!--//company is a related method from model but wiyhot () parenthesis -->
        @endforeach
        </ul>
    </div>
    <div class="col-6">
        <ul>
        @foreach($ourInactiveCustomers as $customer)
            <li>{{$customer->name}}<br>(company: {{$customer->company->name}})</li> <!--//company is a related method from model -->
        @endforeach
        </ul>
    </div>
    
</div>


<div class="row">

    @foreach($customers as $customer) 
        
        <div class="col-2">
            {{$customer->id}}
        </div>
        <div class="col-3">
            <!-- using route helper with paramert id insted -->
            <!-- <a href="/customers/{{$customer->id}}">{{$customer->name}}</a> -->
            <!-- href="{{ url('customers.show', $customer->id)}}">{{$customer->name}}</a> -->
            <!-- or for many parametrs we can use array -->

            @can('view', $customer) <!-- IF YOU CAN (ADMIN : <a href=" ") -->

                <!-- this is the ways to use with SLAG // ...path() from the Cutomer MODEL -->
                <a href="{{ $customer->path() }}">{{$customer->name}}</a>
                <!-- this is old version without slug  -->
                <!-- <a href=" route('customers.show', ['customer' => $customer  ])">$customer->name . </a>  {}{}{} -->

            @endcan
            @cannot('view', $customer)
                {{$customer->name}}     <!-- IF YOU CANNOT (not Admin) just text -->
            @endcannot

            <!-- TESTING FRENDLY URLS --> 
            <a href="{{ url('customers.show', ['customer' => $customer]).'-'.$customer->name}}">{{$customer->name}}</a>
            <br>
            <a href="{{ $customer->path() }}">{{$customer->name}}</a>
            <!-- END TESTING FRENDLY URLS -->


        </div>
        <div class="col-3">
            {{$customer->company->name}}
        </div>
        <div class="col-2">
            {{$customer->active ? 'Active1' : 'Inactive'}} <!-- working only if you have 2 options(NOT WORKING CAUSE IN MODEL WE MAKE THIS ATTRIBUTE CHOICING) -->
        </div><!-- its showing only from true side mayby cause returning string (not empty so its true) -->

        <div class="col-2">
            {{$customer->active}} <!-- moderated inside model ( getActiveAttribute($attribute) ) -->
        </div>

    @endforeach
    
    <div class="row">
        <div class="col-12 d-flex justify-content-center" style="max-width:500px;">
            {{ $customers->links() }}
        </div>
    </div>


</div>

@endsection