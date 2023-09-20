@extends('user.layout.app')
@section('style')

<link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


@endsection
@section('data_layout')


@include('user.components.profile')

@include('partials.footer')



    
@endsection

@section('script')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"> </script>

<script>
    $(document).ready(function() {
  $('.summernote').summernote({
    height: 200
  });
});
</script>

    
@endsection