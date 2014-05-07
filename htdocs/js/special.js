;(function(){
	/*
	 * クイックサーチフォームからresult.phpにsubmitする
	 */
	$('.button.qresearch').on('click', function(e){
		e.preventDefault();

		var form = $(this).parent('form');
		var o = {
			form: form,
			ajaxSend: form.serializeArray(),
			sendData: form.serialize(),
			api: 'http://api.estdoc.jp/geo'
		};

		if (o.ajaxSend[1].value != '' && o.ajaxSend[2].value == ''){
			$.ajax({
				type: 'GET',
				url: o.api,
				dataType: 'jsonp',
				data: { name: o.ajaxSend[1].value },
				success: function(data){
					(data.body.length > 0) && form.children('input[name=Area]').val(data.body[0].Latlng);
					var sendData = form.serialize();
					$(form).submit();
				}
			});
		}else{
			$(form).submit();
		}
	});

})();