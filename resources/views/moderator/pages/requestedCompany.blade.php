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
        function getRequestedData(i, startTime, endtTime, email) {
            $.ajax({
                url: `/moderator/requested-company`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'clicked': i,
                    'start_time': startTime,
                    'end_time': endtTime,
                    'email': email
                },
                success: data => {
                    if (data.html.length > 0) {
                        $(".no-data-found").html('')
                        if (i == 0) {
                            $('.requestedCompanyData').html(data.html);
                        } else {
                            $('.requestedCompanyData').append(data.html);
                        }
                        $('.showing_data_value').text(data.showingData);
                        $('.total_data_value').text(data.totalData);

                        if (data.showingData == data.totalData) {
                            $('.pagination-div button').addClass("disable");
                            $('.pagination-div > button').hide();


                        }

                    } else {
                        if (i == 0) {
                            $('.requestedCompanyData').html("");
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

        getRequestedData(0, null, null, null)

        function getMoreData() {
            let numVal = $('.numberValue').text();
            let increasedVal = ++numVal;
            $('.numberValue').text(increasedVal);
            let startTime = $('#datePickerStartTime').val();
            let endtTime = $('#datePickerEndTime').val();
            let email = $('.email-val').val();
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
            if (email === "" || email === null || email === undefined) {
                email = null;
            } else {
                email = email;
            }

            getRequestedData(increasedVal, startTime, endtTime, email)

        }
    </script>
@endsection
