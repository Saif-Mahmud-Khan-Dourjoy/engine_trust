// $(document).ready(function () {
//     let side_bar_item = $(".side-bar-item");

//     $.each(side_bar_item, function (index, value) {
//       var current = $(".active");

//       $(current).parent().css("border-bottom", "none");

//       $(value).click(function () {
//         $(".side-bar-item").parent().css("border-bottom", "1px solid white");
//         var current = $(".active");
//         $(current).removeClass("active");
//         $(this).addClass("active");

//         $(this).parent().css("border-bottom", "none");

//         if ($(this).hasClass("dropdown-sub-menu")) {
//           $(this)
//             .next()
//             .children(".dropdown-sub-items")
//             .toggleClass("displayToggle");

//           if ($(this).hasClass("enquiry-sub-menu")) {
//             $(".hidden-sub-menu").next().children().addClass("displayToggle");
//           } else {
//             $(".enquiry-sub-menu").next().children().addClass("displayToggle");
//           }
//         }
//         if (!$(this).hasClass("dropdown-sub-menu")) {
//           $(current)
//             .next()
//             .children(".dropdown-sub-items")
//             .addClass("displayToggle");
//         }
//       });
//     });

//     let dropdown_item = $(".dropdown-sub-item");

//     $.each(dropdown_item, function (index, value) {
//       $(value).click(function () {
//         var current = $(".active-sub-item");
//         $(current).removeClass("active-sub-item");
//         $(this).addClass("active-sub-item");
//       });
//     });

//     let hidden_dropdown_item = $(".hidden-dropdown-sub-item");

//     $.each(hidden_dropdown_item, function (index, value) {
//       $(value).click(function () {
//         var current = $(".hidden-active-sub-item");
//         $(current).removeClass("hidden-active-sub-item");
//         $(this).addClass("hidden-active-sub-item");
//       });
//     });
//   });

$(document).ready(function () {
  if(!(window.location.pathname.includes('user/enquiry'))){
    $('.enquiry-sub.dropdown-sub-items').addClass('displayToggle');
  }
    let side_bar_item = $(".side-bar-item");

    $.each(side_bar_item, function (index, value) {
        var current = $(".active");

        $(current).parent().css("border-bottom", "none");

        $(value).click(function () {
            $(".side-bar-item").parent().css("border-bottom", "1px solid white");
            var current = $(".active");
            $(current).removeClass("active");
            $(this).addClass("active");

            $(this).parent().css("border-bottom", "none");

            if ($(this).hasClass("dropdown-sub-menu")) {
                $(this)
                    .next()
                    .children(".dropdown-sub-items")
                    .toggleClass("displayToggle");
                   
                if ($(this).hasClass("enquiry-sub-menu")) {
                    $(".hidden-sub-menu")
                        .next()
                        .children()
                        .addClass("displayToggle");
                } else {
                    $(".enquiry-sub-menu")
                        .next()
                        .children()
                        .addClass("displayToggle");
                }
            }
            if (!$(this).hasClass("dropdown-sub-menu")) {
                $(current)
                    .next()
                    .children(".dropdown-sub-items")
                    .addClass("displayToggle");
            }
        });
    });

    // let dropdown_item = $(".dropdown-sub-item");

    // $.each(dropdown_item, function (index, value) {
    //     $(value).click(function () {
    //         var current = $(".active-sub-item");
    //         $(current).removeClass("active-sub-item");
    //         $(this).addClass("active-sub-item");
    //     });
    // });

    // let hidden_dropdown_item = $(".hidden-dropdown-sub-item");

    // $.each(hidden_dropdown_item, function (index, value) {
    //     $(value).click(function () {
    //         var current = $(".hidden-active-sub-item");
    //         $(current).removeClass("hidden-active-sub-item");
    //         $(this).addClass("hidden-active-sub-item");
    //     });
    // });
});
