@extends('moderator.layout.app')
@section('style')
@endsection
@section('data_layout')
    {{-- @include('partials.moderator.filter') --}}

    @include('moderator.components.companyDetailsRequested')



    @include('partials.footer')
@endsection

@section('script')
@endsection
