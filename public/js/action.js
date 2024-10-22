//Enquiry
function toggleActionEnquiry(event) {
    $(event.target).next().toggleClass("display-toggle-common");
}

function hideEnquiry(id) {
    $.ajax({
        url: `/user/sample-quote`,
        method: "POST",
        dataType: "json",
        data: {
            id: id,
        },
        success: (data) => {
            if (data.success) {
                toastr.success(data.msg);
                window.location.reload();
            }
        },
        error: (error) => {
            console.log(error);
        },
    });
    console.log(id);
}
function deleteEnquiry(id) {
    $.ajax({
        url: `/user/delete-enquery`,
        method: "GET",
        dataType: "json",
        data: {
            id: [id],
        },
        success: (data) => {
            if (data.success) {
                toastr.success(data.msg);
                window.location.reload();
            }
        },
        error: (error) => {
            console.log(error);
        },
    });
    console.log(id);
}

//Hidden quote
function toggleActionHidden(event) {
    $(event.target).next().toggleClass("display-toggle-common");
}

function recreateHidden(id) {
    $.ajax({
        url: `/user/view-quote`,
        method: "GET",
        dataType: "json",
        data: {
            id: id,
        },
        success: (data) => {
            if (data.success) {
                console.log(data.data);
                $(".modal-title").html("Recreate Your Quote");
                $("#enquiry_person_full_name").val(
                    data.data.quote.enquiry.query_user_fullname
                );
                $("#enquiry_person_number").val(
                    data.data.quote.enquiry.query_user_phone
                );
                $("#enquiry_person_email").val(
                    data.data.quote.enquiry.query_user_email
                );
                $("#enquiry_person_address").val(
                    data.data.quote.enquiry.address
                );
                $("#enquiry_id").val(data.data.quote.enquiry_id);
                $("#quote_id").val(data.data.quote.id);
                $(".ref_num").html(data.data.quote.enquiry.ref_no);
                $(".auto-generated-id").html(data.data.quote.enquiry.reg_num);

                $(".engine-cost").val(data.data.quote.engines);
                $(".exchange-surcharge-cost").val(
                    data.data.quote.exchange_surcharge
                );
                $(".delivery-cost").val(data.data.quote.delivery_charges);
                $(".recovery-cost").val(data.data.quote.recovery);
                $(".fitting-cost").val(data.data.quote.fitting);
                $(".vat-cost").val(data.data.quote.vat);

                $(".warranty-value-select").val(data.data.quote.warranty);
                $(".condition-value-select").val(data.data.quote.condition);
                $(".mileage-value-select").val(data.data.quote.mileage);
                $(".total_price").html(data.data.quote.invoice[0].total_price);
                $(".send-quote-btn").css({ display: "none" });
                $(".update-quote-btn").css({ display: "block" });

                //need some invoice data//

                let total_price_after_vat =
                    data.data.quote.invoice[0].total_price;
                $.ajax({
                    url: `/user/get-quote-price`,
                    method: "GET",
                    dataType: "json",
                    data: {
                        enquiry_id: Number(data.data.quote.enquiry_id),
                    },
                    success: (data) => {
                        console.log(data);
                        if (data.data.length <= 0) {
                            $(".price-color").css("color", "#60BC71");
                        } else {
                            let price = 0;
                            for (let i = 0; i < data.data.length; i++) {
                                let cost = Number(
                                    data.data[i].invoice.total_price
                                );
                                price += cost;
                            }
                            let avg_price = price / data.data.length;
                            if (total_price_after_vat > avg_price + 10) {
                                $(".price-color").css("color", "#FFC700");
                            } else if (total_price_after_vat < avg_price - 10) {
                                $(".price-color").css("color", "#FF4444");
                            } else {
                                $(".price-color").css("color", "#60BC71");
                            }
                        }
                    },
                    error: (error) => {
                        console.log(error);
                    },
                });

                $("#quoteModal").modal("show");
            }
        },
        error: (error) => {
            console.log(error);
        },
    });
}
function deleteHidden(id) {
    $.ajax({
        url: `/user/delete-quote`,
        method: "GET",
        dataType: "json",
        data: {
            id: [id],
        },
        success: (data) => {
            if (data.success) {
                toastr.success(data.msg);
                window.location.reload();
            }
        },
        error: (error) => {
            console.log(error);
        },
    });
}

