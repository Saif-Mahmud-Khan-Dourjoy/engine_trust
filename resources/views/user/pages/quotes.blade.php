@extends('user.layout.app')
@section('style')
@endsection
@section('data_layout')
    <div class="modal fade" id="carInfoModal" tabindex="-1" aria-labelledby="carInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content carInfo-add-modal">
                <div class="modal-header">
                    <i class="fa-solid fa-xmark cross-btn-add-carInfo"></i>
                </div>
                <div class="modal-body">
                    <div class="carInfo-modal-main-content">
                        <div class="car-info-header-title">Full Vehicle details as according to DVLA</div>
                        <div class="reg-num-div-main">
                            <div class="reg-num-div">
                                Reg: <span class="car_reg_num"></span>
                            </div>
                        </div>

                        <div class="carInfo-modal-input-div">

                            <div class="row">
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Make
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carMake" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Model
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carModel" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Year
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carYear" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Fuel
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carFuel" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Engine Size
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carEngineSize" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Body
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carBody" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Engine Code
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carEngineCode" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Engine Number
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carEngineNumber" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        VIN
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carVIN" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Color
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carColor" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Doors
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carDoors" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Seat Capacity
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carSeatCapacity" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Wheel Plan
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carWheelPlan" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Aspiration
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carAspiration" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Maximum BHP
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carMaximumBHP" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Transmission
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carTransmission" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Combine Transmission
                                    </div>
                                    <div class="input-div">
                                        <input type="text"
                                            class="form-control common-car-input carCombineTransmission" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Wheel Plan Desc
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carWheelPlanDesc" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        CO2
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carCo2" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Gears
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carGears" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Cylinders
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carCylinders" />
                                    </div>

                                </div>
                                <div class="col-sm-6 carInfo-input-col">
                                    <div class="car-info-title">
                                        Valves
                                    </div>
                                    <div class="input-div">
                                        <input type="text" class="form-control common-car-input carValves" />
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        } else {
                            $('.pagination-div button').removeClass("disable");
                            $('.pagination-div > button').show();
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

    <script>
        function getFullInfo(reg_num) {
            $('#loader').show();
            $.ajax({
                url: `/carFullInfo`,
                method: 'GET',
                dataType: 'json',
                data: {
                    'reg_num': reg_num
                },
                success: data => {
                    $('.car_reg_num').html(data.reg_num)
                    if (data.data.Response.StatusCode == "Success") {
                        $('.carMake').val(data.data.Response.DataItems.VehicleRegistration.Make);
                        $('.carModel').val(data.data.Response.DataItems.VehicleRegistration.Model);
                        $('.carYear').val(data.data.Response.DataItems.VehicleRegistration.YearOfManufacture);
                        $('.carFuel').val(data.data.Response.DataItems.VehicleRegistration.FuelType);
                        $('.carEngineSize').val(data.data.Response.DataItems.VehicleRegistration
                            .EngineCapacity);
                        $('.carBody').val(data.data.Response.DataItems.SmmtDetails.BodyStyle);
                        $('.carEngineNumber').val(data.data.Response.DataItems.VehicleRegistration
                            .EngineNumber);
                        $('.carEngineCode').val(data.data.Response.DataItems.TechnicalDetails.General.Engine
                            .Code.CodeList[0].EngineCode);
                        $('.carColor').val(data.data.Response.DataItems.VehicleRegistration.Colour);
                        $('.carDoors').val(data.data.Response.DataItems.SmmtDetails.NumberOfDoors);
                        $('.carSeatCapacity').val(data.data.Response.DataItems.VehicleRegistration
                            .SeatingCapacity);
                        $('.carWheelPlan').val(data.data.Response.DataItems.VehicleRegistration.WheelPlan);
                        $('.carAspiration').val(data.data.Response.DataItems.TechnicalDetails.General.Engine
                            .Aspiration);
                        $('.carMaximumBHP').val(data.data.Response.DataItems.TechnicalDetails.Performance.Power
                            .Bhp);
                        $('.carTransmission').val(data.data.Response.DataItems.SmmtDetails.Transmission);
                        $('.carCombineTransmission').val(data.data.Response.DataItems.SmmtDetails.Transmission);
                        $('.carWheelPlanDesc').val(data.data.Response.DataItems.VehicleRegistration.WheelPlan);
                        $('.carCo2').val(data.data.Response.DataItems.TechnicalDetails.Performance.Co2);
                        $('.carGears').val(data.data.Response.DataItems.SmmtDetails.NumberOfGears);
                        $('.carCylinders').val(data.data.Response.DataItems.TechnicalDetails.General.Engine
                            .NumberOfCylinders);
                        $('.carValves').val(data.data.Response.DataItems.TechnicalDetails.General.Engine
                            .NumberOfCylinders * data.data.Response.DataItems.TechnicalDetails.General
                            .Engine.ValvesPerCylinder);
                        console.log(data.data.Response.DataItems.TechnicalDetails.Performance.Co2)
                    }

                    if (data.success == false || data.data.Response.StatusCode == "KeyInvalid") {
                        $('.carMake').val("No data found");
                        $('.carModel').val("No data found");
                        $('.carYear').val("No data found");
                        $('.carFuel').val("No data found");
                        $('.carEngineSize').val("No data found");
                        $('.carBody').val("No data found");
                        $('.carEngineNumber').val("No data found");
                        $('.carEngineCode').val("No data found");
                        $('.carColor').val("No data found");
                        $('.carDoors').val("No data found");
                        $('.carSeatCapacity').val("No data found");
                        $('.carWheelPlan').val("No data found");
                        $('.carAspiration').val("No data found");
                        $('.carMaximumBHP').val("No data found");
                        $('.carTransmission').val("No data found");
                        $('.carCombineTransmission').val("No data found");
                        $('.carWheelPlanDesc').val("No data found");
                        $('.carCo2').val("No data found");
                        $('.carGears').val("No data found");
                        $('.carCylinders').val("No data found");
                        $('.carValves').val("No data found");
                    }
                    $('#loader').hide();
                    $('#carInfoModal').modal('show')


                },
                error: error => {
                    $('#loader').hide();
                    $('#carInfoModal').modal('show')
                }
            });
        }
    </script>
@endsection
