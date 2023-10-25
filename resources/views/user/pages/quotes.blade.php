@extends('user.layout.app')
@section('style')
@endsection
@section('data_layout')
    @include('partials.user.filter')

    @include('user.components.quotes')

    @include('partials.footer')
@endsection

@section('script')
    <script>
        function getData(i, startTime, endtTime) {
            $.ajax({
                url: `/user/user-quotes`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'clicked': i,
                    'start_time': startTime,
                    'end_time': endtTime,
                },
                success: data => {
                    if (data.html.length > 0) {
                        $(".no-data-found").html('')
                        if (i == 0) {
                            $('.QuoteData').html(data.html);
                        } else {
                            $('.QuoteData').append(data.html);
                        }

                        $('.showing_data_value').text(data.showingData);
                        $('.total_data_value').text(data.totalData);

                        if (data.showingData == data.totalData) {
                            $('.pagination-div button').addClass("disable");
                            $('.pagination-div > button').hide();
                            // $(".pagination-div button").attr("disabled","disabled")
                        }

                    } else {
                        if (i == 0) {
                            $('.QuoteData').html("");
                            $(".no-data-found").html('No Data Found')
                            $('.pagination-div').hide();

                        }
                    }
                    console.log(data);
                },
                error: error => {
                    console.log(error)
                }
            });


        }

        getData(0)

        function getMoreData() {
            let numVal = $('.numberValue').text();
            let increasedVal = ++numVal;
            console.log(increasedVal);
            getData(increasedVal)
            $('.numberValue').text(increasedVal);

        }
    </script>
@endsection
