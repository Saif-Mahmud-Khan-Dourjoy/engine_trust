$(document).ready(function () {
    $(".create-own-quote").click(function () {
      $("#customQuoteModal").modal("show");
     
    });
    // $(".send-quotes").click(function () {
    //   $("#quoteModal").modal("hide");
    //   $("#invoiceModal").modal("show");
    // });


    $('.table-single-value > button').click(function(){
      $("#quoteModal").modal("show");
     })

//     var textarea_value = $('#invoice_term_condition').text();
  
//     var commaIndex=textarea_value.indexOf(',');

//     var slice_text=textarea_value.slice(0,commaIndex);

//   let coloredText = textarea_value.split('').map((letter, index) => {

//   let color = index < commaIndex ? '#69BF70' : 'black';
//   return `<span style="color: ${color}">${letter}</span>`;
// }).join('');

// $('#invoice_term_condition').html(coloredText)
   

$(".moderator-header-right-div").click(function () {
  $("#moderatorModal").modal("show");
  
});

$(".cross-btn-add-moderator").click(function () {
  $("#moderatorModal").modal("hide");
  
});

$('.car-modal-open').click(function(){
  $('#carInfoModal').modal('show');
})

$(".cross-btn-add-carInfo").click(function () {
  $("#carInfoModal").modal("hide");
  
});


$("#status-change-div").click(function () {
  alert("Hello");
  
});


    
  });