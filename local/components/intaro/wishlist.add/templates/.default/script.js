$(function(){
	$("wishlist-btn").click(function(e){
		e.preventDefault();

		var productId = $('.wishlist-add').attr('data-product-id');

		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {productId: productId},
			success: function(data){
				alert(data);
			}
		});
	});
});