export const geoHelper = {
	data() {
		return {
			//
		}
	},
	methods: {
		//This function takes in latitude and longitude of two location and returns the distance between them as the crow flies (in km)
		calcDistance(lat1, lon1, lat2, lon2)
		{
			var R = 6371 // km
			var dLat = this.toRad(lat2-lat1)
			var dLon = this.toRad(lon2-lon1)
			lat1 = this.toRad(lat1)
			lat2 = this.toRad(lat2)

			var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2)
			var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a))
			var d = R * c
			return d
		},
		// Converts numeric degrees to radians
		toRad(Value)
		{
			return Value * Math.PI / 180
		}
	}
}