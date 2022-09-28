window.addEventListener('alert', event => {
    console.log('Catch it!!!')
    toastr[event.detail.type](event.detail.message,
        event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
});
$(document).ready(function () {
    $("tbody").on("click", "button[name='updown']", function () {
        let url = $(this).data('url')
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html', // added data type
            success: function (response) {
                $("tbody").html(response)
            }
        });

    });
    let $btnSearch = $("button#btn-search");
    let $btnClearSearch = $("button#btn-clear-search");

    let $inputSearchField = $("input[name  = search_field]");
    let $inputSearchValue = $("input[name  = search_value]");
    let $selectChangeAttr = $("select[name = select_change_attr]");

    $("a.select-field").click(function (e) {
        e.preventDefault();

        let field = $(this).data("field");
        let fieldName = $(this).html();
        $("button.btn-active-field").html(
            fieldName + ' <span class="caret"></span>'
        );
        $inputSearchField.val(field);
    });

    $btnSearch.click(function () {
        var pathname = window.location.pathname;
        let params = ["filter_status"];
        let searchParams = new URLSearchParams(window.location.search); // ?filter_status=active

        let link = "";
        $.each(params, function (key, param) {
            // filter_status
            if (searchParams.has(param)) {
                link += param + "=" + searchParams.get(param) + "&"; // filter_status=active
            }
        });

        let search_field = $inputSearchField.val();
        let search_value = $inputSearchValue.val();

        if (search_value.replace(/\s/g, "") == "") {
            alert("Nhập vào giá trị cần tìm !!");
        } else {
            window.location.href =
                pathname +
                "?" +
                link +
                "search_field=" +
                search_field +
                "&search_value=" +
                search_value;
        }
    });

    $btnClearSearch.click(function () {
        var pathname = window.location.pathname;
        let searchParams = new URLSearchParams(window.location.search);

        params = ["filter_status"];

        let link = "";
        $.each(params, function (key, param) {
            if (searchParams.has(param)) {
                link += param + "=" + searchParams.get(param) + "&";
            }
        });

        window.location.href = pathname + "?" + link.slice(0, -1);
    });

    $(".btn-delete").on("click", function () {
        if (!confirm("Bạn có chắc muốn xóa phần tử?")) return false;
    });

    $('table').on('change', "select[name='select_change_attr']", function () {
        var element = $(this)
        let url = $(this).data('url')
        let val = $(element).val()
        url = url.replace('value_new', val)
        console.log(url);
        $.get(url, function (data) {
            console.log(data)
            $(element).data('url', data.link)
            $.notify("Cập nhật thành công", {
                position: "top center",
                className: "success",
            });
        })
    })
    $('table').on('click', '.status-ajax', function () {
        let url = $(this).data('url')
        var element = $(this)
        let removeClass = $(element).data('class')
        $(element).removeClass(removeClass)
        $.get(url, function (data) {
            $(element).data('url', data.link)
            $(element).data('class', data.statusObj.class)
            $(element).text(data.statusObj.name)
            let addClass = $(element).data('class')
            $(element).addClass(addClass)
            $.notify("Cập nhật thành công", {
                position: "top center",
                className: "success",
            });
        });
    });
    $('table').on('click', '.is-home-ajax', function () {
        let url = $(this).data('url')
        var element = $(this)
        let removeClass = $(element).data('class')
        $(element).removeClass(removeClass)
        $.get(url, function (data) {
            console.log(data)
            $(element).data('url', data.link)
            $(element).data('class', data.is_homeObj.class)
            $(element).text(data.is_homeObj.name)
            let addClass = $(element).data('class')
            $(element).addClass(addClass)
            $.notify("Cập nhật thành công", {
                position: "top center",
                className: "success",
            });
        });
    });
    /****  Nestedset ****/
    // activate Nestable for list 2

    $('#nestable3').nestable({

    })
        .on('change', function () {
            let dataMove = $('.dd').nestable('serialize');
            let url = $("input[name='curentUrl']").val();
            $.ajax({
                url: url + "/update-move",
                type: 'GET',
                dataType: 'json', // added data type
                data: { 'data': dataMove },
                success: function () {
                    $.notify("Cập nhật thành công", {
                        position: "top center",
                        className: "success",
                    });
                }
            });
        });

    /****  Nestedset End ****/

    /***  Select2  ***/
    $(document).ready(function () {
        $('.select2-dropdown').select2();
        $('.select2-dropdown').on('change', function (e) {
            var data = $('#select2-dropdown').select2("val");
            // this.set('ottPlatform', data);
        });
    });
    /***  Select2 End ***/

    /*** File multiply upload */
    $(".btn-add-image").click(function () {
        console.log('clicked btn-add-image')
        $('#file_upload').trigger('click');
    });

    // event delegation
    $('.list-input-hidden-upload').on('change', '#file_upload', function (event) {
        let today = new Date();
        let time = today.getTime();
        let image = event.target.files[0];
        let name = $("input[name='name']").val();
        let alt = name.replace(/\s/g, '+');
        let file_name = event.target.files[0].name;
        let box_image = $('<div class="box-image"></div>');
        box_image.append('<img src="' + URL.createObjectURL(image) + '" class="picture-box">');
        box_image.append('<input type="text" name="alt[]" value="' + alt + '" id="alt-{{ $key }}" class="images_alt">');
        box_image.append('<div class="wrap-btn-delete"><span data-id=' + time + ' class="btn-delete-image">x</span></div>');
        $(".list-images").append(box_image);
        $(this).removeAttr('id');
        $(this).attr('id', time);
        let input_type_file = '<input type="file" name="filenames[]" id="file_upload" class="myfrm form-control hidden">';
        $('.list-input-hidden-upload').append(input_type_file);
    });

    $(".list-images").on('click', '.btn-delete-image', function () {
        let id = $(this).data('id');
        $('#' + id).remove();
        $(this).parents('.box-image').remove();
    });
    /** Format Price */
    $('.format-price').priceFormat({
        prefix: '',
        suffix: ' đ',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });

    let number_Atrr = 3; //Limit for attribute
    let attr_id = 0;
    /*** Add row */
    $(".attribute").on('click', '#add-attr', function () {
        $("#save-attr").removeClass('invisible');
        if (attr_id < number_Atrr) {
            attr_id++;
            let html = '<div class="form-group attribute-product">'
                + '<div class="col-md-2 col-sm-2 col-xs-2">'
                + '<input type="text" class="form-control" name="attribute_name[]">'
                + '</div>'
                + '<div class="col-md-6 col-sm-6 col-xs-6">'
                + '<textarea class="form-control" name="attribute_value[]" id="attr_id_' + attr_id + '"></textarea>'
                + '</div>'
                + ' <span class="btn btn-danger btn-delete-attr">x</span></div>'

            $(".attribute").append(html)
            let input = document.querySelector("#attr_id_" + attr_id);
            tagify = new Tagify(input);
        } else {
            attr_id = number_Atrr
            $.notify("Chỉ cho phép tối đa " + number_Atrr + " phân nhóm thuộc tính", {
                position: "top center",
                className: "error",
            });

        }

    });
    /*** Remove row */
    $(".attribute").on('click', '.btn-delete-attr', function () {
        $(this).parents('.attribute-product').remove();
        attr_id = attr_id - 1;
        if (attr_id == 0) {
            $("#save-attr").addClass('invisible');
        }
    });

    $(".variation").on('click', '.btn-delete-variation', function () {
        if (confirm("Bạn có chắc muốn xóa phần tử?")) {
            let id = $(this).data('id');
            let element = $(this)
            let url = $("input[name='curentUrl']").val();
            url = url + "delete-variable-element?id=" + id ;
            console.log(url);
            $.get(url , function (data) {
                if(data.status == 'success'){
                    $.notify("Cập nhật thành công", {
                        position: "top center",
                        className: "success",
                    });
                    $(element).parents('.variation-product').remove();
                }      
            })
        }
    });
    /*** Validate when click Save Attribute */
    $(".attribute").on('click', '#save-attr', function () {
        var flag_01 = true
        var flag_02 = true
        let attribute = []
        $.each($("input[name='attribute_name[]']"), function (key, value) {
            let result = $(value).val()
            let row = key + 1
            let attribute_name = result.trim()
            if (attribute_name.length == 0) {
                flag_01 = false
                $.notify("Type Of Attribute: Dòng thứ " + row + " không được rỗng! Hãy thêm hoặc xoá", {
                    position: "top center",
                    className: "error",
                })
            } else {
                attribute.push(attribute_name)
            }
        });

        var atrribute_value = []
        $.each($("tags"), function (key, value) {
            let result = $(value).hasClass('tagify--empty')
            let row = key + 1
            if (result == true) {
                flag_02 = false
                $.notify("Value Of Attribute: Dòng thứ " + row + " không được rỗng! Hãy thêm hoặc xoá", {
                    position: "top center",
                    className: "error",
                });
            } else {
                let valueArray = value.children;
                let number = valueArray.length
                let value_01 = []
                for (i = 0; i < (number - 1); i++) {
                    value_01.push(valueArray[i].getAttribute('value'))
                }
                atrribute_value.push(value_01)
            }
        });
        if (flag_01 == true && flag_02 == true) {
            //Do ajax
            let url = $("input[name='curentUrl']").val();
            let product_id = $("input[name='id']").val();
            $.ajax({
                url: url + "ajax-variation",
                data: { 'data': { 'attribute': attribute, 'attribute_value': atrribute_value, 'product_id': product_id } },
                method: "Get",
                type: "json",
            }).done(function (response) {
                $(".variation").html(response)
                $('.format-price').priceFormat({
                    prefix: '',
                    suffix: ' đ',
                    centsSeparator: ',',
                    thousandsSeparator: '.'
                });
                $("input[name='id']").val();
                console.log($("input[name='id']").val())
            });
        }
    });

    /*********** ATTRIBUTE OPTION END **********/
    /*********** CLICK DRAFT **********/
    $("#main-form").on('click', '#save-draft', function () {
        let url = $("input[name='curentUrl']").val();
        $("#main-form").attr('action', url + 'save-draft')
        $("#main-form").submit()
    })
    /*********** CLICK DRAFT END **********/
});


/** Tagify */
const allInputs = document.querySelectorAll(".tag_name")
allInputs.forEach(element => {
    new Tagify(element)
});
/** Tagify for textarea */
