/*price range*/

 $('#sl2').slider();

 $('.catalog').dcAccordion();
	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};

/*

	$('#card .table-t').on('click','.clear1' function (e){
		e.preventDefault();
		var id = $(this).data('id')
	$.ajax({
		url:'/cart/clear',
		type: 'GET',
		success: function(res){
			if(!res) alert('Хмм... Какая то ошибка');
			if(res) alert('Карзина очищена!');
		},
		error: function (){
			alert('Ошибочка вышла!');
		}

	});

*/


function showCart(cart){
	$('#cart .modal-body') .html(cart);
	$('#cart') .modal();
}

$('.add-to-cart').on('click', function (e){
	e.preventDefault();
	var id = $(this).data('id')
	$.ajax({
		url:'/cart/add',
		data: {id:id},
		type: 'GET',
		success: function(res){
			console.log(res);
			showCart(res);
		},
		error: function (){
			alert('Error!');
		}

	});
});





/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});
