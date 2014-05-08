;(function(){
	var suggestData = [];
	var ajaxComboBoxOption = 		{
		field:        'Word',
		primary_key:  'Latlng'
	};

	$('#searchQuick #QArea').ajaxComboBox(
		suggestData,
		ajaxComboBoxOption
	);

	$('#formDetailSearch #DArea').ajaxComboBox(
		suggestData,
		ajaxComboBoxOption
	);

	// button.serviceMore click event
	$('button.serviceMore').on('click', function(){
		var div = $(this).prev('div');
		div.toggleClass('on');
		div.hasClass('on') ? $(this).text('折り畳む') : $(this).text('もっと見る');
	});

	// button#toggleDetail click event
	$('#toggleDetail').on('click', function(){
		var div = $('#detail');
		var hour = $('#searchQuick #form_time').val();
		$('#detail #selectCategory').val($('#searchQuick #selectCategory').val());
		$('#DArea').val($('#QArea').val());
		$('#DArea_').val($('#QArea_').val());
		$('#hs' + hour).attr('checked', true);

		div.toggleClass('show_detail');
		$('#quick').toggle();
		div.hasClass('show_detail') ? $(this).text('クイックサーチで検索') : $(this).text('詳しく条件指定して検索');
	});

	/*
	 * 詳細検索フォームからresult.phpにsubmitする
	 */
	$('.button.detailSearch').on('click', function(e){
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
					(data.body.length > 0) && form.children('dl').children('dd').children('input[name=Area]').val(data.body[0].Latlng);
					var sendData = form.serialize();
					$(form).submit();
				}
			});
		}else{
			$(form).submit();
		}
	});

})();