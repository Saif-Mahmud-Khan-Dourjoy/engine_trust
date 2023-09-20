@extends('moderator.layout.app')
@section('style')


@endsection
@section('data_layout')

@include('partials.moderator.filter')

@include('moderator.components.requestedCompanyList')


@include('partials.footer')



    
@endsection

@section('script')

  <script>
  function  getData(i){
    
       
      

       
        $.ajax({
            url: `/moderator/requested-company`,
            method: 'GET',
            dataType: 'json',
            data:{
                'clicked': i
            },
            success: data => {
                if (data.html.length > 0) {
                    $('.requestedCompanyData').append(data.html);
                    $('.showing_data_value').text(data.showingData);
                    $('.total_data_value').text(data.totalData);

                 if(data.showingData == data.totalData){
                    $('.pagination-div button').addClass("disable");

                    // $(".pagination-div button").attr("disabled","disabled")
                 }
                    // lastCreatedAt = data.lastCreatedAt;
                }
                console.log(data)
            },
           error: error => {
            console.log(error)
           }
        });
   
   
    }

  getData(0)  

  function getMoreData(){
   let numVal= $('.numberValue').text();
   let increasedVal = ++numVal;
   console.log(increasedVal);
   getData(increasedVal)
   $('.numberValue').text(increasedVal);

  }

  </script>


    
@endsection