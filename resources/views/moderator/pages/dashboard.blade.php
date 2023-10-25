@extends('moderator.layout.app')
@section('style')


@endsection
@section('data_layout')

{{-- @include('partials.moderator.filter') --}}

@include('moderator.components.chart')

@include('moderator.components.totalCount')

@include('moderator.components.timeLine')

@include('partials.footer')



    
@endsection

@section('script')




    
@endsection
