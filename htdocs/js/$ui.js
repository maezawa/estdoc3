;(function(t){
	t.$ui = {
		// 一定の文字数で「・・・」と切る表示＆[もっと見る]で復元
		readMore: function(){
			// .readMoreのボタンと.commentの走査
			var afterTxt = '...';

			$('.comment').map(function(){
				var p = $(this);
				var cutNum  = p.data('num') || 50;
				var textOrigin = $(p).text();
				var textTrim = $(p).text().substr(0, cutNum);

				(cutNum < $(p).text().length) && $(p).html(textTrim + afterTxt);
				$(p).css('visibility', 'visible');

				$($(this).next('.readMore')).on('click', function(e){
					e.preventDefault();
					$(this).prev('.comment').html(textOrigin);
					$(this).css('display', 'none');
				});

			});
		},

		// 地図の表示
		/*
		 * p{'lat','lng','address','dom', 'zoom'}
		 */
		showMap: function(p, marker){
			if (p.dom === null) return;

			var marker = marker || null;
			var showMap = function(latlng, marker){
				var marker = marker || null;
				var options = {
					zoom: p.zoom || 16,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				var mapObj = new google.maps.Map(p.dom, options);
				new google.maps.Marker({
					position: latlng,
					map: mapObj
				});

				if (marker){
					marker.map(function(val){
						val.position = new google.maps.LatLng(val.lat, val.lng);
					});

					for (var i = 0, l = marker.length; i < l; i++){
						var icon = (function(m){
							switch (m.flg){
							case 'EPARK':
							case 'EST':
								return new google.maps.MarkerImage("/img/map_verde.png", new google.maps.Size(21, 34), new google.maps.Point(21 * (i + 1), 0));
								break;
							default :
								return new google.maps.MarkerImage("//chart.apis.google.com/chart?cht=it&chs=11x11&chco=cc000090&chf=bg,s,00000000");
							}
						})(marker[i]);

						marker1 = new google.maps.Marker({
							position: marker[i].position,
							map: mapObj,
							icon: icon
						});

						setAnchor(i + 1);
					}
				}
			};

			var setAnchor = function(i){
				var no = i * 21;
				return google.maps.event.addListener(marker1, 'click', function(){
					location.href = "#no" + no;
					var pos = $('a[name="no' + no + '"]').next().offset().top;
					$('body').scrollTop(pos - 82);
				});
			};

			google.maps.event.addDomListener(window, 'load', function(){
				if (typeof p.address === 'undefined'){
					showMap(new google.maps.LatLng(p.lat, p.lng), marker);
				}else{
					var g = new google.maps.Geocoder();
					g.geocode({'address': p.address}, function(r, s){
						(s == google.maps.GeocoderStatus.OK) ? showMap(r[0].geometry.location, marker) : false;
					});
				}
			});
		}

	};
})(this);