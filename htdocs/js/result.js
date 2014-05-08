;(function(){
	var setDate = function(startDate){  // 一週間分の日付を表示
		var isToday = !startDate;
		var today = new Date();
		var st = startDate || Date.now();
		var li = $(this);
		var strDay = ['日', '月', '火', '水', '木', '金', '土'];

		li.each(function(i){
			var unixDt = new Date(st + i * 86400000);
			var d = {
				month: unixDt.getMonth() + 1,
				date: unixDt.getDate(),
				day: unixDt.getDay()
			}

			var txtDate = (isToday && i == 0) ? '本日' : d.month + '/' + d.date + '(' + strDay[d.day] + ')';
			d.day == 0 && $(this).addClass('holiday');
			d.day == 6 && $(this).addClass('saturday');
			$(this).html(txtDate);
			$(this).data('ut', Date.parse(unixDt));
			txtDate == '本日' && $(this).addClass('selectedDay');
		});
	};

	var getRsvTime = function(iid, unixDt){ // 指定日・指定医療機関の空き枠時刻表示
		var unixDt = unixDt || new Date();
		var mm = unixDt.getMonth() + 1;
		var dd = unixDt.getDate();
		var d = [unixDt.getFullYear(), ('00' + mm).slice(-2), ('00' + dd).slice(-2)];
		var date = d.reduce(function(v, w){ return v + '' + w;});
		var that = $(this);
		$(this).empty();

		$.ajax({
			type: 'GET',
			url: 'http://api.estdoc.jp/schedule/doctors',
			dataType: 'jsonp',
			data: { id: iid, date: date},
			success: function(data){
				if (typeof data.body[0] == 'undefined' || typeof data.body[0].Schedule[0] == 'undefined' || data.body[0].Schedule[0].Available.length < 1){
					$(that).addClass('txt_center');
					$(that).append('この日にご予約可能な時刻はございません。');
					return false;
				}
				$(that).removeClass('txt_center');

				var day  = data.body[0].Schedule[0].Day;
				var time = data.body[0].Schedule[0].Available;
				var btn = '';

				time.forEach(function(w){
					btn += '<a href="/doctor/reserve/index.php?publicId=' + iid + '&dt=' + day + ' ' + w + '" class="button rsv">' + w + '</a>';
				});
				$(that).append(btn);
			}
		});
	};

	// 左メニューの、エリア名・駅名入力のサジェスチョン有効化
	var suggestData = [];
	var ajaxComboBoxOption = {
		field:        'Word',
		primary_key:  'Latlng',
		plugin_type:  'simple'
	};

	$('#formDetailSearch .inputArea').ajaxComboBox(
		suggestData,
		ajaxComboBoxOption
	);

	// 空き枠表示
	$('.show_timeTable').on('click', function(e){
		e.preventDefault();
		var iid = $(this).data('iid');
		$('aside.a' + iid).css({
			'display': 'block',
			'height': 'auto',
			'-webkit-transition': 'height 150ms ease-in'
		});

		// 日付を表示
		setDate.apply($('aside.a' + iid).children('ul').children('li.d'), null);

		// 本日の空き枠を表示
		getRsvTime.call($('aside.a' + iid).children('.time_btns'), iid, null);
	});

	// 空き枠のボタン・イベント
	$('button.prev').on('click', function(e){
		e.preventDefault();
		var iid = $(this).parent('li').parent('ul').parent().data('iid');
		var li  = $(this).parent('li').parent('ul').children('li.d');
		var date = [$(li[0]).data('ut') - 86400000 * 7];
		$('li.d').each(function(){
			$(this).removeClass('selectedDay');
		});
		setDate.apply(li, date);
	});

	$('button.next').on('click', function(e){
		e.preventDefault();
		var iid = $(this).parent('li').parent('ul').parent().data('iid');
		var li  = $(this).parent('li').parent('ul').children('li.d');
		var date = [$(li[6]).data('ut') + 86400000 * 1];
		$('li.d').each(function(){
			$(this).removeClass('selectedDay');
		});
		setDate.apply(li, date);
	});

	// 空き枠の日付クリックイベント
	$('li.d').on('click', function(e){
		e.preventDefault();
		var iid = $(this).parent('ul').parent().data('iid');
		var unixDt = new Date($(this).data('ut'));
		getRsvTime.call($(this).parent('ul').next().next(), iid, unixDt);

		$('li.d').each(function(){
			$(this).removeClass('selectedDay');
		});

		$(this).addClass('selectedDay');
	});

	// 詳細検索ボタン　クリックイベント
	$('button.to_detail, #Detail button.close').on('click', function(e){
		e.preventDefault();
		var detail = $('#Detail');
		detail.toggleClass('on');
		detail.hasClass('on') ?
			$('header, section.container').each(function(){
				$(this).css({
					'filter'         : 'blur(3px)',
					'-webkit-filter' : 'blur(3px)',
					'-moz-filter'    : 'blur(3px)',
					'-o-filter'      : 'blur(3px)',
					'-ms-filter'     : 'blur(3px)'
				});
			}) :
			$('header, section.container').each(function(){
				$(this).css({
					'filter'         : 'none',
					'-webkit-filter' : 'none',
					'-moz-filter'    : 'none',
					'-o-filter'      : 'none',
					'-ms-filter'     : 'none'
				});
			});
	});

	// 空き枠で絞り込み
	$('a.filter').on('click', function(e){
		e.preventDefault();

		var today = Date.now();
		var unixDt = new Date(today + ($(this).data('date') * 86400000)); // 絞り込み対象日
		var mm = unixDt.getMonth() + 1;
		var dd = unixDt.getDate();
		var d = [unixDt.getFullYear(), ('00' + mm).slice(-2), ('00' + dd).slice(-2)];
		var date = d.reduce(function(v, w){ return v + '' + w;});
		var estHospital = markerData.filter(function(v){
			return v.flg == 'EST';
		});

		$.each(estHospital, function(index, item){
			var iid = item.id;
			$('div.pid' + iid).show();
			$.ajax({
				type: 'GET',
				url: '//api.estdoc.jp/schedule/doctors',
				dataType: 'jsonp',
				data: { id: iid, date: date},
				success: function(data){
					//console.log(data.body[0]);
					if (typeof data.body[0] == 'undefined' || typeof data.body[0].Schedule[0] == 'undefined' || data.body[0].Schedule[0].Available.length < 1){
						$('div.pid' + iid).hide();
					}
				}
			});
		});

		$('.show_timeTable').trigger('click');
	});


	$('button.detailSearch').on('click', function(e){
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

	// ページトップへ戻すボタン
	$(window).on('scroll', function(){
		var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		(scrollTop > 500) ? $('#toTop').show() : $('#toTop').hide();
	});

	$(window).on('resize', function(){
		($(window).width() < 1250) ? $('#toTop').addClass('toTop_on') : $('#toTop').removeClass('toTop_on');
	});

	$('#toTop').on('click', function(e){
		e.preventDefault();
		$(window).scrollTop(0);
	});

//	$('#date').on('click', function(e){
//		e.preventDefault();
//		$('.calendar-box').toggle();
//	});

}());


/*
 This works for the sub navigation which you can see on the left side of the site.
 */
;(function(){
	var sideArea = $('#sideArea');

	// タップ or ロールオーバーでサブメニューを表示
	sideArea.on('click mouseover', '#selectArea li', function(){
		$(this).addClass('on');
		$(this).children('.nav_submenu').css({
			'display': 'block'
		});
	});

	// マウスアウトでサブメニューを非表示
	sideArea.on('mouseout', '#selectArea li', function(){
		$(this).removeClass('on');
		$(this).children('.nav_submenu').css('display', 'none');
	});

	sideArea.on('mouseout', '.nav_submenu', function(){
		$(this).css('display', 'none');
	});

	// サブメニューの［閉じる］を押したらサブメニューを非表示
	sideArea.on('click', 'button.close', function(){
		$(this).parents('.nav_submenu').css('display', 'none');
	});

	sideArea.on('change', 'label', function(){
		$(this).children('li').toggleClass('on');
	});
}());


/*
 This works for google Map
 */
;(function(){
	var mapDom = $('#map');
	$ui.showMap({lat: mapDom.data('lat'), lng: mapDom.data('lng'), dom: document.getElementById('map'), zoom: 14}, markerData);
}());