//Job quote
function toggleActionJob(event) {
    $(event.target).next().toggleClass("display-toggle-common");
}

function viewJob(id) {
    $.ajax({
        url: `/user/view-quote`,
        method: "GET",
        dataType: "json",
        data: {
            id: id,
        },
        success: (data) => {
            if (data.success) {
                console.log(data.data);
                $(".modal-title").html("Your Quote");

                $("#enquiry_person_full_name").val(
                    data.data.quote.enquiry.query_user_fullname
                );
                $("#enquiry_person_number").val(
                    data.data.quote.enquiry.query_user_phone
                );
                $("#enquiry_person_email").val(
                    data.data.quote.enquiry.query_user_email
                );
                $("#enquiry_person_address").val(
                    data.data.quote.enquiry.address
                );
                $("#enquiry_id").val(data.data.quote.enquiry_id);
                $(".ref_num").html(data.data.quote.enquiry.ref_no);
                $(".auto-generated-id").html(data.data.quote.enquiry.reg_num);

                $(".engine-cost").val(data.data.quote.engines);
                $(".engine-cost").attr("disabled", "disabled");
                $(".exchange-surcharge-cost").val(
                    data.data.quote.exchange_surcharge
                );
                $(".exchange-surcharge-cost").attr("disabled", "disabled");
                $(".delivery-cost").val(data.data.quote.delivery_charges);
                $(".delivery-cost").attr("disabled", "disabled");
                $(".recovery-cost").val(data.data.quote.recovery);
                $(".recovery-cost").attr("disabled", "disabled");
                $(".fitting-cost").val(data.data.quote.fitting);
                $(".fitting-cost").attr("disabled", "disabled");
                $(".vat-cost").val(data.data.quote.vat);
                $(".vat-cost").attr("disabled", "disabled");

                $(".warranty-value-select").val(data.data.quote.warranty);
                $(".warranty-value-select").attr("disabled", "disabled");
                $(".condition-value-select").val(data.data.quote.condition);
                $(".condition-value-select").attr("disabled", "disabled");
                $(".mileage-value-select").val(data.data.quote.mileage);
                $(".mileage-value-select").attr("disabled", "disabled");
                $(".total_price").html(data.data.quote.invoice[0].total_price);
                $("#selling_point_title").attr("disabled", "disabled");
                $("#quote_notes").attr("disabled", "disabled");
                $("#terms_condition").attr("disabled", "disabled");
                $(".quotes-send-button-div").css({ display: "none" });
                let total_price_after_vat =
                    data.data.quote.invoice[0].total_price;
                $.ajax({
                    url: `/user/get-quote-price`,
                    method: "GET",
                    dataType: "json",
                    data: {
                        enquiry_id: Number(data.data.quote.enquiry_id),
                    },
                    success: (data) => {
                        console.log(data);
                        if (data.data.length <= 0) {
                            $(".price-color").css("color", "#60BC71");
                        } else {
                            let price = 0;
                            for (let i = 0; i < data.data.length; i++) {
                                let cost = Number(
                                    data.data[i].invoice.total_price
                                );
                                price += cost;
                            }
                            let avg_price = price / data.data.length;
                            if (total_price_after_vat > avg_price + 10) {
                                $(".price-color").css("color", "#FFC700");
                            } else if (total_price_after_vat < avg_price - 10) {
                                $(".price-color").css("color", "#FF4444");
                            } else {
                                $(".price-color").css("color", "#60BC71");
                            }
                        }
                    },
                    error: (error) => {
                        console.log(error);
                    },
                });

                $("#quoteModal").modal("show");
            }
        },
        error: (error) => {
            console.log(error);
        },
    });
}
function invoiceJob(quoteId) {
    $.ajax({
        url: `/user/single-enquiry_with_all_info`,
        method: "GET",
        dataType: "json",
        data: {
            quoteId: quoteId,
        },
        success: (data) => {
            console.log(data);
            $("#billed_to").val(data.data.enquiry.query_user_fullname);
            $("#invoice-address").val(data.data.enquiry.address);
            $("#phone_number").val(data.data.enquiry.query_user_phone);
            $("#invoice_referance_no").val(data.data.ref);
            $("#invoice_no").val(data.data.invoice[0].generated_invoice_no);
            var inputDateString = data.data.invoice[0].created_at;

            $(".cost-amount-header-unit-cost").css({ display: "none" });

            $(".quote_id_for_invoice").val(quoteId);

            var paid_amount =
                data.data.invoice[data.data.invoice.length - 1].paid_amount;
            var due_amount =
                data.data.invoice[data.data.invoice.length - 1].due_amount;

            // Parse the input date string into a JavaScript Date object
            var date = new Date(inputDateString);

            // Get the day, month, and year components
            var day = String(date.getDate()).padStart(2, "0");
            var month = String(date.getMonth() + 1).padStart(2, "0"); // Month is zero-based
            var year = String(date.getFullYear()).slice(-2); // Get the last two digits of the year

            // Create the formatted date string in the "DD/MM/YY" format
            var formattedDate = day + "/" + month + "/" + year;

            $("#invoice_date").val(formattedDate);

            $("#vehicle_make").val(data.data.enquiry.car_make);
            $("#vehicle_model").val(data.data.enquiry.car_model);
            $("#vehicle_mileage").val(data.data.mileage);

            let price_arr = [];

            let engines_price = Number(data.data.engines);
            let exchange_surcharge_price = Number(data.data.exchange_surcharge);
            let delivery_charges_price = Number(data.data.delivery_charges);
            let recovery_price = Number(data.data.recovery);
            let fitting_price = Number(data.data.fitting);
            let vat_price = Number(data.data.vat);

            if (engines_price != 0) {
                price_arr.push({
                    name: "Engines",
                    cost: engines_price,
                });
            }
            if (exchange_surcharge_price != 0) {
                price_arr.push({
                    name: "Exchange Surcharge",
                    cost: exchange_surcharge_price,
                });
            }
            if (delivery_charges_price != 0) {
                price_arr.push({
                    name: "Delivery",
                    cost: delivery_charges_price,
                });
            }
            if (recovery_price != 0) {
                price_arr.push({
                    name: "Recovery",
                    cost: recovery_price,
                });
            }
            if (fitting_price != 0) {
                price_arr.push({
                    name: "Fitting",
                    cost: fitting_price,
                });
            }
            if (vat_price != 0) {
                price_arr.push({
                    name: "Vat",
                    cost: vat_price,
                });
            }

            // console.log(price_arr)

            $(".vat-cost-sub").html(`${vat_price} %`);
            let sub_total_without_vat = 0;
            var data = "";
            for (let j = 0; j < price_arr.length; j++) {
                if (price_arr[j].name != "Vat") {
                    //  data += `<div class="cost-amount-single-div">
                    //             <div class="description-value">${price_arr[j].name}</div>
                    //             <div class="unit-cost">${price_arr[j].cost}</div>
                    //             <div class="amount">${price_arr[j].cost}</div>
                    //             </div>`;

                    sub_total_without_vat += price_arr[j].cost;
                }
            }

            $(".cost-amount-main-div").html(
                `<div class="cost-amount-single-div">
                                <div class="description-value">
                                <textarea type="text" rows="2" placeholder="Description"  name="invoice_description"
                                class="form-control invoice_description"></textarea> 
                                </div>
                                
                                <div class="amount">
                                <input type="text" name="invoice_payable_amount"
                                class="form-control invoice_payable_amount" placeholder="Amount" /> 
                                </div>
                                </div>`
            );

            $(".paid-amount").css({
                margin: "20px 0px 20px 0px",
            });
            $(".paid-amount").html(
                `<span>Total Paid Amount</span> <input type="text" style="border:1px solid #ced4da;width:100px" class="paid-amount-input form-control" 
             />`
            );

            $(".account-payable").html(
                `<span>Due Amount</span> <input type="text" style="border:1px solid #ced4da;width:100px" class="due-amount-input form-control" 
             />`
            );

            $(".sub-total").html(sub_total_without_vat);
            $(".invoice-total-amount").html(
                Number(sub_total_without_vat) +
                    (Number(sub_total_without_vat) * Number(vat_price)) / 100
            );

            if (paid_amount) {
                $(".paid-amount-input").val(paid_amount);
            } else {
                $(".paid-amount-input").val(0);
            }
            if (due_amount) {
                $(".due-amount-input").val(due_amount);
            } else {
                $(".due-amount-input").val(
                    Number(sub_total_without_vat) +
                        (Number(sub_total_without_vat) * Number(vat_price)) /
                            100
                );
            }

            $("#invoiceModal").modal("show");
        },
        error: (error) => {
            console.log(error);
        },
    });
}
function generateJobInvoice() {
    $(".invoice-btn").html("Generating.. please wait....");
    $("#loader").show();
    var quote_id = $(".quote_id_for_invoice").val();
    var invoice_no = $("#invoice_no").val();
    var invoice_date = $("#invoice_date").val();
    var paid_amount = $(".paid-amount-input").val();
    var payable_amount = $(".invoice_payable_amount").val();
    var invoice_total = $(".invoice-total-amount").html();
    var description = $(".invoice_description").val();
    var due_amount = $(".due-amount-input").val();
    var sub_total = $(".sub-total").html();
    var vat = $(".vat-cost-sub").html();

    $.ajax({
        url: `/user/job-invoice`,
        method: "POST",
        dataType: "json",
        data: {
            quote_id,
            invoice_no,
            invoice_date,
            paid_amount,
            payable_amount,
            invoice_total,
            description,
            due_amount,
            sub_total,
            vat,
        },
        success: (data) => {
            if (data.success) {
                $("#invoiceModal").modal("hide");
                $("#loader").hide();
                window.location.reload();
            }
        },
        error: (data) => {
            console.log(data);
        },
    });
}
function noteJob(id) {
    console.log(id);
    $("#quote_id_for_note").val(id);

    $.ajax({
        url: `/user/get-notes`,
        method: "GET",
        dataType: "json",
        data: {
            quoteId: id,
        },
        success: (data) => {
            console.log(data.data);
            if (data.data.length > 0) {
                let output = "";
                for (let i = 0; i < data.data.length; i++) {
                    output += `<div class="single-note">
               <div class="card-design">
                   <div>
                       <div>
                           <span class="single-note-number">${
                               i + 1
                           }.</span> <span class="single-note-text"> ${
                        data.data[i].remark
                    }
                           </span>
                       </div>
                       <div class="added-by-div">
                            <span class="added-by"> Added At : <span class="added-by-text">${timeAgo(
                                data.data[i].created_at
                            )} </span>
                            </span>
                       </div>

                   </div>
                   
               </div>

           </div>`;
                }
                $(".all-notes-div").html(output);
            } else {
                $(".all-notes-div").html(`<div class="single-note">
            <div class="card-design">
                <div class="text-danger" style="font-weight:bold;text-align:center">
                    No Notes Have Added Yet 
                </div>
                
            </div>

        </div>`);
            }
        },
        error: (data) => {
            console.log(data);
        },
    });

    $("#noteModal").modal("show");
}

