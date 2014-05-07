google.maps.event.addDomListener(window, 'load', function(){
	var myLat = document.getElementById('Map').getAttribute('data-lat');
    var myLng = document.getElementById('Map').getAttribute('data-lng');
	var map = document.getElementById("Map"); 
    var LatLng = new google.maps.LatLng(myLat, myLng)
	var options = {
        zoom: 16,
		center: LatLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
			
    var mapObj = new google.maps.Map(map, options); 
	var marker = new google.maps.Marker({
				position: LatLng,
				map: mapObj
			});
 }); 