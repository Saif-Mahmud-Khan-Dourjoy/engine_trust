@extends('moderator.layout.app')
@section('style')


@endsection
@section('data_layout')

@include('partials.moderator.filter')

@include('moderator.components.companyList')


@include('partials.footer')



    
@endsection

@section('script')

  <script>
  function  getSignedCompanyData(i, startTime, endtTime){
        $.ajax({
            url: `/moderator/signed-company`,
            method: 'GET',
            dataType: 'json',
            data:{
                'clicked': i,
                'start_time': startTime,
                    'end_time': endtTime,
            },
            success: data => {
                if (data.html.length > 0) {
                    $(".no-data-found").html('')
                        if (i == 0) {
                            $('.signedCompanyData').html(data.html);
                        } else {
                            $('.signedCompanyData').append(data.html);
                        }
                    $('.showing_data_value').text(data.showingData);
                    $('.total_data_value').text(data.totalData);

                 if(data.showingData == data.totalData){
                    $('.pagination-div button').addClass("disable");
                    $('.pagination-div > button').hide();
                 }
                    
                }
                else{
                    if (i == 0) {
                            $('.signedCompanyData').html("");
                            $(".no-data-found").html('No Data Found')
                            $('.pagination-div').hide();

                        }
                }
                console.log(data)
            },
           error: error => {
            console.log(error)
           }
        });
   
   
    }

  getSignedCompanyData(0,null,null)  

  function getMoreData(){
    let numVal = $('.numberValue').text();
            let increasedVal = ++numVal;
            $('.numberValue').text(increasedVal);
            let startTime = $('#datePickerStartTime').val();
            let endtTime = $('#datePickerEndTime').val();
            if (startTime === "" || startTime === null || startTime === undefined) {
                startTime = null;
            } else {
                startTime = startTime;
            }
            if (endtTime === "" || endtTime === null || endtTime === undefined) {
                endtTime = null;
            } else {
                endtTime = endtTime;
            }

            getSignedCompanyData(increasedVal, startTime, endtTime)

  }

  </script>


    
@endsection