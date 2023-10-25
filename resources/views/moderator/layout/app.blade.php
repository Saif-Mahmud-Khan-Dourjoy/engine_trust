<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/moderator/filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/circle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/count.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/moderator/signedCompany.css') }}">
    <link rel="stylesheet" href="{{ asset('css/moderator/requestedCompany.css') }}">
    <link rel="stylesheet" href="{{ asset('css/moderator/companyAddModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/moderator/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    @yield('style')

    <title>@yield('title')</title>
</head>

<body>

    <div class="main_content">
        @include('partials.moderator.sidebar')
        <div class="content">
            @include('partials.moderator.header')
            @yield('data_layout')
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-2.24.1.min.js"></script>
    <script src="{{ asset('js/moderator/barChart.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $(function() {

            $('input[name="daterange"]').daterangepicker({
                autoUpdateInput: false,
                opens: 'right',
                // locale: {
                //     cancelLabel: 'Clear'
                // }
            }, function(start, end, label) {
                $('.dateRange').val(`${start.format('YY-MM-DD')} - ${end.format('YY-MM-DD')}`)
                $('#datePickerStartTime').val(start.format('YYYY-MM-DD'))
                $('#datePickerEndTime').val(end.format('YYYY-MM-DD'))
                if(window.location.pathname.includes('/moderator/approved-company')){
                getSignedCompanyData(0,start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
              }
              if(window.location.pathname.includes('/moderator/nonapproved-company')){
                getRequestedData(0,start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
              }
            });


        });
    </script>
    <script>
        function modalClose() {
            $("#companyAddModal").modal("hide");
        }
    </script>


    @yield('script')

    @if (Session::has('success'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            toastr.success("{{ Session::get('success') }}");
        </script>
        @php
            Session::forget('success');
        @endphp
    @endif


    @if (Session::has('info'))
        <script>
            toastr.info("{{ Session::get('info') }}");
        </script>
        @php
            Session::forget('info');
        @endphp
    @endif


    @if (Session::has('warning'))
        <script>
            toastr.warning("{{ Session::get('warning') }}");
        </script>
        @php
            Session::forget('warning');
        @endphp
    @endif


    @if (Session::has('error'))
        <script>
            toastr.error("{{ Session::get('error') }}");
        </script>
        @php
            Session::forget('error');
        @endphp
    @endif

    <script>
        window.onload = function() {


            chart();


        };

        function chart() {
            $.ajax({
                url: `/moderator/bar-chart-data`,
                method: 'get',
                dataType: 'json',
                success: data => {
                    console.log(data)
                    var trace1 = {
                        x: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                            'Dec'
                        ],
                        y: data.companyCount,
                        width: [0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2, 0.2],
                        type: 'bar',
                        name: 'new Companies',
                        marker: {
                            color: 'rgb(2,160,252)',
                            opacity: 1,
                        }
                    };
                    


                    var data = [trace1];

                    var layout = {

                        xaxis: {
                            tickfont: {
                                size: 14,
                                color: 'rgb(107, 107, 107)'
                            }
                        },
                        yaxis: {

                            titlefont: {
                                size: 16,
                                color: 'rgb(107, 107, 107)'
                            },
                            tickfont: {
                                size: 14,
                                color: 'rgb(107, 107, 107)'
                            }
                        },
                        title: 'New Companies '+new Date().getFullYear()

                        // barmode: 'group',
                        // bargap: 0.15,
                        // bargroupgap: 0.1
                    };


                    Plotly.newPlot('myDiv', data, layout);



                },
                error: error => {
                    console.log(error)
                }

            });

        }
    </script>

</body>

</html>
