var isOpen = false;

function toggleHamburger(x) {
	x.classList.toggle("change");

	var sidebar = document.querySelector(".sideBar");

	if (isOpen === false) {
		sidebar.style.transform = "translateX(0%)";
		isOpen = true;
	} else if (isOpen === true) {
		sidebar.style.transform = "translateX(-100%)";
		isOpen = false;
	}
}