function timeAgo(date) {
    const currentDate = new Date();
    const timestamp = new Date(date);
    const timeDifference = currentDate - timestamp;

    const seconds = Math.floor(timeDifference / 1000);
    const minutes = Math.floor(seconds / 60);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);
    const months = Math.floor(days / 30);
    const years = Math.floor(months / 12);

    if (seconds < 60) {
        return seconds + " seconds ago";
    } else if (minutes < 60) {
        return minutes + " minutes ago";
    } else if (hours < 24) {
        return hours + " hours ago";
    } else if (days < 30) {
        return days + " days ago";
    } else if (months < 12) {
        return months + " months ago";
    } else {
        return years + " years ago";
    }
}
function emailOpenedJob(id) {
    console.log(id);
}
function hideJob(id) {
    console.log(id);
}
function workFormJob(id) {
    console.log(id);
}

//All Quote

function toggleActionQuote(event) {
    $(event.target).next().toggleClass("display-toggle-common");
}

function viewQuote(id) {
    $.ajax({
        url: `/user/view-quote`,
        method: "GET",
        dataType: "json",
        data: {
            id: id,
        },
        success: (data) => {
            if (data.success) {
                console.log(data.data);
                $(".modal-title").html("Your Quote");
                $("#enquiry_person_full_name").val(
                    data.data.quote.enquiry.query_user_fullname
                );
                $("#enquiry_person_number").val(
                    data.data.quote.enquiry.query_user_phone
                );
                $("#enquiry_person_email").val(
                    data.data.quote.enquiry.query_user_email
                );
                $("#enquiry_person_address").val(
                    data.data.quote.enquiry.address
                );
                $("#enquiry_id").val(data.data.quote.enquiry_id);
                $("#quote_id").val(data.data.quote.id);
                $(".ref_num").html(data.data.quote.enquiry.ref_no);
                $(".auto-generated-id").html(data.data.quote.enquiry.reg_num);

                $(".engine-cost").val(data.data.quote.engines);
                $(".exchange-surcharge-cost").val(
                    data.data.quote.exchange_surcharge
                );
                $(".delivery-cost").val(data.data.quote.delivery_charges);
                $(".recovery-cost").val(data.data.quote.recovery);
                $(".fitting-cost").val(data.data.quote.fitting);
                $(".vat-cost").val(data.data.quote.vat);

                $(".warranty-value-select").val(data.data.quote.warranty);
                $(".condition-value-select").val(data.data.quote.condition);
                $(".mileage-value-select").val(data.data.quote.mileage);
                $(".total_price").html(data.data.quote.invoice[0].total_price);
                $(".send-quote-btn").css({ display: "none" });
                $(".update-quote-btn").css({ display: "block" });

                //need some invoice data//
                console.log(data.data.quote.invoice[0].total_price);

                let total_price_after_vat =
                    data.data.quote.invoice[0].total_price;
                $.ajax({
                    url: `/user/get-quote-price`,
                    method: "GET",
                    dataType: "json",
                    data: {
                        enquiry_id: Number(data.data.quote.enquiry_id),
                    },
                    success: (data) => {
                        console.log(data);
                        if (data.data.length <= 0) {
                            $(".price-color").css("color", "#60BC71");
                        } else {
                            let price = 0;
                            for (let i = 0; i < data.data.length; i++) {
                                let cost = Number(
                                    data.data[i].invoice.total_price
                                );
                                price += cost;
                            }
                            let avg_price = price / data.data.length;
                            if (total_price_after_vat > avg_price + 10) {
                                $(".price-color").css("color", "#FFC700");
                            } else if (total_price_after_vat < avg_price - 10) {
                                $(".price-color").css("color", "#FF4444");
                            } else {
                                $(".price-color").css("color", "#60BC71");
                            }
                        }
                    },
                    error: (error) => {
                        console.log(error);
                    },
                });

                $("#quoteModal").modal("show");
            }
        },
        error: (error) => {
            console.log(error);
        },
    });
}
function invoiceQuote(quoteId, type) {
    $.ajax({
        url: `/user/single-enquiry_with_all_info`,
        method: "GET",
        dataType: "json",
        data: {
            quoteId: quoteId,
        },
        success: (data) => {
            if (type == "invoice") {
                $(".download-invoice").css("display", "flex");
                // $('#download-invoice-btn').attr('onclick', 'DownloadInvoice(' + quoteId + ')');
                $("#set_invoice_quote_id").val(quoteId);
            }
            $("#billed_to").val(data.data.enquiry.query_user_fullname);
            $("#invoice-address").val(data.data.enquiry.address);
            $("#phone_number").val(data.data.enquiry.query_user_phone);
            $("#invoice_referance_no").val(data.data.ref);
            $("#invoice_no").val(
                data.data.invoice[data.data.invoice.length - 1]
                    .generated_invoice_no
            );

            $(".term-condition-div").css({ display: "none" });

            var inputDateString = data.data.invoice[0].created_at;

            // Parse the input date string into a JavaScript Date object
            var date = new Date(inputDateString);

            // Get the day, month, and year components
            var day = String(date.getDate()).padStart(2, "0");
            var month = String(date.getMonth() + 1).padStart(2, "0"); // Month is zero-based
            var year = String(date.getFullYear()).slice(-2); // Get the last two digits of the year

            // Create the formatted date string in the "DD/MM/YY" format
            var formattedDate = day + "/" + month + "/" + year;

            $("#invoice_date").val(formattedDate);

            $("#vehicle_make").val(data.data.enquiry.car_make);
            $("#vehicle_model").val(data.data.enquiry.car_model);
            $("#vehicle_mileage").val(data.data.mileage);

            let price_arr = [];

            let engines_price = Number(data.data.engines);
            let exchange_surcharge_price = Number(data.data.exchange_surcharge);
            let delivery_charges_price = Number(data.data.delivery_charges);
            let recovery_price = Number(data.data.recovery);
            let fitting_price = Number(data.data.fitting);
            let vat_price = Number(data.data.vat);

            if (engines_price != 0) {
                price_arr.push({
                    name: "Engines",
                    cost: engines_price,
                });
            }
            if (exchange_surcharge_price != 0) {
                price_arr.push({
                    name: "Exchange Surcharge",
                    cost: exchange_surcharge_price,
                });
            }
            if (delivery_charges_price != 0) {
                price_arr.push({
                    name: "Delivery",
                    cost: delivery_charges_price,
                });
            }
            if (recovery_price != 0) {
                price_arr.push({
                    name: "Recovery",
                    cost: recovery_price,
                });
            }
            if (fitting_price != 0) {
                price_arr.push({
                    name: "Fitting",
                    cost: fitting_price,
                });
            }
            if (vat_price != 0) {
                price_arr.push({
                    name: "Vat",
                    cost: vat_price,
                });
            }

            // console.log(price_arr)

            $(".vat-cost-sub").html(`${vat_price} %`);
            let sub_total_without_vat = 0;
            var data2 = "";
            for (let j = 0; j < price_arr.length; j++) {
                if (price_arr[j].name != "Vat") {
                    data2 += `<div class="cost-amount-single-div">
                                <div class="description-value">${price_arr[j].name}</div>
                                <div class="unit-cost">${price_arr[j].cost}</div>
                                <div class="amount">${price_arr[j].cost}</div>
                                
                            </div>`;

                    sub_total_without_vat += price_arr[j].cost;
                }
            }

            $(".cost-amount-main-div").html(data2);

            $(".sub-total").html(sub_total_without_vat);
            $(".invoice-total-amount").html(
                Number(sub_total_without_vat) +
                    (Number(sub_total_without_vat) * Number(vat_price)) / 100
            );
            // $('.payable-amount').html(Number(sub_total_without_vat) + ((Number(sub_total_without_vat) * Number(vat_price)) / 100))
            if (data.data.invoice[data.data.invoice.length - 1].due_amount) {
                $(".due-amount").html(
                    data.data.invoice[data.data.invoice.length - 1].due_amount
                );
            } else {
                $(".due-amount").html(
                    Number(sub_total_without_vat) +
                        (Number(sub_total_without_vat) * Number(vat_price)) /
                            100
                );
            }
            if (data.data.invoice[data.data.invoice.length - 1].paid_amount) {
                $(".paid-money").html(
                    data.data.invoice[data.data.invoice.length - 1].paid_amount
                );
            } else {
                $(".paid-money").html(0);
            }

            $("#invoiceModal").modal("show");
        },
        error: (error) => {
            console.log(error);
        },
    });
    // $('#invoiceModal').modal('show');
}

