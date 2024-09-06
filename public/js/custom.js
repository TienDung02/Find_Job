/* ----------------- Start Document ----------------- */
(function ($) {
    "use strict";

    $(document).ready(function () {

        /*----------------------------------------------------*/
        /*  Navigation
        /*----------------------------------------------------*/
        if ($('header').hasClass('full-width')) {
            $('header').attr('data-full', 'yes');
        }
        if ($('header').hasClass('alternative')) {
            $('header').attr('data-alt', 'yes');
        }

        function menumobile() {
            var winWidth = $(window).width();
            if (winWidth < 973) {
                $('#navigation').removeClass('menu');
                $('#navigation li').removeClass('dropdown');
                $('header').removeClass('full-width');
                $('#navigation').superfish('destroy');
            } else {
                $('#navigation').addClass('menu');
                if ($('header').data('full') === "yes") {
                    $('header').addClass('full-width')
                }
                $('#navigation').superfish({
                    delay: 300,
                    animation: {opacity: 'show'},
                    speed: 200,
                    speedOut: 50
                });
            }
            if (winWidth < 1272) {
                $('header').addClass('alternative').removeClass('full-width');
            } else {
                if ($('header').data('alt') === "yes") {
                } else {
                    $('header').removeClass('alternative');
                }
            }
        }

        $(window).resize(function () {
            menumobile();
        });
        menumobile();


        /*----------------------------------------------------*/
        /*  Mobile Navigation
        /*----------------------------------------------------*/
        var jPanelMenu = $.jPanelMenu({
            menu: '#responsive', animated: false, duration: 200, keyboardShortcuts: false, closeOnContentClick: true
        });

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
        // var url = window.location.href;
        var path = window.location.pathname;

        if (!path.endsWith('home')) {
            $('header').addClass('header_2');
            $('.logo1').removeClass('d-none').addClass('d-block');
            $('.logo2').addClass('d-none').removeClass('d-block');
        }
        if (!path.includes('home') && !path.endsWith('login')) {
            $('#footer').addClass('d-none');
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() >= pxShow) {
                $('header').addClass('header_2');
                $('.logo2').addClass('d-none').removeClass('d-block');
                $('.logo1').removeClass('d-none').addClass('d-block');
            } else {
                if (!path.endsWith('home')) {
                }else if(path.endsWith('home')){
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
                setTimeout(function() {
                    $('.ul-dropdown').removeClass('d-block');
                }, 5000);
            }
        });


        /*----------------------------------------------------*/
        /*  Showbiz Carousel
        /*----------------------------------------------------*/
        $('#job-spotlight').showbizpro({
            dragAndScroll: "off",
            visibleElementsArray: [1, 1, 1, 1],
            carousel: "on",
            entrySizeOffset: 0,
            allEntryAtOnce: "off",
            rewindFromEnd: "on",
            autoPlay: "off",
            delay: 2000,
            speed: 400,
            easing: 'easeOut'
        });


        $('#our-clients').showbizpro({
            dragAndScroll: "on",
            visibleElementsArray: [5, 4, 3, 1],
            carousel: "on",
            entrySizeOffset: 0,
            allEntryAtOnce: "off"
        });


        /*----------------------------------------------------*/
        /*  Check Password Update
        /*----------------------------------------------------*/
        $('.confirm_password, .new_password').on('input', function() {
            var new_pwd = $('.new_password').val();
            var confirmPassword = $('.confirm_password').val();

            if (new_pwd !== confirmPassword && confirmPassword != '') {
                $('.btn-submit-update').prop('disabled', true);
                $('.notification').removeClass('d-none');
            }else {
                $('.btn-submit-update').prop('disabled', false);
                $('.notification').addClass('d-none');
            }
        });

        /*----------------------------------------------------*/
        /*  Check Start & End
        /*----------------------------------------------------*/
        $(document).on('change', '.start-date, .end-date', function() {
            console.log('Input changed');
            var parent = $(this).closest('div.box-to-clone');
            var start_date = parent.find('.start-date').val();
            var notification = parent.find('.notification');
            var end_date = parent.find('.end-date').val();

            var startDateObj = new Date(start_date);
            var endDateObj = new Date(end_date);

            if (startDateObj < endDateObj) {
                console.log('a')
                notification.addClass('d-none');
            } else {
                console.log('b')
                notification.removeClass('d-none');
            }
        });


















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

        var config = {
            '.chosen-select': {disable_search_threshold: 10, width: "100%"},
            '.chosen-select-deselect': {allow_single_deselect: true, width: "100%"},
            '.chosen-select-no-single': {disable_search_threshold: 10, width: "100%"},
            '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
            '.chosen-select-width': {width: "95%"}
        };
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }


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
        /*  Magnific Popup ( Call Dialog )
        /*----------------------------------------------------*/

        $('body').magnificPopup({
            type: 'image', delegate: 'a.mfp-gallery',

            fixedContentPos: true, fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: true, preloader: true,

            removalDelay: 0, mainClass: 'mfp-fade',

            gallery: {enabled: true},

            callbacks: {
                buildControls: function () {
                    console.log('inside');
                    this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
                }
            }
        });


        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',

            fixedContentPos: false, fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: true, preloader: false,

            midClick: true, removalDelay: 300, mainClass: 'my-mfp-zoom-in'
        });


        $('.mfp-image').magnificPopup({
            type: 'image', closeOnContentClick: true, mainClass: 'mfp-fade', image: {
                verticalFit: true
            }
        });


        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
            disableOn: 700, type: 'iframe', mainClass: 'mfp-fade', removalDelay: 160, preloader: false,

            fixedContentPos: false
        });


        /*---------------------------------------------------*/
        /*  Add Job Choose Type Salary
        /*---------------------------------------------------*/
        function updateSalaryDisplay() {
            var type = $('#type-salary').val();
            $('#type-salary-from-to').toggleClass('d-none', type !== '1');
            $('#type-salary-fixed').toggleClass('d-none', type !== '2');
        }

        $(document).ready(updateSalaryDisplay);
        $('#type-salary').on('change', updateSalaryDisplay);
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
        // var link = $(".app-link");
        $(document).on('click', '.app-link', function (e) {
            e.preventDefault();

            var $this = $(this);
            var $application = $this.parents('div.application');
            var $buttons = $this.parents('div.buttons')
            var targetTab = $this.attr("href");

            $buttons.find('.app-link').not($this).removeClass('opened');

            $application.find('.close-tab').fadeOut();
            $application.find(".app-tabs div.app-tab-content").slideUp('fast').addClass('closed').removeClass('opened');

            if ($this.hasClass('opened')) {
                $this.removeClass('opened');
            } else {
                $this.addClass('opened');
                $application.find(targetTab).slideDown('fast').removeClass('closed').addClass('opened');
                $application.find('.close-tab').fadeIn(10);
            }
        });

        $(document).on('click', '.close-tab', function (e) {
            e.preventDefault();

            var $this = $(this);
            var $application = $this.parents('div.application');

            $this.fadeOut();
            $application.find(".app-link").removeClass('opened');
            $application.find(".app-tabs div.app-tab-content").slideUp('fast').addClass('closed').removeClass('opened');
        });
        // $(document).on('click', '.application_tabs', function() {
        //     setTimeout(function() {
        //         application_tabs();
        //     }, 1000);
        // });


        /*----------------------------------------------------*/
        /*  Add Resume
        /*----------------------------------------------------*/
        $('.box-to-clone').hide();
        $('.add-box').on('click', function (e) {
            e.preventDefault();
            var newElem = $(this).parent().find('.box-to-clone:last').clone();

            newElem.find('input').val('');
            newElem.find('textarea').val('');

            newElem.prependTo($(this).parent()).show();

            var height = $(this).prev('.box-to-clone').outerHeight(true);

            $("html, body").stop().animate({scrollTop: $(this).offset().top - height}, 600);
        });

        $('body').on('click', '.remove-box', function (e) {
            e.preventDefault();
            $(this).parent().remove();
        });


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



        /*----------------------------------------------------*/
        /*  Change Type Register
        /*----------------------------------------------------*/
        $('.candidate_reg').click(function () {
            console.log('aaaaaaaaaa');
            $(this).addClass('active');
            $('.employer_reg').removeClass('active');
            $('#reg_type').val('1');
        });

        $('.employer_reg').click(function () {
            console.log('bbbbbbbbb');

            $(this).addClass('active');
            $('.candidate_reg').removeClass('active');
            $('#reg_type').val('2');
        });


        // ----------------------- Input Plugin -------------------//
        // $(".tags_input").tagsinput({
        //     maxTags: 4,
        // });
        /*----------------------*/


        /*----------------------------------------------------*/
        /*  My Profile Preview Image
        /*----------------------------------------------------*/
        $('#fileInput2').on('change', function () {
            let $input;
            $input = $(this);
            if ($input.val().length > 0) {
                let fileReader;
                fileReader = new FileReader();
                fileReader.onload = function (data) {
                    $('.image-preview').attr('src', data.target.result);
                }
                fileReader.readAsDataURL($input.prop('files')[0]);
                $('.image-preview').css('display', 'block');
            }
        });

        /*----------------------------------------------------*/
        /*  Upload File Get File Name
        /*----------------------------------------------------*/
        $('.fileInput2').on('change', function () {
            var parent = $(this).parents('.controlContainer').first();
            var fileName = $(this)[0].files[0].name;
            $(parent).find('.inputFileMaskText2').first().val(fileName);
        });


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

        /*----------------------------------------------------*/
        /*  Textarea Flexible height
        /*----------------------------------------------------*/
        $('#myTextarea').on('input', function () {
            this.style.height = '60px';
            this.style.height = Math.min(this.scrollHeight, 400) + 'px';
        });


        /*----------------------------------------------------*/
        /*  Emoji
        /*----------------------------------------------------*/
        new EmojiPicker({
            trigger: [
                {
                    insertInto: ['#myTextarea'],
                    selector: '.emoji'
                }
            ]
        })


        /*----------------------------------------------------*/
        /*  Delete Image Preview
        /*----------------------------------------------------*/
        $(document).on('click', '.bi-x-lg', function(e) {
            e.preventDefault();
            var $parentA = $(this).closest('a');
            var $input = $parentA.next('input[type="hidden"]');
            $parentA.remove();
            $input.remove();
            if ($('#image-preview').find('a').length === 0) {
                $('.btn-add-img').addClass('d-none');
            }
        });
        // console.log(typeof $); // Nên hiển thị "function"
        // console.log(typeof $.ui); // Nên hiển thị "object"
        // console.log(typeof $.ui.resizable); // Nên hiển thị "function"
        // console.log($('.message-send-block').ui.size.height);
        // console.log($('.message-send-block').resizable);
        $('.message-send-block').resizable({
            resize: function(event, ui) {
                console.log('Current height:', ui.size.height);
                console.log('aaaaaaaaaa');
                console.log('Original height:', ui.originalSize.height);
            }
        });


        /*----------------------------------------------------*/
        /*  Loader Image
        /*----------------------------------------------------*/
        $('.btn-select-img').on('click', function() {
            $('.file-img').trigger('click');
        });
        const allFiles = [];
        const imagesContainer = document.getElementById('images');

        $('.file-img').on('change', function(event) {
            const files = event.target.files;
            for (const file of files) {
                allFiles.push(file);
                const reader = new FileReader();
                reader.readAsDataURL(file);

                reader.onload = function(e) {
                    // Append các file vào imagesContainer
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'images[]';
                    input.value = e.target.result; // Lưu dữ liệu base64 vào input hidden
                    // imagesContainer.appendChild(input);
                };
            }

            var img_file = $(this)[0].files[0];
            if (img_file) {
                var $preview = $('#image-preview'),
                    img = document.createElement("img"),
                    reader = new FileReader(),
                    a = document.createElement("a"),
                    icon = document.createElement("i");
                    // input = document.createElement("input");

                img.file = img_file;
                img.classList.add("img-responsive");
                img.classList.add("img-comment");
                img.classList.add("ms-2");

                icon.classList.add("bi");
                icon.classList.add("bi-x-lg");

                a.href = "#";
                a.classList.add("mt-2");
                a.style.position = "relative";
                a.style.display = "inline-block";
                a.appendChild(img);
                a.appendChild(icon);

                $preview.append(a);

                reader.onload = (function(aImg) {
                    return function(e) {
                        aImg.src = e.target.result;
                    };
                })(img);
                reader.readAsDataURL(img_file);

                $('.btn-add-img').removeClass('d-none');
                console.log(allFiles);
            }
        });

        /*----------------------------------------------------*/
        /*  Summernote
        /*----------------------------------------------------*/
        $.getScript('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js', function ()
        {
            $('.summernote').summernote();
        });
        $('.note-btn').on('click', function () {
            $('.modal-backdrop').remove();
        })
        $('.close').on('click', function() {
            console.log('aaaaaaaa');
            $(this).closest('.note-model').removeClass('show');
        });

        /*----------------------------------------------------*/
        /*  Alert To Log In
        /*----------------------------------------------------*/
        $('.alert_login').on('click', function () {
            Swal.fire({
                title: "You need to login to apply for this job.",
                showClass: {
                    popup: `
                      animate__animated
                      animate__fadeInUp
                      animate__faster
                    `
                },
                hideClass: {
                    popup: `
                      animate__animated
                      animate__fadeOutDown
                      animate__faster
                    `
                }
            });
        })

        /*----------------------------------------------------*/
        /*  Ajax Load More Comment
        /*----------------------------------------------------*/
        $(document).on('click', '#load-more', function() {
            var button = $(this);
            var pageParam = parseInt(button.attr('data-next-page'));
            if (pageParam) {
                console.log("Current Page:", pageParam);
            }
            $.ajax({
                url: $('#get-url').attr('data-url'),
                type: 'GET',
                data: {
                    'pageParam': pageParam,
                    'id': $('#get-url').attr('data-id')
                },
                success: function(data) {
                    var $data = $(data);
                    $('#loading').append($data);
                    button.attr('data-next-page', pageParam+1);
                    for (var selector in config) {
                        $(selector).chosen(config[selector]);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        /*----------------------------------------------------*/
        /*  Ajax Load Reply Comment
        /*----------------------------------------------------*/
        $(document).on('click', '#load-reply', function() {
            var id = $(this).attr('data-comment-id');
            var class_name = '.reply-'+id;
            var $icon = $(this).find('i.bi-caret-down-fill');
            console.log(class_name);

            $.ajax({
                url: $('#get-url').attr('data-url-reply'),
                type: 'GET',
                data: {
                    'id': id
                },
                success: function(data) {
                    var $data = $(data);
                    $(class_name).append($data).removeClass('d-none');
                    $icon.addClass('rotate-caret');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
            $(this).addClass('empty-reply');
            $(this).removeAttr('id');
        });

        /*----------------------------------------------------*/
        /*  Alert Is not Candidate
        /*----------------------------------------------------*/
        $('.alert-is-not-candidate').on('click', function() {
            Swal.fire({
                title: "Only candidates can apply for jobs!",
                showClass: {
                    popup: `
                      animate__animated
                      animate__fadeInUp
                      animate__faster
                    `
                },
                hideClass: {
                    popup: `
                      animate__animated
                      animate__fadeOutDown
                      animate__faster
                    `
                }
            });
        });
        /*----------------------------------------------------*/
        /*  Check Login Before Apply Job
        /*----------------------------------------------------*/
        $('.call-dialog').on('click', function() {
            $('#btn-dialog').trigger('click');
        });

        /*----------------------------------------------------*/
        /*  Hidden Reply Comment
        /*----------------------------------------------------*/
        $(document).on('click', '.empty-reply', function() {
            var id = $(this).attr('data-comment-id');
            var class_name = '.reply-'+id;
            var $icon = $(this).find('i.bi-caret-down-fill');
            $icon.removeClass('rotate-caret');
            $(class_name).empty().addClass('d-none');
            $(this).attr('id', 'load-reply');
            $(this).removeClass('empty-reply');
        });

        /*----------------------------------------------------*/
        /*  Ajax Select2
        /*----------------------------------------------------*/
        $(document).on('change', '#select-search-job', function() {
            var value = $(this).val();
            $.ajax({
                url: $('#url-select-search').attr('data-url'),
                type: 'GET',
                data: {
                    'value': value,
                },
                success: function(data) {
                    var html = $(data).children();
                    html.find('div.paginate ul li a').attr('href', function(index, oldHref) {
                        return oldHref.replace('/select-search-job', '/browser-job');
                    });
                    $('#main-list').html(html)
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        $(document).on('change', '.js-example-basic-single', function() {
            var value = $(this).val();
            var data_type = $(this).attr('data-type');
            var url = $('#get_table').attr('data-url');
            console.log(data_type)
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    'value': value,
                    'type': data_type
                },
                success: function(data) {
                    var html = $(data).children();
                    html.find('div.paginate ul li a').attr('href', function(index, oldHref) {
                        return oldHref.replace('/select2-search-job', '/browser-job');
                    });
                    $('#main-list').html(html);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });





        $(document).on('change', '#second_suggest', function() {
            var keyword = $(this).val();
            console.log('Keyword:', keyword);
            $.ajax({
                url: $('#get_limit').attr('data-url'),
                type: 'GET',
                data: {
                    'keyword': keyword,
                    'type': second_type
                },
                success: function(data) {
                    var html = $(data).children();
                    html.find('div.paginate a').attr('href', function(index, oldHref) {
                        return oldHref.replace('/paginate-limit', '');
                    });
                    $('#append_ajax').html(html);
                    var newUrl = new URL(window.location.href);
                    newUrl.searchParams.set('keyword', keyword);
                    newUrl.searchParams.set('type', second_type);
                    window.history.pushState({path: newUrl.href}, '', newUrl.href);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        var url = $('#formSearch').attr('data-url-suggest');
        // console.log(url);

        $(document).on('click', '#first_suggest', function() {
            $("#second_suggest").empty();
            $("#select_active").empty();
            $('#select_active').prop('disabled', true);
            var keyword = $('#first_suggest > option:last').val();
            $('#second_suggest').select2({
                placeholder: second_placeholder,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            keyword: params.term,
                            'province': keyword,
                            'type': second_type
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return { id: item.id_data, text: item.name};
                            })
                        };
                    },
                    cache: true
                }
            });
        });
        $(document).on('change', '#first_suggest', function() {
            $("#second_suggest").empty();
            $("#select_active").empty();
            $('#select_active').prop('disabled', true);
            var keyword = $(this).val();
            $('#second_suggest').select2({
                placeholder: second_placeholder,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            keyword: params.term,
                            'province': keyword,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return { id: item.id_data, text: item.name};
                            })
                        };
                    },
                    cache: true
                }
            });
        });
        $(document).on('change', '#second_suggest', function() {
            $("#select_active").empty();
            var keyword = $(this).val();
            $('#select_active').prop('disabled', false);
            $('#select_active').select2({
                placeholder: third_placeholder,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            keyword: params.term,
                            'district': keyword,
                            'type': second_type
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return { id: item.id_data, text: item.name};
                            })
                        };
                    },
                    cache: true
                }
            });
        });

        /*----------------------------------------------------*/
        /*  Ajax Get Suggest
        /*----------------------------------------------------*/
        var first_placeholder = $('#first_suggest').attr('data-placeholder');
        var first_type = $('#first_suggest').attr('data-type');
        var tag_id_first = $('#first_suggest');
        if (first_type !== '' && first_placeholder !== ''){
            select2_select_location(url, tag_id_first, first_type, first_placeholder);
        }

        var second_type = $('#second_suggest').attr('data-type');
        var second_placeholder = $('#second_suggest').attr('data-placeholder');
        var tag_id_second = $('#second_suggest');
        if (second_type !== '' && second_placeholder !== ''){
            select2_select_location(url, tag_id_second, second_type, second_placeholder);
        }

        var third_type = $('#select_active').attr('data-type');
        var third_placeholder = $('#select_active').attr('data-placeholder');
        var tag_id_third = $('#select_active');
        if (third_type !== '' && third_placeholder !== ''){
            select2_select_location(url, tag_id_third, third_type, third_placeholder);
        }

        var select_industry = $('#select_industry').attr('data-type');
        var industry_placeholder = $('#select_industry').attr('data-placeholder');
        var tag_id_industry = $('#select_industry');
        if (select_industry !== '' && industry_placeholder !== ''){
            select2_select_location(url, tag_id_industry, select_industry, industry_placeholder);
        }


        /*----------------------------------------------------*/
        /*  Select2 Selected
        /*----------------------------------------------------*/
        var id_province = parseInt($('#value-data-selected').attr('data-id-province'), 10);
        if (id_province !== ''){
            var tag_id_province = $('#first_suggest');
            select2_selected(url, tag_id_province, first_type, id_province);
        }
        var id_district = parseInt($('#value-data-selected').attr('data-id-district'), 10);

        if (id_district !== ''){
            var tag_id_district = $('#second_suggest');
            select2_selected(url, tag_id_district, second_type, id_district);
        }
        var id_ward = parseInt($('#value-data-selected').attr('data-id-ward'), 10);

        if (id_ward !== ''){
            var tag_id_ward = $('#select_active');
            select2_selected(url, tag_id_ward, third_type, id_ward);
        }
        var id_industry = parseInt($('#value-data-selected').attr('data-id-industry'), 10);

        if (id_industry !== ''){
            select2_selected(url, tag_id_industry, select_industry, id_industry);
        }

        /*----------------------------------------------------*/
        /*  Alert Buy Service Package
        /*----------------------------------------------------*/
        $('.Alert_buy_service_package').on('click', function (){
            Alert_buy_service_package();
        })
        /*----------------------------------------------------*/
        /*  Alert Delete
        /*----------------------------------------------------*/
        $('.Alert_delete').on('click', function (){
            var $url = $(this).attr('data-target');
            Alert_delete($url);
        })

        /*----------------------------------------------------*/
        /*  Checkbox Fail
        /*----------------------------------------------------*/
        $('.checkbox_fail').on('click', function(event) {
            event.preventDefault();
        });

        /*----------------------------------------------------*/
        /*  Check Have More
        /*----------------------------------------------------*/
        $('#load-more').on('click', function () {
            setTimeout(function() {
                var have_more = $('#have-more').attr('data-have-more');
                console.log(have_more)
                if (have_more === '0'){
                    $('#load-more').remove();
                }else{
                    $('#have-more').remove();
                }
            }, 1000);
        });

        /*----------------------------------------------------*/
        /*  Selected Value For Input Type Date
        /*----------------------------------------------------*/
        $('span[id="value-input-type-date"]').each(function() {
            var date_value = $(this).attr('data-value');
            console.log(date_value)
            if (date_value) {
                var dateOnly = date_value.split(' ')[0];
                $(this).closest('.controls').find('input[type="date"]').val(dateOnly);
            }
        });

        /*----------------------------------------------------*/
        /*  Checkbox
        /*----------------------------------------------------*/
        $('input[name="check"]').change(function() {
            $('input[name="check"]').prop('checked', false);

            $(this).prop('checked', true);

            const selectedValue = $(this).val();

            var url = $('#formSearch').attr('data-url-checkbox');

            console.log(url)

            $.ajax({
                url: url,
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    job_type: selectedValue
                },
                success: function(data) {
                    var html = $(data).children();
                    html.find('div.paginate ul li a').attr('href', function(index, oldHref) {
                        return oldHref.replace('/checkbox-search-job', '/browser-job');
                    });
                    $('#main-list').html(html)
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
        var urlParams = new URLSearchParams(window.location.search);
        var jobType = urlParams.get('job_type');

        if (jobType !== null) {
            $('input[name="check"]').prop('checked', false);
            $('input[name="check"][value="' + jobType + '"]').prop('checked', true);
        }




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
