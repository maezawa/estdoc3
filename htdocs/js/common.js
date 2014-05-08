;(function(){
	var suggestData = [];
	var ajaxComboBoxOption = {
		field:        'Word',
		primary_key:  'Latlng'
	};

	$('.col2 .inputArea').ajaxComboBox(
		suggestData,
		ajaxComboBoxOption
	);

	$('#fixedHeader > .inputArea').ajaxComboBox(
		suggestData,
		ajaxComboBoxOption
	);

	/*
	 * スクロールしたら、ヘッダーを固定
	 */
	var header = $('header');
	var headerTop = header.height();
	var menu = $('#fixedHeader');
	var form = $('#searchFree');

	$(window).on('scroll', function(){
		var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		var y = (scrollTop >= headerTop) ? 0 : -200;
		(scrollTop >= headerTop) ? menu.append(form) : $('.col2').append(form);
		menu.css('top', y);
	});

	/*
	 * 検索フォームのenterキーの送信無効化
	 */
	$('form input[type="text"]').on('keypress', function(e){
		return e.which !== 13;
	});

	/*
	 * ヘッダー検索フォームからresult.phpにsubmitする
	 */
	$('.button.research').on('click', function(e){
		e.preventDefault();

		var form = $(this).parent('form');
		var o = {
			form: form,
			ajaxSend: form.serializeArray(),
			sendData: form.serialize(),
			api: '//api.estdoc.jp/geo'
		};

		if (o.ajaxSend[1].value != ''){
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

}());