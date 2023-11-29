
//Enquiry
function toggleActionEnquiry(event) {
    $(event.target).next().toggleClass('display-toggle-enquiry');
}

function hideEnquiry(id) {

    $.ajax({
        url: `/user/sample-quote`,
        method: 'POST',
        dataType: 'json',
        data: {
            'id': id,

        },
        success: data => {
            if (data.success) {
                toastr.success(data.msg);
                window.location.reload();
            }


        },
        error: error => {
            console.log(error)
        }

    });
    console.log(id)
}
function deleteEnquiry(id) {
    $.ajax({
        url: `/user/delete-enquery`,
        method: 'GET',
        dataType: 'json',
        data: {
            'id': [id],

        },
        success: data => {
            if (data.success) {
                toastr.success(data.msg);
                window.location.reload();
            }


        },
        error: error => {
            console.log(error)
        }

    });
    console.log(id)
}

//Hidden quote
function toggleActionHidden(event) {
    $(event.target).next().toggleClass('display-toggle-hidden');
}

function recreateHidden(id) {
    $.ajax({
        url: `/user/view-quote`,
        method: 'GET',
        dataType: 'json',
        data: {
            'id': id,
        },
        success: data => {
            if (data.success) {
                console.log(data.data)
                $('#enquiry_person_full_name').val(data.data.quote.enquiry.query_user_fullname)
                $('#enquiry_person_number').val(data.data.quote.enquiry.query_user_phone)
                $('#enquiry_person_email').val(data.data.quote.enquiry.query_user_email)
                $('#enquiry_person_address').val(data.data.quote.enquiry.address)
                $('#enquiry_id').val(data.data.quote.enquiry_id)
                $('#quote_id').val(data.data.quote.id)
                $('.ref_num').html(data.data.quote.enquiry.ref_no)
                $('.auto-generated-id').html(data.data.quote.enquiry.reg_num)

                $('.engine-cost').val(data.data.quote.engines);
                $('.exchange-surcharge-cost').val(data.data.quote.exchange_surcharge);
                $('.delivery-cost').val(data.data.quote.delivery_charges);
                $('.recovery-cost').val(data.data.quote.recovery);
                $('.fitting-cost').val(data.data.quote.fitting);
                $('.vat-cost').val(data.data.quote.vat);

                $('.warranty-value-select').val(data.data.quote.warranty);
                $('.condition-value-select').val(data.data.quote.condition);
                $('.mileage-value-select').val(data.data.quote.mileage);
                $('.total_price').html(data.data.quote.invoice.total_price);
                $('.send-quote-btn').css({ 'display': 'none' });
                $('.update-quote-btn').css({ 'display': 'block' });

                //need some invoice data//

                let total_price_after_vat = data.data.quote.invoice.total_price;
                $.ajax({
                    url: `/user/get-quote-price`,
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        'enquiry_id': Number(data.data.quote.enquiry_id),

                    },
                    success: data => {
                        console.log(data);
                        if (data.data.length <= 0) {
                            $('.price-color').css("color", "#60BC71");
                        } else {
                            let price = 0;
                            for (let i = 0; i < data.data.length; i++) {
                                let cost = Number(data.data[i].invoice.total_price);
                                price += cost;

                            }
                            let avg_price = price / data.data.length;
                            if (total_price_after_vat > avg_price + 10) {
                                $('.price-color').css("color", "#FFC700");

                            } else if (total_price_after_vat < avg_price - 10) {
                                $('.price-color').css("color", "#FF4444");

                            } else {
                                $('.price-color').css("color", "#60BC71");

                            }
                        }



                    },
                    error: error => {
                        console.log(error)
                    }

                });





                $('#quoteModal').modal('show')

            }


        },
        error: error => {
            console.log(error)
        }

    });
}
function deleteHidden(id) {
    $.ajax({
        url: `/user/delete-quote`,
        method: 'GET',
        dataType: 'json',
        data: {
            'id': [id],

        },
        success: data => {
            if (data.success) {
                toastr.success(data.msg);
                window.location.reload();
            }


        },
        error: error => {
            console.log(error)
        }

    });
}

//Job quote
function toggleActionJob(event) {
    $(event.target).next().toggleClass('display-toggle-job');
}

