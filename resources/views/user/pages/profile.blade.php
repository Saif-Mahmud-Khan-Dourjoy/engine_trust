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

<script>
  // function payment(){
  //   let payment_checked = $('#payment-terms').is(":checked");

  //   if(payment_checked){
     
  //     let user_id_payment=$('#user_id_payment').val();
  //     let value_payment =$('#value_payment').val();

  //     $.ajax({
  //               url: `/user/stripe`,
  //               method: 'GET',
  //               dataType: 'json',
  //               data: {
  //                   'user_id_payment': user_id_payment,
  //                   'value_payment': value_payment,
  //               },
  //               success: data => {
                    
  //               },
  //               error: error => {
  //                   console.log(error)
  //               }
  //           });


       
      
  //   }else{
  //     toastr.error("Please select our terms and condition");
  //   }
  // }
</script>
<script>
  $(document).ready(function () {
      var form = $('#doPayment');
      var checkbox = $('#payment-terms');

      form.submit(function (event) {
          if (!checkbox.prop('checked')) {
              
              event.preventDefault();
              toastr.error("Please select our terms and condition");
          }
         
      });
  });
</script>

    
@endsection