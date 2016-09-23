function _(x) {
	return document.getElementById(x);
}
function emptyElement(x) {
	_(x).innerHTML = "";
}

function ajaxObj(meth, url) {
	var x = new XMLHttpRequest();
	x.open(meth, url, true);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn(x) {
	if(x.readyState == 4 && x.status == 200){
	    return true;
	}
}

function restrict(elem) {
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}

function checkusername() {
	var u = _("username").value;
	if(u != ""){
		_("unamestatus").innerHTML = 'Checking ...';
		var ajax = ajaxObj("POST", "app-signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("unamestatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("usernamecheck="+u);
	}
}
function signup() {
	var u = _("username").value;
	var e = _("email").value;
	var p1 = _("pass1").value;
	var p2 = _("pass2").value;
	var g = _("gender").value;
	var status = _("status");
	if(u == "" || e == "" || p1 == "" || p2 == "" || g == ""){
		status.innerHTML = "Fill out all of the form data";
	} else if(p1 != p2){
		status.innerHTML = "Your password fields do not match";
	} else {
		_("signupbtn").style.display = "none";
		status.innerHTML = 'Please wait ...';
		var ajax = ajaxObj("POST", "app-signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText != "signup_success"){
					status.innerHTML = ajax.responseText;
					_("signupbtn").style.display = "block";
				} else {
					window.scrollTo(0,0);
					_("signupform").innerHTML = "OK "+u+", check your email inbox and junk mail box at <u>"+e+"</u> in a moment to complete the sign up process by activating your account. You will not be able to do anything on the site until you successfully activate your account.";
				}
	        }
        }
        ajax.send("u="+u+"&e="+e+"&p="+p1+"&g="+g);
	}
}

function login() {
    var u = _("username").value;
    var p = _("password").value;
     _("status").innerHTML = "No username or password entered.";
    if (u == "" || p == "")
        _("status").innerHTML = "No username or password entered.";
    else {
        _("loginbtn").style.display = "none";
        _("status").innerHTML = "Please wait...";
        var ajax = ajaxObj("POST", "app-login.php");
        ajax.onreadystatechange = function() {
            if (ajax.responseText == "login_failed") {
                _("status").innerHTML = "Wrong username or password";
                _("loginbtn").style.display = "inline-block";
            } else {
                window.location = "app-dash.php";
            }
        }
        ajax.send("u="+u+"&p="+p);
    }
}

/* function addEvents(){
	_("elemID").addEventListener("click", func, false);
}
window.onload = addEvents; */