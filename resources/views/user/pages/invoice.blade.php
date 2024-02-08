@extends('user.layout.app')
@section('style')
@endsection
@section('data_layout')


    @include('partials.user.filter')

    @include('user.components.invoice')

    @include('partials.footer')



@endsection

@section('script')
    <script>
        function getInvoiceData(i, invoice_no, car_name) {

            $.ajax({
                url: `/user/user-invoices`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'clicked': i,
                    'invoice_no': invoice_no,
                    'car_name': car_name
                },
                success: data => {
                    console.log(data);
                    if (data.html.length > 0) {
                        $(".no-data-found").html('')
                        if (i == 0) {
                            $('.invoiceData').html(data.html);
                        } else {
                            $('.invoiceData').append(data.html);
                        }

                        $('.showing_data_value').text(data.showingData);
                        $('.total_data_value').text(data.totalData);

                        if (data.showingData == data.totalData) {
                            $('.pagination-div button').addClass("disable");
                            $('.pagination-div > button').hide();
                        }
                        else{
                            $('.pagination-div button').removeClass("disable");
                            $('.pagination-div > button').show();
                        }

                    } else {
                        if (i == 0) {
                            $('.invoiceData').html("");
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

        getInvoiceData(0, null, null)

        function getMoreData() {
            let numVal = $('.numberValue').text();
            let increasedVal = ++numVal;
            $('.numberValue').text(increasedVal);
            let invoice_no = $('.invoice-no-invoice').val();
            let car_name = $('.invoice-no-car').val();
            if (invoice_no === "" || invoice_no === null || invoice_no === undefined) {
                invoice_no = null;
            } else {
                invoice_no = invoice_no;
            }
            if (car_name === "" || car_name === null || car_name === undefined) {
                car_name = null;
            } else {
                car_name = car_name;
            }
           
            getInvoiceData(increasedVal, invoice_no, car_name)

        }
    </script>

   
@endsection
