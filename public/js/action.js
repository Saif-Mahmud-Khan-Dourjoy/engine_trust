
//Enquiry
function toggleActionEnquiry(event){
    $(event.target).next().toggleClass('display-toggle-enquiry');
}

function hideEnquiry(id){
    
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
function deleteEnquiry(id){
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
function toggleActionHidden(event){
    $(event.target).next().toggleClass('display-toggle-hidden');
}

function recreateHidden(id){
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
              $('.send-quote-btn').css({'display':'none'});
              $('.update-quote-btn').css({'display':'block'});

              //need some invoice data//
              
              let total_price_after_vat=data.data.quote.invoice.total_price;
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
function deleteHidden(id){
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
function toggleActionJob(event){
    $(event.target).next().toggleClass('display-toggle-job');
}

function viewJob(id){
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
              $('.quotes-send-button-div').css({'display':'none'});
              let total_price_after_vat=data.data.quote.invoice.total_price;
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
function  invoiceJob(id){
    console.log(id)
}
function noteJob(id){
    console.log(id)
}
function emailOpenedJob(id){
    console.log(id)
}
function hideJob(id){
    console.log(id)
}
function workFormJob(id){
    console.log(id)
}

//All Quote

function toggleActionQuote(event){
    $(event.target).next().toggleClass('display-toggle-quote');
}

function viewQuote(id){
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
              $('.quotes-send-button-div').css({'display':'none'});
              let total_price_after_vat=data.data.quote.invoice.total_price;
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
function  invoiceQuote(id){
    console.log(id)
}

function emailOpenedQuote(id){
    console.log(id)
}
function hideQuote(id){
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

