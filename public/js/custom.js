/* ----------------- Start Document ----------------- */
(function ($) {
    "use strict";

    $(document).ready(function () {

        /*----------------------------------------------------*/
        /*  Navigation
        /*----------------------------------------------------*/
        // if ($('header').hasClass('full-width')) {
        //     $('header').attr('data-full', 'yes');
        // }
        // if ($('header').hasClass('alternative')) {
        //     $('header').attr('data-alt', 'yes');
        // }

        // function menumobile() {
        //     var winWidth = $(window).width();
        //     if (winWidth < 973) {
        //         $('#navigation').removeClass('menu');
        //         $('#navigation li').removeClass('dropdown');
        //         $('header').removeClass('full-width');
        //         $('#navigation').superfish('destroy');
        //     } else {
        //         $('#navigation').addClass('menu');
        //         if ($('header').data('full') === "yes") {
        //             $('header').addClass('full-width')
        //         }
        //         $('#navigation').superfish({
        //             delay: 300,
        //             animation: {opacity: 'show'},
        //             speed: 200,
        //             speedOut: 50
        //         });
        //     }
        //     if (winWidth < 1272) {
        //         $('header').addClass('alternative').removeClass('full-width');
        //     } else {
        //         if ($('header').data('alt') === "yes") {
        //         } else {
        //             $('header').removeClass('alternative');
        //         }
        //     }
        // }
        //
        // $(window).resize(function () {
        //     menumobile();
        // });
        // menumobile();


        /*----------------------------------------------------*/
        /*  Mobile Navigation
        /*----------------------------------------------------*/
        // var jPanelMenu = $.jPanelMenu({
        //     menu: '#responsive', animated: false, duration: 200, keyboardShortcuts: false, closeOnContentClick: true
        // });

        //
        // desktop devices
        // $('.menu-trigger').on('click', function () {
        //     var jpm = $(this);
        //
        //     if (jpm.hasClass('active')) {
        //         jPanelMenu.off();
        //         jpm.removeClass('active');
        //     } else {
        //         jPanelMenu.on();
        //         jPanelMenu.open();
        //         jpm.addClass('active');
        //     }
        //     return false;
        // });


        // Removes SuperFish Styles
        // $('#jPanelMenu-menu').removeClass('sf-menu');
        // $('#jPanelMenu-menu li ul').removeAttr('style');
        //
        //
        // $(window).resize(function () {
        //     var winWidth = $(window).width();
        //     var jpmactive = $('.menu-trigger');
        //     if (winWidth > 990) {
        //         jPanelMenu.off();
        //         jpmactive.removeClass('active');
        //     }
        // });


        /*----------------------------------------------------*/
        /*  Stacktable / Responsive Tables Plug-in
        /*----------------------------------------------------*/
        // $('.responsive-table').stacktable();


        /*----------------------------------------------------*/
        /*  Back to Top & Header
        /*----------------------------------------------------*/
        var pxShow = 400; // height on which the button will show
        var fadeInTime = 1000; // how slow / fast you want the button to show
        var fadeOutTime = 1000; // how slow / fast you want the button to hide
        var scrollSpeed = 400; // how slow / fast you want the button to scroll to top.



        $(window).scroll(function () {
            if ($(window).scrollTop() >= pxShow) {
                $("#backtotop").fadeIn(fadeInTime).removeClass('d-none');

            } else {
                $("#backtotop").fadeOut(fadeOutTime).addClass('d-none');
            }
        });

        $('#backtotop a').on('click', function () {
            $('html, body').animate({scrollTop: 0}, scrollSpeed);
            return false;
        });


        /*----------------------------------------------------*/
        /*  Form Login & Register
        /*----------------------------------------------------*/
        $(document).on('click', '.login',function() {
            $(this).addClass('active');
            $('.register').removeClass('active');
            $('#tab1').addClass('d-block').removeClass('d-none');
            $('#tab2').removeClass('d-block').addClass('d-none');
        });
        $(document).on('click', '.register',function() {
            $(this).addClass('active');
            $('.login').removeClass('active');
            $('#tab2').addClass('d-block').removeClass('d-none');
            $('#tab1').removeClass('d-block').addClass('d-none');
        });


        /*----------------------------------------------------*/
        /*  Header
        /*----------------------------------------------------*/
        var url = window.location.href;
        if (url.includes('login')) {
            $('header').addClass('header_2');
            $('.logo1').removeClass('d-none').addClass('d-block');
            $('.logo2').addClass('d-none').removeClass('d-block');
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() >= pxShow) {
                $('header').addClass('header_2');
                $('.logo2').addClass('d-none').removeClass('d-block');
                $('.logo1').removeClass('d-none').addClass('d-block');

            } else {
                if (url.includes('login')) {
                }else{
                    $('header').removeClass('header_2');
                    $('.logo1').addClass('d-none').removeClass('d-block');
                    $('.logo2').removeClass('d-none').addClass('d-block');
                }
            }
        });
        /*----------------------------------------------------*/
        /*  Menu Header Dropdown
        /*----------------------------------------------------*/
        $(document).on('click', '.menu-dropdown',function() {
            if ($('.ul-dropdown').hasClass('d-block')){
                $('.ul-dropdown').removeClass('d-block');
            }else {
                $('.ul-dropdown').addClass('d-block');
            }
        });

        /*----------------------------------------------------*/
        /*  Logout
        /*----------------------------------------------------*/
        function confirmActive(status_to, alert, type_, id_) {
            var urlParams = new URLSearchParams(window.location.search);
            var keyword = urlParams.get('keyword');
            var type = urlParams.get('type');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // var csrf = $('#csrf').attr('data-csrf');
            var url = $('#change_active').attr('data-url');
            var executeAjax = function() {
                $.ajax({
                    url: url,
                    method: 'POST', // Dùng POST để gửi phương thức PATCH
                    data: {
                        '_method': 'put', // Chỉ định phương thức PATCH
                        '_token': csrfToken, // Chuyển CSRF token
                        'status_to': status_to,
                        'keyword': keyword,
                        'type': type,
                        'type_': type_,
                        'id': id_
                    },
                    success: function(response) {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        } else {
                            location.reload();
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error('XHR:', xhr);
                        Swal.fire(
                            'Error!',
                            'There was an error updating the status.',
                            'error'
                        );
                    }
                });
            };

            if (type_ === 'view') {
                executeAjax();
            } else {
                Swal.fire({
                    title: "Are you sure?",
                    text: alert,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        executeAjax();
                    } else if (result.isDismissed) {
                        $('input[data-name="' + name_ + '"]').prop('checked', status_to === 0);
                    }
                });
            }
        }
        $(document).on('click', '#logout-link', function(e) {
            e.preventDefault();
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var url = $('#browse-logout').attr('data-browse');
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
            }).then(response => {
                if (response.ok) {
                    window.location.href = '/';
                } else {
                    console.error('Logout failed');
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });














        /*----------------------------------------------------*/
        /*  Showbiz Carousel
        /*----------------------------------------------------*/
        // $('#job-spotlight').showbizpro({
        //     dragAndScroll: "off",
        //     visibleElementsArray: [1, 1, 1, 1],
        //     carousel: "off",
        //     entrySizeOffset: 0,
        //     allEntryAtOnce: "off",
        //     rewindFromEnd: "off",
        //     autoPlay: "off",
        //     delay: 2000,
        //     speed: 400,
        //     easing: 'easeOut'
        // });
        //
        // $('#our-clients').showbizpro({
        //     dragAndScroll: "off",
        //     visibleElementsArray: [5, 4, 3, 1],
        //     carousel: "off",
        //     entrySizeOffset: 0,
        //     allEntryAtOnce: "off"
        // });


        /*----------------------------------------------------*/
        /*  Revolution Slider
        /*----------------------------------------------------*/
        // $('.fullwidthbanner').revolution({
        //     delay: 9000, startwidth: 1180, startheight: 585, onHoverStop: "on", // Stop Banner Timet at Hover on Slide on/off
        //     navigationType: "none", //bullet, none
        //     navigationArrows: "verticalcentered", //nexttobullets, verticalcentered, none
        //     navigationStyle: "none", //round, square, navbar, none
        //     touchenabled: "on", // Enable Swipe Function : on/off
        //     navOffsetHorizontal: 0, navOffsetVertical: 20, stopAtSlide: -1, // Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
        //     stopAfterLoops: -1, // Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic
        //     fullWidth: "on",
        // });


        /*----------------------------------------------------*/
        /*  Flexslider
        /*----------------------------------------------------*/
        // $('.testimonials-slider').flexslider({
        //     animation: "fade",
        //     controlsContainer: $(".custom-controls-container"),
        //     customDirectionNav: $(".custom-navigation a")
        // });


        /*----------------------------------------------------*/
        /*  Counters
        /*----------------------------------------------------*/

        // $('.counter').counterUp({
        //     delay: 10, time: 800
        // });


        /*----------------------------------------------------*/
        /*  Chosen Plugin
        /*----------------------------------------------------*/

        // var config = {
        //     '.chosen-select': {disable_search_threshold: 10, width: "100%"},
        //     '.chosen-select-deselect': {allow_single_deselect: true, width: "100%"},
        //     '.chosen-select-no-single': {disable_search_threshold: 10, width: "100%"},
        //     '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        //     '.chosen-select-width': {width: "95%"}
        // };
        // for (var selector in config) {
        //     $(selector).chosen(config[selector]);
        // }


        /*----------------------------------------------------*/
        /*  Checkboxes "any" fix
        /*----------------------------------------------------*/
        // $('.checkboxes').find('input:first').addClass('first')
        // $('.checkboxes input').on('change', function () {
        //     if ($(this).hasClass('first')) {
        //         $(this).parents('.checkboxes').find('input').prop('checked', false);
        //         $(this).prop('checked', true);
        //     } else {
        //         $(this).parents('.checkboxes').find('input:first').not(this).prop('checked', false);
        //     }
        // });


        /*----------------------------------------------------*/
        /*  Magnific Popup
        /*----------------------------------------------------*/

        // $('body').magnificPopup({
        //     type: 'image', delegate: 'a.mfp-gallery',
        //
        //     fixedContentPos: true, fixedBgPos: true,
        //
        //     overflowY: 'auto',
        //
        //     closeBtnInside: true, preloader: true,
        //
        //     removalDelay: 0, mainClass: 'mfp-fade',
        //
        //     gallery: {enabled: true},
        //
        //     callbacks: {
        //         buildControls: function () {
        //             console.log('inside');
        //             this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
        //         }
        //     }
        // });
        //
        //
        // $('.popup-with-zoom-anim').magnificPopup({
        //     type: 'inline',
        //
        //     fixedContentPos: false, fixedBgPos: true,
        //
        //     overflowY: 'auto',
        //
        //     closeBtnInside: true, preloader: false,
        //
        //     midClick: true, removalDelay: 300, mainClass: 'my-mfp-zoom-in'
        // });
        //
        //
        // $('.mfp-image').magnificPopup({
        //     type: 'image', closeOnContentClick: true, mainClass: 'mfp-fade', image: {
        //         verticalFit: true
        //     }
        // });
        //
        //
        // $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        //     disableOn: 700, type: 'iframe', mainClass: 'mfp-fade', removalDelay: 160, preloader: false,
        //
        //     fixedContentPos: false
        // });


        /*---------------------------------------------------*/
        /*  Contact Form
        /*---------------------------------------------------*/
        // $("#contactform .submit").on('click', function (e) {
        //
        //
        //     e.preventDefault();
        //     var user_name = $('input[name=name]').val();
        //     var user_email = $('input[name=email]').val();
        //     var user_comment = $('textarea[name=comment]').val();
        //
        //     //simple validation at client's end
        //     //we simply change border color to red if empty field using .css()
        //     var proceed = true;
        //     if (user_name === "") {
        //         $('input[name=name]').addClass('error');
        //         proceed = false;
        //     }
        //     if (user_email === "") {
        //         $('input[name=email]').addClass('error');
        //         proceed = false;
        //     }
        //     if (user_comment === "") {
        //         $('textarea[name=comment]').addClass('error');
        //         proceed = false;
        //     }
        //
        //     //everything looks good! proceed...
        //     if (proceed) {
        //         $('.hide').fadeIn();
        //         $("#contactform .submit").fadeOut();
        //         //data to be sent to server
        //         var post_data = {'userName': user_name, 'userEmail': user_email, 'userComment': user_comment};
        //
        //         //Ajax post data to server
        //         $.post('contact.php', post_data, function (response) {
        //             var output;
        //             //load json data from server and output comment
        //             if (response.type == 'error') {
        //                 output = '<div class="error">' + response.text + '</div>';
        //                 $('.hide').fadeOut();
        //                 $("#contactform .submit").fadeIn();
        //             } else {
        //
        //                 output = '<div class="success">' + response.text + '</div>';
        //                 //reset values in all input fields
        //                 $('#contact div input').val('');
        //                 $('#contact textarea').val('');
        //                 $('.hide').fadeOut();
        //                 $("#contactform .submit").fadeIn().attr("disabled", "disabled").css({
        //                     'backgroundColor': '#c0c0c0', 'cursor': 'default'
        //                 });
        //             }
        //
        //             $("#result").hide().html(output).slideDown();
        //         }, 'json');
        //     }
        // });

        //reset previously set border colors and hide all comment on .keyup()
        // $("#contactform input, #contactform textarea").keyup(function () {
        //     $("#contactform input, #contactform textarea").removeClass('error');
        //     $("#result").slideUp();
        // });


        /*----------------------------------------------------*/
        /*  Accordions
        /*----------------------------------------------------*/
        //
        // var $accor = $('.accordion');
        //
        // $accor.each(function () {
        //     $(this).addClass('ui-accordion ui-widget ui-helper-reset');
        //     $(this).find('h3').addClass('ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all');
        //     $(this).find('div').addClass('ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom');
        //     $(this).find("div").hide().first().show();
        //     $(this).find("h3").first().removeClass('ui-accordion-header-active ui-state-active ui-corner-top').addClass('ui-accordion-header-active ui-state-active ui-corner-top');
        //     $(this).find("span").first().addClass('ui-accordion-icon-active');
        // });
        //
        // var $trigger = $accor.find('h3');
        //
        // $trigger.on('click', function (e) {
        //     var location = $(this).parent();
        //
        //     if ($(this).next().is(':hidden')) {
        //         var $triggerloc = $('h3', location);
        //         $triggerloc.removeClass('ui-accordion-header-active ui-state-active ui-corner-top').next().slideUp(300);
        //         $triggerloc.find('span').removeClass('ui-accordion-icon-active');
        //         $(this).find('span').addClass('ui-accordion-icon-active');
        //         $(this).addClass('ui-accordion-header-active ui-state-active ui-corner-top').next().slideDown(300);
        //     }
        //     e.preventDefault();
        // });


        /*----------------------------------------------------*/
        /*  Application Tabs
        /*----------------------------------------------------*/
        // Get all the links.
        // var link = $(".app-link");
        // $('.close-tab').hide();
        //
        // $('.app-tabs div.app-tab-content').hide();
        // // On clicking of the links do something.
        // link.on('click', function (e) {
        //
        //     e.preventDefault();
        //     $(this).parents('div.application').find('.close-tab').fadeOut();
        //     if ($(this).hasClass('opened')) {
        //         $(this).parents('div.application').find(".app-tabs div.app-tab-content").slideUp('fast');
        //         $(this).parents('div.application').find('.close-tab').fadeOut(10);
        //         $(this).removeClass('opened');
        //     } else {
        //         $(this).parents('div.application').find(".app-link").removeClass('opened');
        //         $(this).addClass('opened');
        //         var a = $(this).attr("href");
        //         $(this).parents('div.application').find(a).slideDown('fast').removeClass('closed').addClass('opened');
        //         $(this).parents('div.application').find('.close-tab').fadeIn(10);
        //     }
        //
        //     $(this).parents('div.application').find(".app-tabs div.app-tab-content").not(a).slideUp('fast').addClass('closed').removeClass('opened');
        //
        // });

        // $('.close-tab').on('click', function (e) {
        //     $(this).fadeOut();
        //     e.preventDefault();
        //     $(this).parents('div.application').find(".app-link").removeClass('opened');
        //     $(this).parents('div.application').find(".app-tabs div.app-tab-content").slideUp('fast').addClass('closed').removeClass('opened');
        // })


        /*----------------------------------------------------*/
        /*  Add Resume
        /*----------------------------------------------------*/
        // $('.box-to-clone').hide();
        // $('.add-box').on('click', function (e) {
        //     e.preventDefault();
        //     var newElem = $(this).parent().find('.box-to-clone:first').clone();
        //     newElem.find('input').val('');
        //     newElem.prependTo($(this).parent()).show();
        //     var height = $(this).prev('.box-to-clone').outerHeight(true);
        //
        //     $("html, body").stop().animate({scrollTop: $(this).offset().top - height}, 600);
        // });
        //
        // $('body').on('click', '.remove-box', function (e) {
        //     e.preventDefault();
        //     $(this).parent().remove();
        // });


        /*----------------------------------------------------*/
        /*  Tabs
        /*----------------------------------------------------*/


        // var $tabsNav = $('.tabs-nav'), $tabsNavLis = $tabsNav.children('li');
        // // $tabContent = $('.tab-content');
        //
        // $tabsNav.each(function () {
        //     var $this = $(this);
        //
        //     $this.next().children('.tab-content').stop(true, true).hide()
        //         .first().show();
        //
        //     $this.children('li').first().addClass('active').stop(true, true).show();
        // });
        //
        // $tabsNavLis.on('click', function (e) {
        //     var $this = $(this);
        //
        //     $this.siblings().removeClass('active').end()
        //         .addClass('active');
        //
        //     $this.parent().next().children('.tab-content').stop(true, true).hide()
        //         .siblings($this.find('a').attr('href')).fadeIn();
        //
        //     e.preventDefault();
        // });
        // var hash = window.location.hash;
        // var anchor = $('.tabs-nav a[href="' + hash + '"]');
        //
        // if (anchor.length === 0) {
        //     $(".tabs-nav li:first").addClass("active").show(); //Activate first tab
        //     $(".tab-content:first").show(); //Show first tab content
        // } else {
        //     anchor.parent('li').trigger("click");
        // }

        /*----------------------------*/


        // ----------------------- Change Type Register -------------------//
        // $('.candidate_reg').click(function () {
        //     $(this).addClass('active');
        //     $('.employer_reg').removeClass('active');
        //     $('#reg_type').val('1');
        // });
        //
        // $('.employer_reg').click(function () {
        //     $(this).addClass('active');
        //     $('.candidate_reg').removeClass('active');
        //     $('#reg_type').val('2');
        // });
        // /*--------------------*/


        // ----------------------- Input Plugin -------------------//
        // $(".tags_input").tagsinput({
        //     maxTags: 4,
        // });
        /*----------------------*/


        // ----------------------- My Profile Preview Image -------------------//
        //
        // $('#fileInput2').on('change', function () {
        //     let $input;
        //     $input = $(this);
        //     if ($input.val().length > 0) {
        //         let fileReader;
        //         fileReader = new FileReader();
        //         fileReader.onload = function (data) {
        //             $('.image-preview').attr('src', data.target.result);
        //         }
        //         fileReader.readAsDataURL($input.prop('files')[0]);
        //         $('.image-preview').css('display', 'block');
        //     }
        // });
        /*----------------------------*/


        // ----------------------- Upload File Get File Name -------------------//
        //
        // $('.fileInput2').on('change', function () {
        //     var parent = $(this).parents('.controlContainer').first();
        //     var fileName = $(this)[0].files[0].name;
        //     $(parent).find('.inputFileMaskText2').first().val(fileName);
        //     // $('.inputFileMaskText2').val(fileName);
        // });
        /*----------------------------*/


        // ------------------------ Input Date --------------------------------- //

        /* :: DATE PICKER
 ------------------------------------------------ */

        // :: DAY
        // var $select_day = $("#select_day");
        // for (var i = 1; i < 32; i++) {
        //     var day_number = i;
        //     $('<option>')
        //         .val(('0' + day_number).slice(-2))   // set the value
        //         .text(i)    // set the text in in the <option>
        //         .appendTo($select_day);
        // }
        //
        // // :: MONTH
        // var $select_month = $("#select_month");
        // var options = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        // for (var i = 0; i < options.length; i++) {
        //     var month_number = i + 1;
        //     $('<option>')
        //         .val(('0' + month_number).slice(-2))          // set the value
        //         .text(options[i])    // set the text in in the <option>
        //         .appendTo($select_month);
        // }

        // :: YEAR
        // var $select_year = $("#select_year");
        //
        // // Get the current year
        // var year = new Date().getFullYear();
        // var $select_year = $('#select_year').empty();
        //
        // for (var i = 0; i < 29; i++) {
        //     $('<option>')
        //         .val(year + i)     // set the value
        //         .text(year + i)    // set the text in in the <option>
        //         .appendTo($select_year);
        // }

        // ----------------------- End Input Date -------------------------- //


        // ---------------------------------------------------------------------------------------------






        // ---------------------------------------------------------------------------------------------




        // ---------------------------------------------------------------------------------------------
        // function menuActive(){
        //     var url = window.location.href;
        //     const currentUrl = new URL(window.location.href);
        //     console.log("URL hiện tại:", url);
        //     console.log("URL hiện tại:", currentUrl);
        // }
        // document.addEventListener("DOMContentLoaded", function() {
        //
        //
        //     var parts = url.split('/');
        //     console.log("Các phần của URL:", parts);
        //
        //     var localIndex = parts.indexOf('local');
        //     if (localIndex !== -1 && localIndex + 1 < parts.length) {
        //         var value = parts[localIndex + 1];
        //         console.log("Giá trị sau 'local':", value);
        //
        //         // Tìm thẻ HTML có class là giá trị vừa lấy được và thêm class 'menu_active'
        //         var element = document.querySelector('.' + value);
        //         if (element) {
        //             element.classList.add('menu_active');
        //             console.log("Thêm class 'menu_active' vào phần tử:", element);
        //         } else {
        //             console.log("Không tìm thấy phần tử với class:", value);
        //         }
        //     } else {
        //         console.log("Không tìm thấy 'local' trong URL hoặc không có giá trị sau 'local'");
        //     }
        // });





        // ---------------------------------------------------------------------------------------------



        // ------------------------------------ Summernote ---------------------------------------------------//

        $.getScript('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js', function ()
        {
            $('#summernote').summernote();
        });
        /*----------------------------*/

        // ----------------------------------------- Alert To Log In -------------------------------------------------//
        $('.alert_login').on('click', function () {
            Swal.fire({
                icon: 'question',
                title: 'You need to login first!',
                showDenyButton: true,
                confirmButtonText: 'Go to login',
                denyButtonText: `Not now`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../index.blade.php';
                } else if (result.isDenied) {
                }
            })
        })

        /*----------------------------*/


        // function alert_after_load(title, icon) {
        //     const Toast = Swal.mixin({
        //         toast: true,
        //         position: 'top-end',
        //         showConfirmButton: false,
        //         timer: 3000,
        //         timerProgressBar: true,
        //         didOpen: (toast) => {
        //             toast.addEventListener('mouseenter', Swal.stopTimer)
        //             toast.addEventListener('mouseleave', Swal.resumeTimer)
        //         }
        //     })
        //     Toast.fire({
        //             icon: icon,
        //             title: title
        //         }
        //     )
        // }

// ------------------ End Document ------------------ //
    });
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

})(this.jQuery);
