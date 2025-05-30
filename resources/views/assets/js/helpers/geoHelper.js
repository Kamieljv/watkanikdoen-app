const toRad = (Value) => {
	// Converts numeric degrees to radians
	return Value * Math.PI / 180
}

export const calcDistance = (lat1, lon1, lat2, lon2) => {
	var R = 6371 // km
	var dLat = toRad(lat2 - lat1)
	var dLon = toRad(lon2 - lon1)
	lat1 = toRad(lat1)
	lat2 = toRad(lat2)

	var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
		Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2)
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a))
	var d = R * c
	return d
}


