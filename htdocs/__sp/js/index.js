;(function(){
	$('.main').children('a').on('click', function(e){
		e.preventDefault();
		$('main').css('display', 'none');
		$($(this)[0].hash).css('right', '0')
	});

	$('a.back').on('click', function(e){
		e.preventDefault();
		$(this).parents('section').css('right', '-100%');
		$('main').css('display', 'block');
		scrollTo(0, 0);
	});
})();