function invoiceDownload(id) {
    $.ajax({
        url: `/user/invoice-details`,
        method: "GET",
        dataType: "json",
        data: {
            id: id,
        },
        success: (data) => {
            console.log(data);

            // $('.download-invoice').css('display', 'flex');
            // $('#download-invoice-btn').attr('onclick', 'DownloadInvoice(' + quoteId + ')');
            $("#set_invoice_id").val(id);

            $("#billed_to_invoice").val(
                data.data.quote.enquiry.query_user_fullname
            );
            $("#invoice-address-invoice").val(data.data.quote.enquiry.address);
            $("#phone_number_invoice").val(
                data.data.quote.enquiry.query_user_phone
            );

            $("#invoice_referance_no_invoice").val(data.data.quote.ref);
            $("#invoice_no_invoice").val(data.data.generated_invoice_no);

            $(".term-condition-div").css({ display: "none" });

            var inputDateString = data.data.created_at;

            // Parse the input date string into a JavaScript Date object
            var date = new Date(inputDateString);

            // Get the day, month, and year components
            var day = String(date.getDate()).padStart(2, "0");
            var month = String(date.getMonth() + 1).padStart(2, "0"); // Month is zero-based
            var year = String(date.getFullYear()).slice(-2); // Get the last two digits of the year

            // Create the formatted date string in the "DD/MM/YY" format
            var formattedDate = day + "/" + month + "/" + year;

            $("#invoice_date_invoice").val(formattedDate);

            $("#vehicle_make_invoice").val(data.data.quote.enquiry.car_make);
            $("#vehicle_reg_invoice").val(data.data.quote.enquiry.reg_num);

            $("#vehicle_model_invoice").val(data.data.quote.enquiry.car_model);
            $("#vehicle_mileage_invoice").val(data.data.quote.mileage);

            let price_arr = [];

            let engines_price = Number(data.data.quote.engines);
            let exchange_surcharge_price = Number(
                data.data.quote.exchange_surcharge
            );
            let delivery_charges_price = Number(
                data.data.quote.delivery_charges
            );
            let recovery_price = Number(data.data.quote.recovery);
            let fitting_price = Number(data.data.quote.fitting);
            let vat_price = Number(data.data.quote.vat);

            if (engines_price != 0) {
                price_arr.push({
                    name: "Engines",
                    cost: engines_price,
                });
            }
            if (exchange_surcharge_price != 0) {
                price_arr.push({
                    name: "Exchange Surcharge",
                    cost: exchange_surcharge_price,
                });
            }
            if (delivery_charges_price != 0) {
                price_arr.push({
                    name: "Delivery",
                    cost: delivery_charges_price,
                });
            }
            if (recovery_price != 0) {
                price_arr.push({
                    name: "Recovery",
                    cost: recovery_price,
                });
            }
            if (fitting_price != 0) {
                price_arr.push({
                    name: "Fitting",
                    cost: fitting_price,
                });
            }
            if (vat_price != 0) {
                price_arr.push({
                    name: "Vat",
                    cost: vat_price,
                });
            }

            // console.log(price_arr)

            $(".vat-cost-sub").html(`${vat_price} %`);
            let sub_total_without_vat = 0;
            var data2 = "";
            for (let j = 0; j < price_arr.length; j++) {
                if (price_arr[j].name != "Vat") {
                    data2 += `<div class="cost-amount-single-div">
                                <div class="description-value">${price_arr[j].name}</div>
                                <div class="unit-cost">${price_arr[j].cost}</div>
                                <div class="amount">${price_arr[j].cost}</div>
                                
                            </div>`;

                    sub_total_without_vat += price_arr[j].cost;
                }
            }

            $(".cost-amount-main-div").html(data2);

            $(".sub-total").html(sub_total_without_vat);
            $(".invoice-total-amount").html(
                Number(sub_total_without_vat) +
                    (Number(sub_total_without_vat) * Number(vat_price)) / 100
            );
            // $('.payable-amount').html(Number(sub_total_without_vat) + ((Number(sub_total_without_vat) * Number(vat_price)) / 100))
            if (data.data.due_amount) {
                $(".due-amount").html(data.data.due_amount);
            } else {
                $(".due-amount").html(
                    Number(sub_total_without_vat) +
                        (Number(sub_total_without_vat) * Number(vat_price)) /
                            100
                );
            }
            if (data.data.paid_amount) {
                $(".paid-money").html(data.data.paid_amount);
            } else {
                $(".paid-money").html(0);
            }

            $("#invoiceDownloadModal").modal("show");
        },
        error: (error) => {
            console.log(error);
        },
    });
}

