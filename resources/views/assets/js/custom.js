// window.axios = require("axios")
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

/**********
 * COOKIE FUNCTIONALITY 
**********/
class CookieConsent {
	constructor() {
		this.banner = document.getElementById('cookie-consent')
		// this.editButton = document.getElementById('cookie-edit')
		this.cookieName = 'CookieConsent'
	}

	start() {
		// Add click listeners
		// this.editButton.addEventListener('click', () => this.editCookies())
		document.querySelectorAll('.acceptCookiesBtn').forEach(el => {
			el.addEventListener('click', () => this.acceptCookies())
		})
		// document.getElementById('rejectCookies').addEventListener('click', () => this.rejectCookies())
		
		// check consent status
		this.checkStatus()
	}

	checkStatus() {
		switch (localStorage.getItem(this.cookieName)) {
		  case 'true': // consent given
			// this.editButton.classList.remove('hidden')
			// allow UMAMI
			break;
		  case 'false': // consent NOT given
		  	// this.editButton.classList.remove('hidden')
			break;
		  default: // not yet decided
			this.banner.classList.remove('hidden')
		}
	}

	acceptCookies() {
		localStorage.setItem(this.cookieName, true)
		this.banner.classList.add('hidden')
		// this.editButton.classList.remove('hidden')
	}

	rejectCookies() {
		localStorage.setItem(this.cookieName, false)
		this.banner.classList.add('hidden')
		// this.editButton.classList.remove('hidden')
	}

	editCookies() {
		// this.editButton.classList.add('hidden')
		this.banner.classList.remove('hidden')
	}
}

document.addEventListener('DOMContentLoaded', function () {
	window.cookieConsent = new CookieConsent()
	window.cookieConsent.start()
})
