@extends('superAdmin.layout.app')
@section('style')
@endsection
@section('data_layout')
    @include('partials.superAdmin.filter')

    @include('superAdmin.components.companyList')



    @include('partials.footer')
@endsection

@section('script')
    <script>
        function getCompanyData(i,startTime, endtTime) {
            $.ajax({
                url: `/superAdmin/registed-company`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'clicked': i,
                    'start_time': startTime,
                    'end_time': endtTime,
                },
                success: data => {
                    if (data.html.length > 0) {
                        $(".no-data-found").html('');
                        if (i == 0) {
                            $('.CompanyData').html(data.html);
                        } else {
                            $('.CompanyData').append(data.html);
                        } 
                        $('.showing_data_value').text(data.showingData);
                        $('.total_data_value').text(data.totalData);

                        if (data.showingData == data.totalData) {
                            $('.pagination-div button').addClass("disable");
                            $('.pagination-div > button').hide();
                        }
                        
                    }
                    else{
                        if (i == 0) {  
                            $('.CompanyData').html("");      
                            $(".no-data-found").html('No Data Found')
                            $('.pagination-div').hide();
                        }
                }
                    
                },
                error: error => {
                    console.log(error)
                }
            });


        }

        getCompanyData(0,null,null)

        function getMoreData() {
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
          
            getCompanyData(increasedVal, startTime, endtTime)  

        }
    </script>
@endsection
