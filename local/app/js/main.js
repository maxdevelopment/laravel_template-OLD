$(function(){
    $.ajaxSetup({
        type: "POST"
    });
}).ajaxStart(function(){
    $(".loader").show();
}).ajaxStop(function(){
    $(".loader").hide();
});

function AlertMsg(type, msg) {
    switch(type) {
        case 'warning':
            $(".jq_result").empty();
            $("<div/>", {
                    class: "alert bg-danger",
                    text: msg,
                }).appendTo(".jq_result");
            break;
        case 'success':
            $(".jq_result").empty();
            $("<div/>", {
                    class: "alert bg-success",
                    text: msg,
                }).appendTo(".jq_result");
            break;
    }
}

function AddToCart(id) {
    var data = $(".addtocart_" + id).serialize();
    $.ajax({
        url: "addtocart",
        data: data,
        success: function(result) {
            switch(result) {
                case '0':
                    alert('please, choose a number of goods');
                    break;
                case 'err':
                    alert('already added');
                    break;
                default:
                if (!$(".addtocart a.bg-success").attr('onclick')) 
                    $(".addtocart a.bg-success").attr("onclick", "ViewCart();");
                $(".addtocart span.productnum").empty().html(result);
            }
        }
    });
}

function AddAddress() {
    var data = $(".formaddaddress").serialize();
    $.ajax({
        url: "addaddress",
        data: data,
        success: function(result) {
            try {
                json = $.parseJSON(result);
                $(".erroraddress").empty();
                    for (var i in json) {
                        for (var j in json[i]) {
                          $(".erroraddress").append("<p class='bg-danger'>" + json[i][j] + "</p><br />");
                        }
                    }
                } catch (e) {
                AlertMsg('success', result);
                ViewAddress();
            }
        }
    });
}

function ViewCart() {
    $.ajax({
        url: "viewcart",
        success: function(result) {
            $(".row:first-child").empty().html(result);
        }
    });
}

function ChangeCounter(id, del) {
    var data = $(".changecounter_" + id).serializeArray();
    del = del || 0;
    if (del !== 0) {
        if(confirm('Are you sure?')) {
            arr = {name: "many", value: "0"};
            data.splice(2,1, arr);
        } else {
            return;
        }
    }
    $.ajax({
        url: "editcart",
        data: data,
        success: function(result) {
            switch(result) {
                case '0':
                    $(".addtocart span.productnum").empty().html(result);
                    $(".addtocart a.bg-success").removeAttr('onclick');
                    $(".row:first-child").empty().html('Your shopping cart is empty');
                    break;
                default:
                    $(".addtocart span.productnum").empty().html(result);
                    ViewCart();
            }
        }
    });
}

function Processing() {
    $.ajax({
        url: "processing",
        success: function(result) {
            $(".row:first-child").empty().html(result);
        }
    });
}

function ViewAddress() {
    $.ajax({
        url: "viewaddress",
        success: function(result) {
            $(".row:first-child").empty().html(result);
        }
    });
}

function ViewAddressForm() {
    if ($(".addaddress").is(":empty")) {
        $.ajax({
            url: "viewaddressform",
            success: function(result) {
                $(".addaddress").empty().html(result);
            }
        });
    } else {
        $(".addaddress").empty();
    }
}

function UpdateDeleteAddressForm(id, del) {
    del = del || 0;
    var data = {
        del: del,
        id: id
    };
    if ($(".addaddress").is(":empty")) {
        $.ajax({
            url: "updeladdress",
            data: data,
            success: function(result) {
                if (result === 'deleted') {
                    AlertMsg('warning', result);
                    ViewAddress();
                } else {
                    $(".addaddress").empty().html(result);
                }
            }
        });
    } else {
        $(".addaddress").empty();
    }
}