function viewJob(id) {
    $.ajax({
        url: `/user/view-quote`,
        method: 'GET',
        dataType: 'json',
        data: {
            'id': id,

        },
        success: data => {
            if (data.success) {
                console.log(data.data)
                $('.modal-title').html('Your Quote');

                $('#enquiry_person_full_name').val(data.data.quote.enquiry.query_user_fullname)
                $('#enquiry_person_number').val(data.data.quote.enquiry.query_user_phone)
                $('#enquiry_person_email').val(data.data.quote.enquiry.query_user_email)
                $('#enquiry_person_address').val(data.data.quote.enquiry.address)
                $('#enquiry_id').val(data.data.quote.enquiry_id)
                $('.ref_num').html(data.data.quote.enquiry.ref_no)
                $('.auto-generated-id').html(data.data.quote.enquiry.reg_num)

                $('.engine-cost').val(data.data.quote.engines);
                $('.engine-cost').attr('disabled', 'disabled');
                $('.exchange-surcharge-cost').val(data.data.quote.exchange_surcharge);
                $('.exchange-surcharge-cost').attr('disabled', 'disabled');
                $('.delivery-cost').val(data.data.quote.delivery_charges);
                $('.delivery-cost').attr('disabled', 'disabled');
                $('.recovery-cost').val(data.data.quote.recovery);
                $('.recovery-cost').attr('disabled', 'disabled');
                $('.fitting-cost').val(data.data.quote.fitting);
                $('.fitting-cost').attr('disabled', 'disabled');
                $('.vat-cost').val(data.data.quote.vat);
                $('.vat-cost').attr('disabled', 'disabled');

                $('.warranty-value-select').val(data.data.quote.warranty);
                $('.warranty-value-select').attr('disabled', 'disabled');
                $('.condition-value-select').val(data.data.quote.condition);
                $('.condition-value-select').attr('disabled', 'disabled');
                $('.mileage-value-select').val(data.data.quote.mileage);
                $('.mileage-value-select').attr('disabled', 'disabled');
                $('.total_price').html(data.data.quote.invoice.total_price);
                $('#selling_point_title').attr('disabled', 'disabled');
                $('#quote_notes').attr('disabled', 'disabled');
                $('#terms_condition').attr('disabled', 'disabled');
                $('.quotes-send-button-div').css({ 'display': 'none' });
                let total_price_after_vat = data.data.quote.invoice.total_price;
                $.ajax({
                    url: `/user/get-quote-price`,
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        'enquiry_id': Number(data.data.quote.enquiry_id),

                    },
                    success: data => {
                        console.log(data);
                        if (data.data.length <= 0) {
                            $('.price-color').css("color", "#60BC71");
                        } else {
                            let price = 0;
                            for (let i = 0; i < data.data.length; i++) {
                                let cost = Number(data.data[i].invoice.total_price);
                                price += cost;

                            }
                            let avg_price = price / data.data.length;
                            if (total_price_after_vat > avg_price + 10) {
                                $('.price-color').css("color", "#FFC700");

                            } else if (total_price_after_vat < avg_price - 10) {
                                $('.price-color').css("color", "#FF4444");

                            } else {
                                $('.price-color').css("color", "#60BC71");

                            }
                        }



                    },
                    error: error => {
                        console.log(error)
                    }

                });





                $('#quoteModal').modal('show')

            }


        },
        error: error => {
            console.log(error)
        }

    });
}
function invoiceJob(quoteId) {
    $.ajax({
        url: `/user/single-enquiry_with_all_info`,
        method: 'GET',
        dataType: 'json',
        data: {
            'quoteId': quoteId,
        },
        success: data => {
            console.log(data)
            $("#billed_to").val(data.data.enquiry.query_user_fullname);
            $("#invoice-address").val(data.data.enquiry.address);
            $("#phone_number").val(data.data.enquiry.query_user_phone);
            $("#invoice_referance_no").val(data.data.ref);
            $("#invoice_no").val(data.data.invoice.generated_invoice_no);
            var inputDateString = data.data.invoice.created_at;

            // Parse the input date string into a JavaScript Date object
            var date = new Date(inputDateString);

            // Get the day, month, and year components
            var day = String(date.getDate()).padStart(2, '0');
            var month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-based
            var year = String(date.getFullYear()).slice(-2); // Get the last two digits of the year

            // Create the formatted date string in the "DD/MM/YY" format
            var formattedDate = day + '/' + month + '/' + year;

            $('#invoice_date').val(formattedDate);

            $("#vehicle_make").val(data.data.enquiry.car_make);
            $("#vehicle_model").val(data.data.enquiry.car_model);
            $("#vehicle_mileage").val(data.data.mileage);




            let price_arr = [];

            let engines_price = Number(data.data.engines)
            let exchange_surcharge_price = Number(data.data.exchange_surcharge)
            let delivery_charges_price = Number(data.data.delivery_charges)
            let recovery_price = Number(data.data.recovery)
            let fitting_price = Number(data.data.fitting)
            let vat_price = Number(data.data.vat)

            if (engines_price != 0) {
                price_arr.push({
                    'name': 'Engines',
                    'cost': engines_price
                })
            }
            if (exchange_surcharge_price != 0) {
                price_arr.push({
                    'name': 'Exchange Surcharge',
                    'cost': exchange_surcharge_price
                })
            }
            if (delivery_charges_price != 0) {
                price_arr.push({
                    'name': 'Delivery',
                    'cost': delivery_charges_price
                })
            }
            if (recovery_price != 0) {
                price_arr.push({
                    'name': 'Recovery',
                    'cost': recovery_price
                })
            }
            if (fitting_price != 0) {
                price_arr.push({
                    'name': 'Fitting',
                    'cost': fitting_price
                })
            }
            if (vat_price != 0) {
                price_arr.push({
                    'name': 'Vat',
                    'cost': vat_price
                })
            }

            // console.log(price_arr)

            $('.vat-cost-sub').html(`${vat_price} %`);
            let sub_total_without_vat = 0;
            for (let j = 0; j < price_arr.length; j++) {
                if (price_arr[j].name != 'Vat') {
                    let data = `<div class="cost-amount-single-div">
                                <div class="description-value">${price_arr[j].name}</div>
                                <div class="unit-cost">${price_arr[j].cost}</div>
                                <div class="amount">${price_arr[j].cost}</div>
                                </div>`;

                    $('.cost-amount-main-div').append(data);
                    sub_total_without_vat += price_arr[j].cost;
                }

            }

            $('.sub-total').html(sub_total_without_vat);
            $('.invoice-total-amount').html(Number(sub_total_without_vat) + ((Number(sub_total_without_vat) * Number(vat_price)) / 100))
            $('.payable-amount').html(Number(sub_total_without_vat) + ((Number(sub_total_without_vat) * Number(vat_price)) / 100))

            $('#invoiceModal').modal('show');

        },
        error: error => {
            console.log(error)
        }

    });
}
function noteJob(id) {
    console.log(id)
}
function emailOpenedJob(id) {
    console.log(id)
}
function hideJob(id) {
    console.log(id)
}
function workFormJob(id) {
    console.log(id)
}

