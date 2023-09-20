@extends('superAdmin.layout.app')
@section('style')

<link rel="stylesheet" href="{{asset('css/superAdmin/account.css')}}">


@endsection
@section('data_layout')



@include('superAdmin.components.account')

@include('partials.footer')



    
@endsection

@section('script')




    
@endsection
