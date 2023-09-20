@extends('user.layout.app')
@section('style')


@endsection
@section('data_layout')

{{-- @include('partials.user.filter') --}}

 @include('user.components.chart')

@include('user.components.totalCount')



@include('user.components.timeLine')

@include('partials.footer')



    
@endsection

@section('script')




    
@endsection
