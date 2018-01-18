// Get the modal
var modal = document.getElementById('log_form');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
		location.href="./homepage.html";
    }
}

function registration() {
	console.log("Hello World");
	document.getElementById("log_form").style.display="none";
	document.getElementById("reg_form").style.display="block";
}