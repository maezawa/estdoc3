/*
 * Step 1
 */
;(function(){
	$('#Step2').hide();
	$('#NG').hide();

	// 地図の表示
	var mapDom = $('#map');
	$ui.showMap({lat: mapDom.data('lat'), lng: mapDom.data('lng'), dom: document.getElementById('map'), zoom: 15});

	// 「当院の利用は初めて、または1カ月以上前ですか？」のいずれかがチェックされた時にlabelの背景を変える
	$('#yes').on('checked', function(){
		$(this).parent('label').css('background-color', '#1da1da');
	});
	$('#no').on('checked', function(){
		$(this).parent('label').css('background-color', '#1da1da');
	});

	$('#yes').on('change', function(){
		$(this).parent('label').toggleClass('check_on');
		$('#no').parent('label').removeClass('check_on');
	});

	$('#no').on('change', function(){
		$(this).parent('label').toggleClass('check_on');
		$('#yes').parent('label').removeClass('check_on');
	});

	// 利用規約への同意checkboxのトグル
	$('#agree').on('change', function(){
		($(this).attr('checked')) ? $('#toStep2').removeAttr('disabled') : $('#toStep2').attr('disabled', 'disabled');
	});

	// [予約内容を確認する]ボタンの押下イベント
	$('#toStep2').on('click', function(){
		$('.error').hide();

		var last  = $('#last_name_kana').val();
		var first = $('#first_name_kana').val();
		var email = $('#form_email').val();
		var tel   = $('#form_tel').val();
		var valid = false;
		valid |= (last  == '') && !!$('.last').show();
		valid |= (first == '') && !!$('.first').show();
		valid |= (tel   == '') && !!$('.tel').show();
		valid |= (!(email.match(/^[A-Za-z0-9]+[\w\.-]+@[\w\.-]+\.\w{2,}$/))) && !!$('.email').show();

		(!valid) && (function(){
			$('.error').hide();
			$('#Step1').hide();
			var str = $('#memo').val();
			str = str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
			$('.confirm.n').children('b').text(last + '　' + first);  // 姓名（フリガナ）
			$('.confirm.e').children('b').text(email);  // メールアドレス
			$('.confirm.t').children('b').text(tel);  // 電話番号
			$('.confirm.r').children('b').text(($('#Reserve1 #yes').attr('checked')) ? 'はい' : 'いいえ');  // 通院歴
			$('.confirm.w').children('b').html(str.replace(/\r?\n/g, "<br>"));  // 症状
			$('#Step2').show();
			$('#Step3').hide();
		})();
	});

	// [もどる]ボタンの押下イベント
	$('#toBack').on('click', function(){
		history.back(-1);
	});

})();

/*
 * Step 2
 */
;(function(){
	// [もどって書き直す]ボタンの押下イベント
	$('#toStep1').on('click', function(){
		$('#Step1').show();
		$('#Step2').hide();
		$('#NG').hide();
	});

	// [この内容で予約する]ボタンの押下イベント（APIに送信）
	$('#Submit').on('click', function(){
		//The following code starts the animation
		var memo = $('#memo').val();
		var unixTime = ~~(Date.parse($('#dt').val()) / 1000);
		$('#memo').val(memo.replace(/\r?\n/g, "<br>"));
		$('#dt').val(unixTime);
		var send = $('#Reserve1').serialize();


		$.ajax({
			type: 'GET',
			url: 'http://api.estdoc.jp/post_reservation',
			dataType: 'jsonp',
			data: send,
			success: function(data){
				var res = data.body[0]; // res.status = { Error | Success }
				console.log(res.status);

				(res.status === 'Error') ?
					(function(){
						// エラーメッセージを#NG #ErrorMsg>spanに挿入
						$('#ErrorMsg').children('span').text(res.error);
						// Section#NGを表示
						$('#Step1').hide();
						$('#Step2').hide();
						$('#NG').show();
					})() :
					(function(){	// レスポンス・ステータスがOKの場合

					})();
			},
			error: function(xhr, type){
				console.log(xhr);
				console.log(type);
				alert("通信エラーが発生しました。\nしばらく経ってからお手続きお願い致します。");
				return false;
			}
		});
	});
})();