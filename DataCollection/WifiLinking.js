
function findNearestWifi(array, currentLat, currentLon) {
	//assumes array contains an array of wifi points
	//where each wifi point has a name, latitude, and longitude
	
	var nndis[5];
	var labels[5];
	
	//fill arrays with max values
	for (var i = 0; i < 5; i ++) {
		nndis[i] = 99999999999999;
		labels[i] = "";
	}
	
	//loop through array
	for (var i = 0; i < array.length; i++) {
		var lat = array[i].latitude;
		var lon = array[i].longitude;
		var name = array[i].name;
		
		var dist = getDistance(currentLat, currentLon, lat, lon);
	
		for (var j = 0; j < nndis.length; j++) {
			if (dist < nndis[j]) {
				for (var k = nndis.length -1; k < j; k--) {
					nndis[k+1] = nndis[k];
					labels[k+1] = labels[k];
				}
				nndis[j] = dist;
				labels[j] = name;
				break;
			}
		}
		
	}
	return labels;
}

function getDistance(lat1, lon1, lat2, lon2) {
	
	var R = 6371;
	var dLat = deg2rad(lat2-lat1);
	var dLon = deg2rad(lon2-lon1);
	var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.sin(dLon/2) * Math.sin(dLon/2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
	var d= R * c; //distance in km
	return d;
	
}

function deg2rad(deg) {
	return deg * (Math.PI/180);
}