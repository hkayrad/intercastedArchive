// Initialize Firebase
"use strict";

//grab a form
const form = document.querySelector("#preRegister");
let send = true;

document.querySelector("#preRegisterCampaign").onclick = function () {
	if (send == true) {
		send = false;
	} else if (send == false) {
		send = true;
	}
};

//grab an input
const inputEmail = form.querySelector("#preRegisterInput");
const sendCampaign = form.querySelector("#preRegisterCampaign");

//Firebase configuration
var firebaseConfig = {
	apiKey: "AIzaSyDWBoCp97bSWgKI6QtGbdFxTIqUYNDudN4",
	authDomain: "intercasted-f1282.firebaseapp.com",
	databaseURL: "https://intercasted-f1282.firebaseio.com",
	projectId: "intercasted-f1282",
	storageBucket: "intercasted-f1282.appspot.com",
	messagingSenderId: "437590798663",
	appId: "1:437590798663:web:f58685ac212564d9ca5c62",
	measurementId: "G-6MN6RVK3R8",
};

//create a functions to push
function firebasePush(email, campaign) {
	//prevents from braking
	if (!firebase.apps.length) {
		firebase.initializeApp(firebaseConfig);
	}

	//push itself
	var mailsRef = firebase.database().ref("preRegisterMails").push().set({
		mail: email.value,
		campaign: campaign,
	});
}

//push on form submit
if (form) {
	form.addEventListener("submit", function (evt) {
		evt.preventDefault();
		firebasePush(inputEmail, send);
		form.reset();

		//shows alert if everything went well.
		return alert(
			"Intercasted'a başarılı bir şekilde ön kayıt yaptırdınız."
		);
	});
}
