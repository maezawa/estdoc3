;(function(){
	// [もっと読む]の実装
	$ui.readMore();

	// select#pagination event
	$('#pagination').on('change', function(e){
		e.preventDefault();
		location.href = $(this).val();
	})

	// button.nav click event
	$('button.nav').on('click', function(e){
		e.preventDefault();
		location.href = $(this).data('href');
	});

	// button.icon_reduce click event
	$('.icon_reduce').on('click', function(e){
		e.preventDefault();
		$('#Filter').toggle();
	});

	// #Filter > .close click event
	$('#Filter .close').on('click', function(){
		$('#Filter').hide();
	});

	// button.detailSearch click event
	$('button.detailSearch').on('click', function(e){
		e.preventDefault();
		$('#Detail').toggle();
	});

	// 空き枠表示
	$('.show_timeTable').on('click', function(e){
		e.preventDefault();
		var iid = $(this).data('iid');
		$('aside.a' + iid).toggleClass('on');
		$('aside.a' + iid).hasClass('on') ? $(this).text('空き枠を閉じる') : $(this).html('本日空き枠あり<small>（空き枠を表示する）</small>');
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
		setDate.apply(li, date);
	});

	$('button.next').on('click', function(e){
		e.preventDefault();
		var iid = $(this).parent('li').parent('ul').parent().data('iid');
		var li  = $(this).parent('li').parent('ul').children('li.d');
		var date = [$(li[6]).data('ut') + 86400000 * 1];
		setDate.apply(li, date);
	});

	// 空き枠の日付クリックイベント
	$('li.d').on('click', function(e){
		e.preventDefault();
		var iid = $(this).parent('ul').parent().data('iid');
		var unixDt = new Date($(this).data('ut'));
		getRsvTime.call($(this).parent('ul').next().next(), iid, unixDt);
	});

	// button.each click event
	$('button.each').on('click', function(e){
		e.preventDefault();
		$('#EMap').addClass('on');
		$ui.showMap({lat: $(this).data('lat'), lng: $(this).data('lng'), dom: document.getElementById('eachmap'), zoom: 16});
	});

	// #Menu > button.map click event
	$('#Menu .map').on('click', function(e){
		e.preventDefault();
		$('#TMap').toggleClass('on');
		$('#TMap').hasClass('on') ? $(this).text('地図を隠す') : $(this).text('地図を表示');
	});

	// #EMap button.close click event
	$('#EMap .close').on('click', function(e){
		e.preventDefault();
		$('#EMap').removeClass('on');
		$('#EMap').css('display', 'block');
	});

})();

/*
 This works for google Map
 */
;(function(){
	var mapDom = $('#totalmap');
	typeof markerData == 'undefined' && (markerData = null);
	$ui.showMap({lat: mapDom.data('lat'), lng: mapDom.data('lng'), dom: document.getElementById('totalmap'), zoom: 15}, markerData);
}());