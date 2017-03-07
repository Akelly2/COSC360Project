document.addEventListener('DOMContentLoaded', checkSubmit, false);

function checkSubmit() {
    document.forms[0].addEventListener("submit", validate);
	document.forms[0].elements['email'].oninput = function() {
        document.getElementById("pleasefillemail")
        .innerHTML = "";
	}
    document.forms[0].elements['password'].oninput = function() {
        document.getElementById("pleasefillpass")
        .innerHTML = "";
	}
}

function validate(e) {
    var form = document.getElementById('mainform');
    var email = form.elements['email'].value;
    var password = form.elements['password'].value;

    if (email == null || email == '') {
        e.preventDefault();
        document.getElementById("pleasefillemail")
        .innerHTML = "Please enter your email.";
    }

    if (password == null || password == '') {
        e.preventDefault();
        document.getElementById("pleasefillpass")
        .innerHTML = "Please enter your password.";
	}

    return true;
}
