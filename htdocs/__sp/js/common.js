;(function(){
	// Main Menu Toggle
	$('button.main_menu').on('click', function(){
		$('menu').toggleClass('on');
		$('menu').hasClass('on') ? $(this).text('閉じる') : $(this).text('Menu');
	});

	//a.detailSearch click event
	$('a.detailSearch').on('click', function(e){
		e.preventDefault();
		$('#Detail').toggle();
		$('menu').hasClass('on') && ($('menu').removeClass('on'), $('button.main_menu').text('Menu'));
	});

	// a.reset click event
	$('a.reset').on('click', function(){
		$(this).prev('#Area').val('');
		$(this).prev('#Area').focus();
	})

	// .close click event
	$('.close').on('click', function(){
		$(this).parents('section').toggle();
	});
})();