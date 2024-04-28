var config = {};
var init_function = {
    init: function () {
        let _this = this;
        _this.bs_input_file();
        _this.showImage();
        _this.previewReaderCard();
        _this.addRowImportProduct();
        _this.viewBorrow();
    },
    bs_input_file: function () {
        $(".input-file").before(
            function() {
                if ( ! $(this).prev().hasClass('input-ghost') ) {
                    var element = $("<input type='file' class='input-ghost' id='input_img' style='visibility:hidden; height:0'>");
                    element.attr("name",$(this).attr("name"));
                    element.change(function(){
                        element.next(element).find('input').val((element.val()).split('\\').pop());
                    });
                    $(this).find("button.btn-choose").click(function(){
                        element.click();
                    });
                    $(this).find("button.btn-reset").click(function(){
                        element.val(null);
                        $(this).parents(".input-file").find('input').val('');
                    });
                    $(this).find('input').css("cursor","pointer");
                    $(this).find('input').mousedown(function() {
                        $(this).parents('.input-file').prev().click();
                        return false;
                    });
                    return element;
                }
            }
        );
    },
    showImage: function() {
        $("#input_img").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_render').attr('src', e.target.result);
                    $('#image_render').css('height', '195px');
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    },
    previewReaderCard : function () {
        $(".btn_preview_card").click(function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
            }).done(function (result) {
                if (result.html)
                {
                    console.log(result);
                    $("#card_preview").html('').append(result.html);
                    $(".card_preview").modal('show');
                }
            })
        })
    },
    addRowImportProduct: function () {
        $('.btn-add-row-import_product').click(function () {
            var location = $('table#table-import-product tr:last').attr('location');
            var url = $('table#table-import-product').attr('url');
            var action = $('table#table-import-product').attr('actiontable');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: {
                    location: location,
                    action : action,
                },
            }).done(function (result) {
                $('.content-table').append(result.html)
            });
        })
    },
    viewBorrow : function () {
        $(".btn_preview_borrow").click(function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
            }).done(function (result) {
                if (result.html)
                {
                    console.log(result.html);
                    $("#content_view_borrow").html('').append(result.html);
                    $(".modal_borrow").modal('show');
                }
            })
        })
    }

}
$(function () {
    init_function.init();

    $(document).on('before', '.input-file', function () {
        if ( ! $(this).prev().hasClass('input-ghost') ) {
            var element = $("<input type='file' class='input-ghost' id='input_img' style='visibility:hidden; height:0'>");
            element.attr("name",$(this).attr("name"));
            element.change(function(){
                element.next(element).find('input').val((element.val()).split('\\').pop());
            });
            $(this).find("button.btn-choose").click(function(){
                element.click();
            });
            $(this).find("button.btn-reset").click(function(){
                element.val(null);
                $(this).parents(".input-file").find('input').val('');
            });
            $(this).find('input').css("cursor","pointer");
            $(this).find('input').mousedown(function() {
                $(this).parents('.input-file').prev().click();
                return false;
            });
            return element;
        }
    });

    $(document).on('change', '#input_img', function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#image_render').attr('src', e.target.result);
                $('#image_render').css('height', '195px');
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    $('.btn-change-code').click(function (event) {
        event.preventDefault();
        let code = randomCode(10);
        $('.random_code').val(code);
    });

    $(".confirm__btn").click(function(event){
        event.preventDefault();
        let $this = $(this);
        $.confirm({
            title: 'Warning ?',
            content: 'Are you sure you want to perform this operation.',
            type: 'green',
            buttons: {
                ok: {
                    text: "ok!",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function(){
                        window.location = $this.attr('href');
                    }
                },
                cancel: function(){
                    console.log('the user clicked cancel');
                }
            }
        });
    });

    function formatNumber(nStr, decSeperate, groupSeperate) {
        nStr += '';
        x = nStr.split(decSeperate);
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
        }
        return x1 + x2;
    }

    function randomCode(num) {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < num; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }

    $(document).on('click', '.delete-item-product', function () {
        var totalRowCount = $("#table-import-product tr").length;
        var _that = $(this);
        if ( totalRowCount > 2 ) {
            $.confirm({
                title: 'Warning ?',
                content: 'Are you sure you want to perform this operation.',
                type: 'green',
                buttons: {
                    ok: {
                        text: "ok!",
                        btnClass: 'btn-primary',
                        keys: ['enter'],
                        action: function(){
                            _that.parent().parent().remove();
                        }
                    },
                    cancel: {
                        btnClass: 'btn-danger',
                    },
                }
            });
        } else {
            $.confirm({
                title: 'Warning ?',
                content: 'Borrowers need to have at least 1 product.',
                type: 'green',
                buttons: {
                    ok: {
                        text: "ok!",
                        btnClass: 'btn-primary',
                        keys: ['enter'],
                        action: function(){
                        }
                    }
                }
            });
        }
    });

    $(document).on('change', '.pw_total_number', function () {

        var __that = $(this)
        var number_book = $(this).val();
        var location = $(this).attr('total_number_location');
        var id_book = $('.pw_product_id_'+location).val();
        if (id_book == '') {
            alert('Vui lòng chọn sách cần mượn');
            $(this).val(0);
        }

        $.ajax({
            url: check_book,
            type: 'GET',
            dataType: 'json',
            data : {
                'number_book' : number_book,
                'id_book' : id_book
            }
        }).done(function (result) {
            if (result.code == 405) {
                alert(result.message)
                __that.val(0);
                return false;
            }
        })
        console.log(number_book, location, id_book)
    });


});



