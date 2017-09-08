$(document).ready(function(){
    var idArray = [];

    $('.wishlist-btn').each(function () {
        $thisAttr = $(this).attr("data-product-id");
        idArray.push($thisAttr);
    });

    $.ajax({
        url: '/local/components/intaro/wishlist.add/ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            idArray: idArray,
            action: "refresh"
        },
        success: function(data){
            showWishListButtons(data);
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert(msg);
        },
    });
});

function showWishListButtons(data){
    $.each(data, function (name, value) {
        if(value == false){
            $('.wishlist-btn[data-product-id=' + name + ']').find('.wishlist-btn-delete').show();
            $('.wishlist-btn[data-product-id=' + name + ']').find('.wishlist-btn-add').hide();
        }
        else{
            $('.wishlist-btn[data-product-id=' + name + ']').find('.wishlist-btn-delete').hide();
            $('.wishlist-btn[data-product-id=' + name + ']').find('.wishlist-btn-add').show();
        }
    });
}

$(document).on('click', '.wishlist-btn',function(e){
    e.preventDefault();

    var $this = $(this);
    var productId = $(this).attr("data-product-id");

    $this.attr('disabled', 'disabled');

    $.ajax({
        url: '/local/components/intaro/wishlist.add/ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            productId: productId,
            action: "add"
        },
        success: function(data){
            showWishListButtons(data);
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert(msg);
        },
        complete: function() {
            $this.removeAttr('disabled');
        }
    });
});