document.addEventListener('DOMContentLoaded', checkSubmit, false);

function checkSubmit() {
    document.forms[0].addEventListener("submit", validate);
	document.forms[0].elements['email'].oninput = function() {
        document.getElementById("pleasefillemail")
        .innerHTML = "";
	}
	document.forms[0].elements['username'].oninput = function() {
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
    var name = form.elements['username'].value;
    var email = form.elements['email'].value;
    var password = form.elements['password'].value;
    var confirm = form.elements['confirm'].value;
    var accept = form.elements['accept'];

    if (accept.checked === false) {
        e.preventDefault();
        document.getElementById("pleaseaccept")
        .innerHTML = "Please accept the Terms.";
    }

    if (name.match(/^([a-zA-Z.0-9])+[^+,!@#$%^&*(): \t\n;\/|<>"']$/) == null) {
        e.preventDefault();
        document.getElementById("pleasefillname")
        .innerHTML = "Username must contain only alphanumeric characters, '.', '_' .";
	}

    if (email.match(/^([a-zA-Z._0-9])+\@([a-zA-Z.])+[^+,!@#$%^&*(): \t\n;\/|<>"']$/) == null) {
        e.preventDefault();
        document.getElementById("pleasefillemail")
        .innerHTML = "Please enter a valid email address.";
    }

    if (password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{6,}$/) == null) {
        e.preventDefault();
        document.getElementById("pleasefillpass")
        .innerHTML = "Password must contain at least one lower case letter, one upper case letter, and one number.";
	}

    if (confirm !== password) {
        e.preventDefault();
        document.getElementById("pleaseconfirm")
        .innerHTML = "Please enter your matching password confirmation.";
    }
    return true;
}
