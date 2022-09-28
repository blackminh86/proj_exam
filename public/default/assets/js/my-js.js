$(document).ready(function () {
    calculateBill();
   
    $("#filter-tabs > li").each(function (index) {
        $(this).click(function () {
            let result = $(this).hasClass('active')
            if (result == false) {
                let page = $("input[name = 'current_page']").val()
                $(".pagination-container > ul > li").each(function (index) {
                    if (index + 1 == page) {
                        $(this).addClass('active')
                    }
                })
                if (index == 0) {
                    $("input[name='display']").val('grid')
                } else {
                    $("input[name='display']").val('list')
                }
            }
        })
    });

    if ($("input[name='total-attr']").val() == 0 && $("#stock").text() == "Còn hàng") {
        $(".quantity-container").show()
    }

    $(".quant-input").on("click", ".arrow", function () {
        let id    = $(this).data('id')
        let element = this
        let value = $("#quant"+'-'+id).val(); 
        if ($(element).hasClass("plus")) {
            value++
            value = (value >= 10) ? 10 : value
        } else {
            value--
            value = (value <= 0) ? 1 : value
        }
        value = $("#quant"+'-'+id).val(value)
        calculateBill()
        updateShopingCart()
    })

});

function clickPage(number) {
    $(".pagination-container > ul > li").removeClass('active')
    let page = number
    let display = $("input[name = 'display']").val()
    let category_id = $("input[name = 'category_id']").val()
    let sortBy = $("input[name = 'price']").val()
    let distancePrice = $("input[name = 'distancePrice']").val()
    $("input[name = 'current_page']").val(page)
    let url = $("#ajax-form").attr('action')
    let data = '?category_id=' + category_id + '&current_page=' + page + '&display=' + display +
        '&price=' + sortBy + '&distancePrice=' + distancePrice

    $.get(url + data, function (data) {
        $("#myTabContent").html(data)
        let maxPage = $("input[name = 'maxPage']").val()
        if (maxPage != '') {
            $(".pagination-container > ul > li").each(function (index) {
                if (index + 1 > maxPage) {
                    $(this).hide()
                }
            })
        }
    })
}
function changeOrdering(orderBy) {
    let value = (orderBy == 'asc') ? 'Lowest' : 'Highest'
    $("#filter-position").text(value)
    $("input[name = 'price']").val(orderBy)
    clickPage(0)
    $(".pagination-container > ul > li").each(function (index) {
        if (index == 0) {
            $(this).addClass('active')
        }
    })
}
function clickPriceSlider() {
    $("#f5").show()
    $(".pagination-container > ul > li").each(function (index) {
        $(this).show()
    })
    let value = $(".price-slider").val()
    $("input[name = 'distancePrice']").val(value)
    clickPage(0)
    $(".pagination-container > ul > li").each(function (index) {
        if (index == 0) {
            $(this).addClass('active')
        }
    })
}
function callVariation() {
    let product_id = $("input[name='product_id']").val()
    let url = $("input[name='variable_url']").val()
    var data = {}
    data.product_id = product_id;
    data.attribute_value = []
    let i = 0

    $(".btn-attr").each(function () {
        if ($(this).hasClass('btn-info')) {
            let id = $(this).val()
            console.log('i = '+ i +' id= '+ id)
            data.attribute_value[i] = id
            i++
        }
        console.log(data)
        $.ajax({
            url: url,
            type: "GET",
            data: { 'data': data },
            dataType: 'json'
        }).done(function (data) {
            console.log(data)
            $("#variable").text(data[0].name)
            $("input[name='variable_name']").val(data[0].name)
            $("input[name='variable_id']").val(data[0].id)
            let status = data[0].status
            if (status == "active") {
                $(".quantity-container").show()
            } else {
                $(".quantity-container").hide()
            }
            status = (status == "active") ? 'Còn hàng' : 'Hết hàng'
            $("#stock").text(status)
            let price = (data[0].price >> 0) ? data[0].price : 0
            $("input[name='variable_price']").val(price)
            price  = formatNumber(price)
            $("#price").text(price + ' đ')

        });
    })
}
function formatNumber(number){
    number = String(number).replace(/(.)(?=(\d{3})+$)/g, '$1,')
    return number
}
function clickCart(id) {
    let product_id = id;
    let variable_id = $("input[name='variable_id']").val();
    let variable_name = $("input[name='variable_name']").val();
    let quantity = $("#quant"+'-'+id).val();
    let price = $("input[name='variable_price']").val();
    var key = product_id + '-' + variable_id;
    let objStr = '{"' + key + '":{"product_id":' + product_id + ', "variable_id":' + variable_id + ' , "variable_name":"' + variable_name + '" ,"quantity":' + quantity + ', "price":' + price + '}}'
    let data = JSON.parse(objStr)
    let url = $("input[name='cart_url']").val()
    $.ajax({
        url: url,
        type: "GET",
        data: { 'data': data },
        dataType: 'json'
    }).done(function (data) {
      $(".basket-item-count > .count").text(data.itemsCart)
    });
    
}
function calculateBill(){
    let sub = 0
    $(".quant-input").each(function(){
        let id      = $(this).data('id')
        let quant   = $("#quant-"+id).val()
        let price   = $("#price-"+id).data('price')
        let total   = quant * price
        $("#total-"+id).attr('data-total',total)
        sub += total
        total  = formatNumber(total)
        $("#total-"+id).text(total)
        price  = formatNumber(price)
        $("#price-"+id).text(price)
    })
    $("#sub-total").attr('data-sub',sub)
    sub  = formatNumber(sub)
    $("#sub-total").text(sub + ' đ')   
}
function removeCart(id){
    $("#"+id).remove();
    updateShopingCart();
}
function updateShopingCart(){
    var data = []
    $("[name='row-cart']").each(function(key){
        let id      = $(this).data('id')
        let product_id    = $("#product_id-"+id).text();
        let variable_id   = $("#variable_id-"+id).text();
        let variable_name = $("variable_name-"+id).text();
        let quantity      = $("#quant"+'-'+id).val();
        let price         = $("#price"+'-'+id).data('price');
        let objStr = '{"' + id + '":{"product_id":' + product_id + ', "variable_id":' + variable_id + ' , "variable_name":"' + variable_name + '" ,"quantity":' + quantity + ', "price":' + price + '}}'
        let obj = JSON.parse(objStr)
        data.push(obj)
    })
    let url = $("input[name='update_cart_url']").val()
    $.ajax({
        url: url,
        type: "GET",
        data: { 'data': data },
        dataType: 'json'
    }).done(function (data) {
      //alert("Your cart updated a successfully")
    }); 
}
function submitContact(){
let name    = $("[name='name']").val()
let email   = $("[name='email']").val()
let title   = $("[name='title']").val()
let content = $("[name='content']").val()
let data    = {'name': name , 'email': email , 'title': title , 'content': content }
let url     = $("[name='action']").val()
$.ajax({
    url: url,
    type: "GET",
    data: { 'data': data },
    dataType: 'html'
}).done(function (data) {
  $(".contact-form").html(data)
});

}
function clickCheckOut(){
    //updateShopingCart()
    //let url = $("input[name='checkout-url']").val()
    //window.location.replace(url)
    $("#info-form").submit(function( event ) {
        alert( "Handler for .submit() called." );
        event.preventDefault();
      });
}
function clickVarition(id){
        let total_Attr = 0;
        let num = $("input[name='total-attr']").val()
        let name = $("#variable_"+id).attr('name')
        let element = $("#variable_"+id)
//Xoa button co cung name 
        $("button[name='" + name + "']").each(function () {
            if ($(this).hasClass('btn-info')) {
                $(this).removeClass('btn-info')
            }
        })
//Them button moi
        $(element).addClass('btn-info')
        
        $(".btn-attr").each(function () {
            if ($(this).hasClass('btn-info')) {
                total_Attr++ ;
            }   
            if (num == total_Attr) {
                console.log(num , total_Attr)
                total_Attr = 0 
                callVariation()
            }
        })
}

function searchOption(id , name){
    $("#option_search").text(name)
    $("#search_category_id").val(id)
}
