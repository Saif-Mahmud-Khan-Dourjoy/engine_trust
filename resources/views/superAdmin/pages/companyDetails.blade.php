@extends('superAdmin.layout.app')
@section('style')

<link rel="stylesheet" href="{{asset('css/superAdmin/companyDetails.css')}}">


@endsection
@section('data_layout')



@include('superAdmin.components.companyDetails')

@include('partials.footer')



    
@endsection

@section('script')




    
@endsection
