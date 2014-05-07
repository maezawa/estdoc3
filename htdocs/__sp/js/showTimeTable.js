var setDate = function(startDate){  // 一週間分の日付を表示
	var isToday = !startDate;
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
	});
};

var getRsvTime = function(iid, unixDt){ // 指定日・指定医療機関の空き枠時刻表示
	var unixDt = unixDt || new Date();
	var mm = unixDt.getMonth() + 1;
	var dd = unixDt.getDate();
	var d = [unixDt.getFullYear(), ('00' + mm).slice(-2), ('00' + dd).slice(-2)];
	var date = d.reduce(function(v, w){ return v + '' + w;});
	var that = $(this);
	console.log($(this));
	$(this).empty();

//		console.log($(this));
	console.log('http://api.estdoc.jp/schedule/doctors?id=' + iid + '&date=' + date);

	$.ajax({
		type: 'GET',
		url: 'http://api.estdoc.jp/schedule/doctors',
		dataType: 'jsonp',
		data: { id: iid, date: date},
		success: function(data){
//				console.log(data.body[0].Schedule[0] || null);
			if (typeof data.body[0] == 'undefined' || typeof data.body[0].Schedule[0] == 'undefined' || data.body[0].Schedule[0].Available.length < 1){
				$(that).addClass('txt_center');
				$(that).append('この日にご予約可能な時刻はございません。');
				return false;
			}
			$(that).removeClass('txt_center');

			var day  = data.body[0].Schedule[0].Day;
			var time = data.body[0].Schedule[0].Available;

			time.reduce(function(v, w){
				console.log(day + ':' + w);
				var btn = '<a href="/doctor/reserve/index.php?publicId=' + iid + '&dt=' + day + ' ' + w + '" class="button rsv">' + w + '</a>';
				$(that).append(btn);
			});
		}
	});
};