function emailOpenedQuote(id) {
    console.log(id);
}
function hideQuote(id) {
    $.ajax({
        url: `/user/hide-quote`,
        method: "GET",
        dataType: "json",
        data: {
            id: id,
        },
        success: (data) => {
            if (data.success) {
                toastr.success(data.msg);
                window.location.reload();
            }
        },
        error: (error) => {
            console.log(error);
        },
    });
}

function issue(enId) {
    $.ajax({
        url: `/user/enquiry-info-for-issue`,
        method: "GET",
        dataType: "json",
        data: {
            enId: enId,
        },
        success: (data) => {
            $(".carIssue").html(data.data.problem_with_engine);
            $("#issue").modal("show");
        },
        error: (error) => {},
    });
}

function history(qID) {
    $.ajax({
        url: `/user/all-job-status`,
        method: "GET",
        dataType: "json",
        data: {
            quote_id: qID,
        },
        success: (data) => {
            var htmlData = ` <div class="row" style="padding:5px">
          <div class="col-2">
              SL.
          </div>
          <div class="col-4">
              Status
          </div>
          <div class="col-6">
              Comments
          </div>

      </div>`;
            console.log(data);
            for (let j = 0; j < data.data.length; j++) {
                console.log(data);
                htmlData += `<div class="row mt-4 " style=" padding:5px">
                <div class="col-2">
              ${j + 1}
          </div>
          <div class="col-4">
              ${data.data[j].status}
          </div>
          <div class="col-6">
               ${data.data[j].comments}
          </div>

      </div>`;
            }

            $(".allStats").html(htmlData);
            $("#status-history").modal("show");
        },
        error: (error) => {},
    });
}