//All Quote

function toggleActionQuote(event) {
    $(event.target).next().toggleClass('display-toggle-quote');
}

function viewQuote(id) {
    $.ajax({
        url: `/user/view-quote`,
        method: 'GET',
        dataType: 'json',
        data: {
            'id': id,

        },
        success: data => {
            if (data.success) {
                console.log(data.data)
                $('.modal-title').html('Your Quote');

                $('#enquiry_person_full_name').val(data.data.quote.enquiry.query_user_fullname)
                $('#enquiry_person_number').val(data.data.quote.enquiry.query_user_phone)
                $('#enquiry_person_email').val(data.data.quote.enquiry.query_user_email)
                $('#enquiry_person_address').val(data.data.quote.enquiry.address)
                $('#enquiry_id').val(data.data.quote.enquiry_id)
                $('.ref_num').html(data.data.quote.enquiry.ref_no)
                $('.auto-generated-id').html(data.data.quote.enquiry.reg_num)

                $('.engine-cost').val(data.data.quote.engines);
                $('.engine-cost').attr('disabled', 'disabled');
                $('.exchange-surcharge-cost').val(data.data.quote.exchange_surcharge);
                $('.exchange-surcharge-cost').attr('disabled', 'disabled');
                $('.delivery-cost').val(data.data.quote.delivery_charges);
                $('.delivery-cost').attr('disabled', 'disabled');
                $('.recovery-cost').val(data.data.quote.recovery);
                $('.recovery-cost').attr('disabled', 'disabled');
                $('.fitting-cost').val(data.data.quote.fitting);
                $('.fitting-cost').attr('disabled', 'disabled');
                $('.vat-cost').val(data.data.quote.vat);
                $('.vat-cost').attr('disabled', 'disabled');

                $('.warranty-value-select').val(data.data.quote.warranty);
                $('.warranty-value-select').attr('disabled', 'disabled');
                $('.condition-value-select').val(data.data.quote.condition);
                $('.condition-value-select').attr('disabled', 'disabled');
                $('.mileage-value-select').val(data.data.quote.mileage);
                $('.mileage-value-select').attr('disabled', 'disabled');
                $('.total_price').html(data.data.quote.invoice.total_price);
                $('#selling_point_title').attr('disabled', 'disabled');
                $('#quote_notes').attr('disabled', 'disabled');
                $('#terms_condition').attr('disabled', 'disabled');
                $('.quotes-send-button-div').css({ 'display': 'none' });
                let total_price_after_vat = data.data.quote.invoice.total_price;
                $.ajax({
                    url: `/user/get-quote-price`,
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        'enquiry_id': Number(data.data.quote.enquiry_id),

                    },
                    success: data => {
                        console.log(data);
                        if (data.data.length <= 0) {
                            $('.price-color').css("color", "#60BC71");
                        } else {
                            let price = 0;
                            for (let i = 0; i < data.data.length; i++) {
                                let cost = Number(data.data[i].invoice.total_price);
                                price += cost;

                            }
                            let avg_price = price / data.data.length;
                            if (total_price_after_vat > avg_price + 10) {
                                $('.price-color').css("color", "#FFC700");

                            } else if (total_price_after_vat < avg_price - 10) {
                                $('.price-color').css("color", "#FF4444");

                            } else {
                                $('.price-color').css("color", "#60BC71");

                            }
                        }



                    },
                    error: error => {
                        console.log(error)
                    }

                });





                $('#quoteModal').modal('show')

            }


        },
        error: error => {
            console.log(error)
        }

    });

}
function invoiceQuote(quoteId) {
    $.ajax({
        url: `/user/single-enquiry_with_all_info`,
        method: 'GET',
        dataType: 'json',
        data: {
            'quoteId': quoteId,
        },
        success: data => {
            console.log(data)
            $("#billed_to").val(data.data.enquiry.query_user_fullname);
            $("#invoice-address").val(data.data.enquiry.address);
            $("#phone_number").val(data.data.enquiry.query_user_phone);
            $("#invoice_referance_no").val(data.data.ref);
            $("#invoice_no").val(data.data.invoice.generated_invoice_no);
            var inputDateString = data.data.invoice.created_at;

            // Parse the input date string into a JavaScript Date object
            var date = new Date(inputDateString);

            // Get the day, month, and year components
            var day = String(date.getDate()).padStart(2, '0');
            var month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-based
            var year = String(date.getFullYear()).slice(-2); // Get the last two digits of the year

            // Create the formatted date string in the "DD/MM/YY" format
            var formattedDate = day + '/' + month + '/' + year;

            $('#invoice_date').val(formattedDate);

            $("#vehicle_make").val(data.data.enquiry.car_make);
            $("#vehicle_model").val(data.data.enquiry.car_model);
            $("#vehicle_mileage").val(data.data.mileage);




            let price_arr = [];

            let engines_price = Number(data.data.engines)
            let exchange_surcharge_price = Number(data.data.exchange_surcharge)
            let delivery_charges_price = Number(data.data.delivery_charges)
            let recovery_price = Number(data.data.recovery)
            let fitting_price = Number(data.data.fitting)
            let vat_price = Number(data.data.vat)

            if (engines_price != 0) {
                price_arr.push({
                    'name': 'Engines',
                    'cost': engines_price
                })
            }
            if (exchange_surcharge_price != 0) {
                price_arr.push({
                    'name': 'Exchange Surcharge',
                    'cost': exchange_surcharge_price
                })
            }
            if (delivery_charges_price != 0) {
                price_arr.push({
                    'name': 'Delivery',
                    'cost': delivery_charges_price
                })
            }
            if (recovery_price != 0) {
                price_arr.push({
                    'name': 'Recovery',
                    'cost': recovery_price
                })
            }
            if (fitting_price != 0) {
                price_arr.push({
                    'name': 'Fitting',
                    'cost': fitting_price
                })
            }
            if (vat_price != 0) {
                price_arr.push({
                    'name': 'Vat',
                    'cost': vat_price
                })
            }

            // console.log(price_arr)

            $('.vat-cost-sub').html(`${vat_price} %`);
            let sub_total_without_vat = 0;
            for (let j = 0; j < price_arr.length; j++) {
                if (price_arr[j].name != 'Vat') {
                    let data = `<div class="cost-amount-single-div">
                                <div class="description-value">${price_arr[j].name}</div>
                                <div class="unit-cost">${price_arr[j].cost}</div>
                                <div class="amount">${price_arr[j].cost}</div>
                                
                            </div>`;

                    $('.cost-amount-main-div').append(data);
                    sub_total_without_vat += price_arr[j].cost;
                }

            }

            $('.sub-total').html(sub_total_without_vat);
            $('.invoice-total-amount').html(Number(sub_total_without_vat) + ((Number(sub_total_without_vat) * Number(vat_price)) / 100))
            $('.payable-amount').html(Number(sub_total_without_vat) + ((Number(sub_total_without_vat) * Number(vat_price)) / 100))

            $('#invoiceModal').modal('show');

        },
        error: error => {
            console.log(error)
        }

    });
    // $('#invoiceModal').modal('show');
}

function emailOpenedQuote(id) {
    console.log(id)
}
function hideQuote(id) {
    $.ajax({
        url: `/user/hide-quote`,
        method: 'GET',
        dataType: 'json',
        data: {
            'id': id,

        },
        success: data => {
            if (data.success) {
                toastr.success(data.msg);
                window.location.reload();
            }


        },
        error: error => {
            console.log(error)
        }

    });
}

