;(function(){
	$('#agree').on('change', function(e){
		e.preventDefault();
		$(this).is(':checked') ? $('.send').removeAttr('disabled') : $('.send').attr('disabled', 'disabled');
	});

	$('.send').on('click', function(e){
		e.preventDefault();
		var data = $('form').serialize();

		$.post('/feedback.php', data, function(res){
			console.log(res);
			if (res){
				var form  = $('form');
				var name  = form.children('#name').val();
				var mail  = form.children('#email').val();
				var title = form.children('#subject').val();
				var body  = form.children('#contents').val();
				body.replace("\n\r", "<br>");

				$('#InputedName').text(name);
				$('#InputedEmail').text(mail);
				$('#InputedTitle').text(title);
				$('#InputedContents').html(body);

				$('#Input').hide();
				$('#Thanks').show();
			}
		});
	});
})();