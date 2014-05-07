;(function(){
	// [もっと読む]の実装
	$ui.readMore();

	// button.map click event
	$('button.map').on('click', function(){
		$('#HosMap').addClass('on');
			var mapDom = $('#map');
			$ui.showMap({lat: mapDom.data('lat'), lng: mapDom.data('lng'), dom: document.getElementById('map'), zoom: 16});
	});

	// #HosMap button.close click event
	$('#HosMap .close').on('click', function(e){
		e.preventDefault();
		$('#HosMap').removeClass('on');
		$('#HosMap').css('display', 'block');
	});

	var iid = $('aside').data('iid');
	// 日付を表示
	setDate.apply($('aside.a' + iid).children('ul').children('li.d'), null);

	// 本日の空き枠を表示
	getRsvTime.call($('aside.a' + iid).children('.time_btns'), iid, null);


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
})();