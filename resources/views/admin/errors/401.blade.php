<?php  
use Illuminate\Support\Facades\Auth;
?>
@section('title','401')
@extends('layouts.errormaster')

@section('content')

<center>
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12 page-500">
            <div class=" number font-red"><h1> 401 </h1></div>
            <div class=" details">
                <h3>401 Unauthorized</h3>
                <p> Sorry, You are not authorized to access this page.
                    <br/> </p>
                <p>

                   @if(isset(Auth::user()->role_id) && Auth::user()->role_id==config('const.roleSuperAdmin'))
                        <a href="{{route('dashboard')}}" class="btn red btn-outline"> 
                    @elseif(isset(Auth::user()->role_id) && Auth::user()->role_id==config('const.roleCoffeeShopSuperAdmin'))      
                        <a href="{{route('shopdashboard')}}" class="btn red btn-outline"> 
                    @else
                        <a href="{{route('dashboard')}}" class="btn red btn-outline"> 
                    @endif
                    
                    Return Dashboard </a> 
                    <br> </p>
            </div>
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
</center>

@endsection

