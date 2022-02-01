window.axios = require("axios")
window.url = document.querySelector("meta[name='url']").getAttribute("content")
window.csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content")

/**
 * Adds some simple class replacers, see the following article to learn more:
 * https://devdojo.com/tnylea/animating-tailwind-transitions-on-page-load
 */

document.addEventListener(
	"DOMContentLoaded", function () {
		var replacers = document.querySelectorAll("[data-replace]")
		for(var i=0; i<replacers.length; i++){
			let replaceClasses = JSON.parse(replacers[i].dataset.replace.replace(/'/g, "\""))
			Object.keys(replaceClasses).forEach(
				function (key) {
					replacers[i].classList.remove(key)
					replacers[i].classList.add(replaceClasses[key])
				}
			)
		}
	}
)


/**********
 * NOTIFICATION FUNCTIONALITY 
 **********/

var markAsRead = document.getElementsByClassName("mark-as-read")
var removedNotifications = 0
var unreadNotifications =  markAsRead.length
for (var i = 0; i < markAsRead.length; i++) {
	markAsRead[i].addEventListener(
		"click", function () {
			var notificationId = this.dataset.id
			var notificationListId = this.dataset.listid

			var notificationRequest = new XMLHttpRequest()
			notificationRequest.open("POST", url + "/auth/notification/read/" + notificationId, true)
			notificationRequest.onreadystatechange = function () {
				if (notificationRequest.readyState != 4 || notificationRequest.status != 200) {
					var response = JSON.parse(notificationRequest.responseText)
					document.getElementById("notification-li-" + response.listid).remove()
					removedNotifications += 1
					var notificationCount = document.getElementById("notification-count")
					if(notificationCount) {
						notificationCount.innerHTML = parseInt(notificationCount.innerHTML) - 1
					}
				}
				if(removedNotifications >= unreadNotifications) {
					if(document.getElementById("notification-count")) {
						document.getElementById("notification-count").classList.add("opacity-0")
					}
				}
			}
			notificationRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
			notificationRequest.send("_token=" + csrf + "&listid=" + notificationListId)
		}
	)
}

/**********
 * END NOTIFICATION FUNCTIONALITY 
**********/