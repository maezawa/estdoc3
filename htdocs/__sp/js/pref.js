;(function(){
	$('.pref li').on('click', function(e){
		var target = $(e.target);
		target.children('span').toggleClass('toggled');
		target.children('ul').toggle();
	});

	$('.pref li > span').on('click', function(e){
		var target = $(e.target);
		target.toggleClass('toggled');
		target.next('ul').toggle();
	});
})();