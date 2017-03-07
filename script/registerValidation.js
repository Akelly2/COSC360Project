document.addEventListener('DOMContentLoaded', checkSubmit, false);

function checkSubmit() {
    document.forms[0].addEventListener("submit", validate);
	document.forms[0].elements['email'].oninput = function() {
        document.getElementById("pleasefillemail")
        .innerHTML = "";
	}
	document.forms[0].elements['name'].oninput = function() {
        document.getElementById("pleasefillname")
        .innerHTML = "";
	}
    document.forms[0].elements['password'].oninput = function() {
        document.getElementById("pleasefillpass")
        .innerHTML = "";
	}
    document.forms[0].elements['confirm'].oninput = function() {
        document.getElementById("pleaseconfirm")
        .innerHTML = "";
	}
	document.forms[0].elements['accept'].onclick = function() {
        document.getElementById("pleaseaccept")
        .innerHTML = "";
	}
}

function validate(e) {
    var form = document.getElementById('mainform');
    var name = form.elements['name'].value;
    var email = form.elements['email'].value;
    var password = form.elements['password'].value;
    var confirm = form.elements['confirm'].value;
    var accept = form.elements['accept'];

    if (accept.checked === false) {
        e.preventDefault();
        document.getElementById("pleaseaccept")
        .innerHTML = "Please accept the Terms.";
    }

    if (name == null || name == '') {
        e.preventDefault();
        document.getElementById("pleasefillname")
        .innerHTML = "Please enter your name.";
	}

    if (email == null || email == '' || !email.includes('@')) {
        e.preventDefault();
        document.getElementById("pleasefillemail")
        .innerHTML = "Please enter a valid email.";
    }

    if (password == null || password == '') {
        e.preventDefault();
        document.getElementById("pleasefillpass")
        .innerHTML = "Please enter a valid password.";
	}

    if (confirm == null || confirm == '') {
        e.preventDefault();
        document.getElementById("pleaseconfirm")
        .innerHTML = "Please confirm your password.";
    }
    return true;
}
