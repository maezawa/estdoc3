;(function(){
	var iid = $('#schedule').data('iid');

	var setDate = function(startDate){  // 一週間分の日付を表示
		var isToday = !startDate;
		var st = startDate || Date.now();
		var th = $(this);
		var strDay = ['日', '月', '火', '水', '木', '金', '土'];

		th.each(function(i){
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
				var i = 0;

				time.forEach(function(w){
					var isHide = '';
					i == 10 && $(that).append('<button class="button small green more">もっと見る</button>')
						.on('click', function(e){
							if ($(e.target).hasClass('more')){
								$(this).children('.hide').toggleClass('on');
								$(this).children('.hide').hasClass('on') ? $(this).children('.more').text('閉じる') : $(this).children('.more').text('もっと見る');
							}
						});
					i >= 10 && (isHide = ' hide');
					var btn = '<a href="/doctor/reserve/index.php?publicId=' + iid + '&dt=' + day + ' ' + w + '" class="button rsv' + isHide + '">' + w + '</a>';
					$(that).append(btn);
					i++;
				});
			}
		});
	};

	// 日付を表示
	setDate.apply($('#schedule tr').children('th.d'), null);

	// 週の空き枠を表示
	var th_0 = $('th.d')[0]
	$('#schedule tr').children('td').each(function(i){
		var unixDt = new Date($(th_0).data('ut') + 86400000 * i);
		getRsvTime.call($(this), iid, unixDt);
	});

	// 空き枠のボタン・イベント
	$('button.prev').on('click', function(e){
		e.preventDefault();
		var th  = $('th.d');
		var date = [$(th[0]).data('ut') - 86400000 * 7];
		setDate.apply(th, date);

		$('#schedule tr').children('td').each(function(i){
			var unixDt = new Date($(th_0).data('ut') + 86400000 * i);
			getRsvTime.call($(this), iid, unixDt);
		});
	});

	$('button.next').on('click', function(e){
		e.preventDefault();
		var th  = $('th.d');
		var date = [$(th[6]).data('ut') + 86400000 * 1];
		setDate.apply(th, date);

		$('#schedule tr').children('td').each(function(i){
			var unixDt = new Date($(th_0).data('ut') + 86400000 * i);
			getRsvTime.call($(this), iid, unixDt);
		});
	});


	// [もっと読む]の実装
	$ui.readMore();

	// 地図の表示
	var mapDom = $('#map');
	$ui.showMap({lat: mapDom.data('lat'), lng: mapDom.data('lng'), dom: document.getElementById('map')});
})();

;(function(){
	// easy lightbox
	$('ul.thumb li').on('click', function(e){
		e.preventDefault();
		var cssBlur = {
			'filter'         : 'blur(3px)',
			'-webkit-filter' : 'blur(3px)',
			'-moz-filter'    : 'blur(3px)',
			'-o-filter'      : 'blur(3px)',
			'-ms-filter'     : 'blur(3px)'
		};
		var cssNone = {
			'filter'         : 'none',
			'-webkit-filter' : 'none',
			'-moz-filter'    : 'none',
			'-o-filter'      : 'none',
			'-ms-filter'     : 'none'
		};
		var img = $(this).children('img');
		var imgSrc = img.attr('src');
		var htm = '<div id="LightBox"><div><img src="' + imgSrc + '"><br><button class="button close lightbox">閉じる</button></div></div>';

		$('header').css(cssBlur);
		$('footer').css(cssBlur);
		$('section.container').css(cssBlur);

		$('body').prepend(htm).on('click', '.lightbox, #LightBox', function(e){
			e.preventDefault();
			$('#LightBox').remove();
			$('header').css(cssNone);
			$('footer').css(cssNone);
			$('section.container').css(cssNone);
		});

	});
})();