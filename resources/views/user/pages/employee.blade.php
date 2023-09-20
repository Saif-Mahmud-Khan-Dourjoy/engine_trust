@extends('user.layout.app')
@section('style')


@endsection
@section('data_layout')


@include('user.components.employee')

@include('partials.footer')
  
@endsection

@section('script')


    <script>
      function modalClose() {
        $("#employeeAddModal").modal("hide");
      }
    </script>



    
@endsection
