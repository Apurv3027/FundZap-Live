<?php  
use Illuminate\Support\Facades\Auth;
?>
@section('title','404')
@extends('layouts.errormaster')
@section('content')
<center>
    <div class="row">
        <div class="col-md-12 page-404">
            <div class="number font-green"><h1> 404 </h1></div>
            <div class="details">
                <h1>Oops! You're lost.</h1>
                <p> We can not find the page you're looking for.
            </div>
                    @if(isset(Auth::user()->role_id) && Auth::user()->role_id==config('const.roleSuperAdmin'))
                        <a href="{{route('dashboard')}}" class="btn red btn-outline"> 
                    @elseif(isset(Auth::user()->role_id) && Auth::user()->role_id==config('const.roleCoffeeShopSuperAdmin'))      
                        <a href="{{route('shopdashboard')}}" class="btn red btn-outline"> 
                    @else
                        <a href="{{route('dashboard')}}" class="btn red btn-outline"> 
                    @endif
            
            Return Dashboard </a> 
        </div>
    </div>
</center>

@endsection

