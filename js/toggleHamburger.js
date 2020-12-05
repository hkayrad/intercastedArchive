var isHambOpen = false;
var isLangOpen = false;

function toggleHamburger(x) {
	x.classList.toggle("change");

	var sidebar = document.querySelector(".sideBar");

	if (isHambOpen === false) {
		sidebar.style.transform = "translateX(0%)";
		isHambOpen = true;
	} else if (isHambOpen === true) {
		sidebar.style.transform = "translateX(100%)";
		isHambOpen = false;
	}
}

function toggleLanguage(x) {
	/* x.classList.toggle("langOpen"); */

	var languages = document.querySelector(".languages");
	var triangle = document.querySelector(".triangle");

	if (isLangOpen === false) {
		languages.style.transform = "translateX(0%)";
		triangle.style.transform = "rotate(90deg)";
		isLangOpen = true;
	} else if (isLangOpen === true) {
		languages.style.transform = "translateX(100%)";
		triangle.style.transform = "rotate(0deg)";
		isLangOpen = false;
	}
}
