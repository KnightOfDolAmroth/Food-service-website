// Get the modal
var modal = document.getElementById('log_form');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
		location.href="./homepage.html";
    }
}

function forgot_pwd() {
	document.getElementById("log_form").style.display="none";
	document.getElementById("forgot_pwd_form").style.display="block";
}

function registration() {
	document.getElementById("log_form").style.display="none";
	document.getElementById("reg_form").style.display="block";
}
