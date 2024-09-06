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


        //------------------------------- Hidden and Show Menu Left Admin -------------------------------------//
        // $('.menu_02').hide();
        $(".btn_hidden_menu").click(function () {
            $(".menu_01").addClass('hide_menu_');
            $(".menu_02").removeClass('hide_menu_');

            $(".btn_hidden_menu").removeClass('d-block');
            $(".btn_hidden_menu").addClass('d-none');
            $(".btn_Show_menu").addClass('d-block');
            $(".btn_Show_menu").removeClass('d-none');

            $('#admin_wrapper main .contain').css({
                'margin-left': '110px'
            });

            $('.btn_Show_menu, .btn_hidden_menu').css({
                'width': '110px'
            });
        });
        $(".btn_Show_menu").click(function () {
            $(".menu_02").addClass('hide_menu_');
            $(".menu_01").removeClass('hide_menu_');

            $(".btn_Show_menu").removeClass('d-block');
            $(".btn_Show_menu").addClass('d-none');
            $(".btn_hidden_menu").addClass('d-block');
            $(".btn_hidden_menu").removeClass('d-none');

            $('#admin_wrapper main .contain').css({
                'margin-left': '250px'
            });

            $('.btn_Show_menu, .btn_hidden_menu').css({
                'width': '250px'
            });
        });
        /*----------------------------*/


        // ------------------------------ Ajax Get Table After Search ---------------------------//
        $(document).on('change', '#first_suggest', function() {
            var keyword = $(this).val();
            $.ajax({
                url: $('#get_limit').attr('data-url'),
                type: 'GET',
                data: {
                    'keyword': keyword,
                    'type': first_type
                },
                success: function(data) {
                    var html = $(data).children();
                    html.find('div.paginate a').attr('href', function(index, oldHref) {
                        return oldHref.replace('/paginate-limit', '/index');
                    });
                    $('#append_ajax').html(html);
                    var newUrl = new URL(window.location.href);
                    newUrl.searchParams.set('keyword', keyword);
                    newUrl.searchParams.set('type', first_type);
                    window.history.pushState({path: newUrl.href}, '', newUrl.href);
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
                        return oldHref.replace('/paginate-limit', '/index');
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
        $(document).on('change', '#select_active', function() {
            var keyword = $(this).val();
            $.ajax({
                url: $('#get_limit').attr('data-url'),
                type: 'GET',
                data: {
                    'keyword': keyword,
                    'type': third_type
                },
                success: function(data) {
                    var html = $(data).children();
                    html.find('div.paginate a').attr('href', function(index, oldHref) {
                        return oldHref.replace('/paginate-limit', '/index');
                    });
                    $('#append_ajax').html(html);
                    var newUrl = new URL(window.location.href);
                    newUrl.searchParams.set('keyword', keyword);
                    newUrl.searchParams.set('type', third_type);
                    window.history.pushState({path: newUrl.href}, '', newUrl.href);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        //--------------------------------------------------------------------------------//


        //------------------------------ Ajax Get Suggest -----------------------------------------//
        var first_placeholder = $('#first_suggest').attr('data-placeholder');
        var first_type = $('#first_suggest').attr('data-type');
        $('#first_suggest').select2({
            placeholder: first_placeholder,
            ajax: {
                url: $('#formSearch').attr('action'),
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        keyword: params.term,
                        type: first_type
                    };
                },
                processResults: function(data) {

                    return {
                        results: data.map(function(item) {
                            return { id: item.id_data, text: item.data1};
                        })
                    };
                },
                cache: true
            }
        }).on('select2:select', function(e) {
            if (first_type == 'parent'){
                var data_first_suggest = e.params.data.id;
                var second_placeholder = $('#second_suggest').attr('data-placeholder');
                $('#second_suggest').prop('disabled', false).select2({
                    placeholder: second_placeholder,
                    ajax: {
                        url: $('#formSearch').attr('action'),
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                keyword: params.term,
                                type: second_type,
                                data_first_suggest: data_first_suggest
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.map(function(item) {
                                    return { id: item.data2, text: item.data2};
                                })
                            };
                        },
                        cache: true
                    }
                });
            }else {
                $('#second_suggest').prop('disabled', true);
            }
        });

        var second_type = $('#second_suggest').attr('data-type');

        var second_placeholder = $('#second_suggest').attr('data-placeholder');
        $('#second_suggest').select2({
            placeholder: second_placeholder,
            ajax: {
                url: $('#formSearch').attr('action'),
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        keyword: params.term,
                        type: second_type
                    };
                },
                processResults: function(data) {
                    if (second_type == 'role'){
                        const statusText = {
                            1: 'Candidate',
                            2: 'Employer',
                            3: 'Admin'
                        };

                        const seen = {};
                        const results = data.filter(item => {
                            if (seen[item.data2]) {
                                return false;
                            }
                            seen[item.data2] = true;
                            return true;
                        }).map(item => ({
                            id: item.data2,
                            text: statusText[item.data2]
                        }));
                        return {
                            results: results
                        };
                    }
                    return {
                        results: data.map(function(item) {
                            return { id: item.data2, text: item.data2};
                        })
                    };
                },
                cache: true
            }
        }).on('select2:select', function(e) {
            $('#first_suggest').prop('disabled', true);
        });

        var third_type = $('#select_active').attr('data-type');
        var third_placeholder = $('#select_active').attr('data-placeholder');
        $('#select_active').select2({
            placeholder: third_placeholder,
            ajax: {
                url: $('#formSearch').attr('action'),
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        keyword: params.term,
                        type: third_type
                    };
                },
                processResults: function(data) {
                    if (third_type === 'avtive'){
                        const statusText = {
                            1: 'Active',
                            0: 'No Active'
                        };

                        const seen = {};
                        const results = data.filter(item => {
                            if (seen[item.data3]) {
                                return false;
                            }
                            seen[item.data3] = true;
                            return true;
                        }).map(item => ({
                            id: item.data3,
                            text: statusText[item.data3]
                        }));
                        return {
                            results: results
                        };
                    }
                    if (third_type === 'level'){
                        const statusText = {
                            1: '1',
                            2: '2',
                            3: '3',
                            4: '4'
                        };

                        const seen = {};
                        const results = data.filter(item => {
                            if (seen[item.data3]) {
                                return false;
                            }
                            seen[item.data3] = true;
                            return true;
                        }).map(item => ({
                            id: item.data3,
                            text: statusText[item.data3]
                        }));
                        return {
                            results: results
                        };
                    }

                },
                cache: true
            }
        });

        //---------------------------------------------------------------------------------//


        //------------------------------ Ajax show Limit ---------------------------//

        $(document).on('change', '#show-limit',function() {
            var urlParams = new URLSearchParams(window.location.search);
            var keyword = urlParams.get('keyword');
            var type = urlParams.get('type');
            var limit = $(this).val();
            console.log('aaa');
            console.log(limit);

            $.ajax({
                url: $('#get_limit').attr('data-url'),
                type: 'GET',
                data: {
                    'keyword': keyword,
                    'limit': limit,
                    'type': type
                },
                success: function(data) {
                    var html = $(data).children();
                    html.find('div.paginate a').attr('href', function(index, oldHref) {
                        return oldHref.replace('/paginate-limit', '/index');
                    });
                    $('#append_ajax').html(html);
                    var newUrl = new URL(window.location.href);
                    newUrl.searchParams.set('keyword', keyword);
                    newUrl.searchParams.set('type', type);
                    newUrl.searchParams.set('limit', limit);
                    window.history.pushState({path: newUrl.href}, '', newUrl.href);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        //------------------------------------------------------------------------------//





        //------------------------------------- Dropdown Select Active -----------------------------------------//

        // Populate the dropdown with example data
        //------------------------------------------------------------------------------//


        // -----------------------------------------Alert Confirm Delete----------------------------------------------------
        function confirmDelete(formId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var _this = $(this);
            var id_form = _this.attr('data-id');
            confirmDelete('delete-form-'+id_form);
        })
        // ---------------------------------------------------------------------------------------------



        // -----------------------------------------Alert Confirm Active----------------------------------------------------
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
                    method: 'POST',
                    data: {
                        '_method': 'put',
                        '_token': csrfToken,
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
        $(document).on('click', '.toggle_switch', function(e) {
            // e.stopImmediatePropagation();
            e.preventDefault();
            var name_ = $(this).attr('data-name');
            var type_ = $(this).attr('data-type');

            var id_ = $(this).attr('data-id');
            var isChecked = $(this).is(':checked');
            if (isChecked === false){
                console.log('Checkbox is checked');
                var status_to = 0;
                var alert = 'Do you really want to disable the ' + type_ +  name_ + '?';
            }else {
                console.log('Checkbox is not checked');
                var status_to = 1;
                var alert = 'Do you really want to enable the ' + type_ +  name_ + '?';

            }
            if (type_ === 'view'){
                alert = '';
                var isChecked = $('.status_active').is(':checked');
                if (isChecked === false){
                    console.log('Checkbox is checked');
                    var status_to = 0;
                }else {
                    console.log('Checkbox is not checked');
                    var status_to = 1;
                }
            }
            confirmActive(status_to, alert, type_, id_);
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
            console.log('aaaaaaaaaa');
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

        /*----------------------------------------------------*/
        /*  Textarea Flexible height
        /*----------------------------------------------------*/
        $('#myTextarea').on('input', function () {
            this.style.height = '58px';
            this.style.height = Math.min(this.scrollHeight, 160) + 'px';
        });

        /*----------------------------------------------------*/
        /*  Summernote
        /*----------------------------------------------------*/
        $.getScript('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js', function ()
        {
            $('#summernote').summernote();
        });


        // ----------------------------------------- Alert To Log In -------------------------------------------------//
        // $('.alert_login').on('click', function () {
        //     Swal.fire({
        //         icon: 'question',
        //         title: 'You need to login first!',
        //         showDenyButton: true,
        //         confirmButtonText: 'Go to login',
        //         denyButtonText: `Not now`,
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             window.location.href = '../detail.blade.php';
        //         } else if (result.isDenied) {
        //         }
        //     })
        // })

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
