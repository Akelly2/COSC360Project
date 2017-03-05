document.addEventListener('DOMContentLoaded', checkSubmit, false);

function checkSubmit() {
    document.forms[0].addEventListener("submit", validate);
	document.forms[0].elements['email'].oninput = function() {
		document.forms[0].elements['email'].className = "no-highlight";
	}
	document.forms[0].elements['name'].oninput = function() {
		document.forms[0].elements['name'].className = "no-highlight";
	}
    document.forms[0].elements['password'].oninput = function() {
		document.forms[0].elements['password'].className = "no-highlight";
	}
    document.forms[0].elements['confirm'].oninput = function() {
		document.forms[0].elements['confirm'].className = "no-highlight";
	}
	document.forms[0].elements['accept'].onclick = function() {
		document.forms[0].elements['accept'].className = "no-highlight";
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
        form.elements['accept'].className = "highlight";
    }

    if (name == null || name == '') {
        e.preventDefault();
		form.elements['name'].className = "highlight";
	}

    if (email == null || email == '') {
        e.preventDefault();
        form.elements['email'].className = "highlight";
    }

    if (password == null || password == '') {
        e.preventDefault();
		form.elements['password'].className = "highlight";
	}

    if (confirm == null || confirm == '') {
        e.preventDefault();
        form.elements['confirm'].className = "highlight";
    }
    return true;
}
