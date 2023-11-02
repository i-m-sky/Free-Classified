@extends('layouts.app')
@section('headend')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
    <section class="section-post-ad">
        <div class="wrapper">
            <div class="post-title mb-5">
                <h1 class="text-center">Post a free Ad</h1>
            </div>
            <div class="inerWhite">
                <div class="ads-form-container">
                    <div class="ads-form-border">
                        <livewire:members.posts.post-form :catRow="collect($catRow)->toArray()" :catNav="$catNav" :post="collect($post)->toArray()"
                            key="post-form-{{ now()->timestamp }}" />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('bodyend')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {

            $("#from").datepicker({
                dateFormat: "mm/dd/yy",
                minDate: '{{ date('m/d/Y') }}',
                onSelect: function() {
                    selectedDate = $.datepicker.formatDate("mm/dd/yy", $(this).datepicker('getDate'));
                    window.livewire.emit('setFromToDate', 'from', selectedDate);
                }
            });


            $("#to").datepicker({
                dateFormat: "mm/dd/yy",
                minDate: '{{ date('m/d/Y') }}',
                onSelect: function() {
                    selectedDate = $.datepicker.formatDate("mm/dd/yy", $(this).datepicker('getDate'));
                    window.livewire.emit('setFromToDate', 'to', selectedDate);
                }
            });

        });

        $(document).ready(function() {
            $('body').on('keyup', '#search-box-post', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                if (parseInt($(this).val().length) == 0) {
                    $("#suggesstion-box").hide();
                    $("#suggesstion-box").html('');
                    window.livewire.emit('setLocationPost', '', '', '');
                }
                if (parseInt($(this).val().length) >= 2) {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('api/search-location') }}",
                        data: 'type=post&location=' + $(this).val(),
                        beforeSend: function() {},
                        success: function(data) {
                            $("#suggesstion-box").show();
                            $("#suggesstion-box").html(data);
                        }
                    });
                } //end
            });
            $('body').on('click', '.search-list-post', function(event) {
                event.preventDefault();
                const id = $(this).attr('data-id');
                const name = $(this).attr('data-name');
                const type = $(this).attr('data-type');
                window.livewire.emit('setLocationPost', id, name, type);
                $("#search-box-post").val(name);
                $("#suggesstion-box").hide();
            });
            $('body').on('change', '#phone', function(event) {
                event.preventDefault();
                if ($(this).val() == 1) {
                    $('.whatsapp-div').show();
                    $('#isWhatsApp').prop("checked", false);
                } else {
                    $('.whatsapp-div').hide();
                    $('#isWhatsApp').prop("checked", false);
                }
            });


        });

        function onlyNumber(id) {
            var x = document.getElementById(id).value;
            var y = x.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
            document.getElementById(id).value = y;
        }
        jQuery(document).ready(function() {
            //ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];
            console.log('step-1');

            $('body .upload__inputfile').each(function() {
                console.log('step-2');
                $(this).on('change', function(e) {
                    console.log('step-3');
                    imgWrap = $(this).closest('.upload__box_view').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    var html =
                                        "<div class='upload__img-box'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length + "' data-file='" + f
                                        .name +
                                        "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }
    </script>
@endsection