function DownloadInvoice(qId) {
    $.ajax({
        url: `/user/download-invoice`,
        method: "GET",
        dataType: "json",
        data: {
            quote_id: qId,
        },
        success: (data) => {
            console.log(data);
        },
        error: (error) => {},
    });
}

function companyDetails(Id) {
    $.ajax({
        url: `/moderator/company_details`,
        method: "GET",
        dataType: "json",
        data: {
            id: Id,
        },
        success: (data) => {
            $("#bnValue").html(data.data.business_name);
            $("#business_profile_id").val(Id);
            $("#btValue").html(data.data.business_type);
            $("#adValue").html(data.data.address);
            $("#ctValue").html(data.data.city);
            $("#coValue").html(data.data.country);
            $("#phValue").html(data.data.primary_phone);
            $("#qpValue").html(data.data.quoting_person_name);
            const sbDate = dateFormat(data.data.subscribed_at);
            const exDate = dateFormat(data.data.expiry_date);

            $("#sbValue").html(sbDate);
            $("#exValue").html(exDate);
            $("#detailsModal").modal("show");
        },
        error: (error) => {},
    });
}

function dateFormat(dateString) {
    // Convert the string into a Date object
    const dateObject = new Date(dateString);

    // Format the date to a more readable format
    const readableDate = dateObject.toLocaleDateString("en-US", {
        weekday: "long", // Sunday, Monday, etc.
        year: "numeric", // 2024
        month: "long", // September
        day: "numeric", // 15
    });

    // Format the time to a more readable format
    const readableTime = dateObject.toLocaleTimeString("en-US", {
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: true, // AM/PM format
    });

    // Combine the date and time
    const formattedDateTime = `${readableDate} at ${readableTime}`;

    return formattedDateTime;
}
