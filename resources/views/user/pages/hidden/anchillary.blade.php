@extends('user.layout.app')
@section('style')


@endsection
@section('data_layout')

@include('partials.user.filter')

@include('user.components.hidden.anchillary')

@include('partials.footer')



    
@endsection

@section('script')

<script>
    
    function getData(i) {





        $.ajax({
            url: `/user/user-hidden`,
            method: 'GET',
            dataType: 'json',
            data: {
                'clicked': i,
                'request_part':'Anchillary'
            },
            success: data => {
                if (data.html.length > 0) {
                    $('.HiddenData').append(data.html);
                    $('.showing_data_value').text(data.showingData);
                    $('.total_data_value').text(data.totalData);

                    if (data.showingData == data.totalData) {
                        $('.pagination-div button').addClass("disable");

                        // $(".pagination-div button").attr("disabled","disabled")
                    }
                    // lastCreatedAt = data.lastCreatedAt;
                }
                else{
                    $('.pagination-div').hide();
                }
                console.log(data)
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
