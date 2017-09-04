$(function(){
	$(document).on('click', '#wishlist-remove-btn',function(e){
		e.preventDefault();

        var $this = $(this);
		var wishId = $(this).attr("wishlist_item_id");

        $this.attr('disabled', 'disabled');

		$.ajax({
			url: '/local/components/intaro/wishlist.remove/ajax.php',
			type: 'POST',
			data: {wishId: wishId},
			success: function(data){
				$this.replaceWith(data);
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
});