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
    if (u == "" || p == "")
        _("status").innerHTML = "No username or password entered.";
    else {
        _("loginbtn").style.display = "none";
        _("status").innerHTML = "Please wait...";
        var ajax = ajaxObj("POST", "logincheck.php");
        ajax.onreadystatechange = function() {
            if(ajaxReturn(ajax) == true) {
                if (ajax.responseText == "login_success") {
                    window.location = "dashboard.php";
                } else {
                    _("status").innerHTML = ajax.responseText;
                    _("loginbtn").style.display = "inline-block";
                }
            }
        }
        ajax.send("u="+u+"&p="+p);
    }
}

function logout() {
    var ajax = ajaxObj("POST", "logout.php");
    ajax.onreadystatechange = function() {
        location.reload();
    }
    ajax.send();
}

/* function addEvents(){
	_("elemID").addEventListener("click", func, false);
}
window.onload = addEvents; */

function toggleFullScreen() {
  var doc = window.document;
  var docEl = doc.documentElement;

  var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
  var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

  if(!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
    requestFullScreen.call(docEl);
  }
  else {
    cancelFullScreen.call(doc);
  }
}

function checkWeight() {
    var weight = $('#weightInput').val();
    if (weight > 700) {
        _('status').innerHTML = "Weight value too high!";
    } else if (weight < 10) {
        _('status').innerHTML = "Weight value too low!";
    }
    emptyElement('weightInput');
}

function checkFileType() {
    emptyElement('status');
    emptyElement('filesSize');

    var files = _('fileInput').files;
    var exts = [];
    var totalSize = 0;
    var noErrors = true;
    for (var i = 0; i < files.length; i++) {
        exts.push(files[i].name.split('.').pop().toLowerCase());
        totalSize += files[i].size;
    }

    var invalidExts = [];
    for (i = 0; i < exts.length; i++) {
        if (exts[i] != 'gif' && exts[i] != 'png' && exts[i] != 'jpg' &&
           exts[i] != 'jpeg' && exts[i] != 'jpe') {
            invalidExts.push(exts[i]);
        }
    }

    if (invalidExts.length != 0) {
        var msg = '';
        for (i = 0; i < invalidExts.length; i++) {
            msg += invalidExts[i] + ' ';
        }
        msg += '- Invalid file extensions!\n';
        $('#fileInput').val("");
        noErrors = false;
    }
    
    if (totalSize > 10000000) {
        noErrors = false;
        $('#fileInput').val("");
        msg += '- Max of 10MB uploads at once!\n';
    }
    
    if (noErrors) {
        _('filesSize').innerHTML = (totalSize / 1000000).toFixed(2) + 'MB';
    } else {
        _('filesSize').innerHTML = '';
        _('status').innerHTML = msg;
    }
}

function openData(row_num, id) {
    if (_('display_' + row_num).style.display === "none") {
        _('display_' + row_num).style.display = "inline";
    } else {
        _('display_' + row_num).style.display = "none";
    }
    
    var ajax = ajaxObj("POST", "get_data.php");
    ajax.onreadystatechange = function() {
        if(ajaxReturn(ajax) == true) {
            if (ajax.responseText != "") {
                 _('popup').innerHTML = ajax.responseText;

                var elements = _('popup').children;
                var length = elements.length;
                for (var i = 0; i < length; i++) {
                    elements[i].style.width = parseInt(100 / length) + '%';
                }
            } else {
                _('image-link-' + id).style.display = 'none';
            }
        }
    }
    ajax.send("i="+id);
}

function search(string) {
    var ajax = ajaxObj("POST", "get_data.php");
    ajax.onreadystatechange = function() {
        if(ajaxReturn(ajax) == true) {
            _('data').innerHTML = ajax.responseText;
        }
    }
    ajax.send("s="+string);
}

function getGraph() {
    var ajax = ajaxObj("POST", "get_results.php");
    ajax.onreadystatechange = function() {
        if(ajaxReturn(ajax) == true) {
            if (ajax.responseText == "No data") {
                _('chartdiv').innerHTML = "No data available.";
            }

            var data = JSON.parse(ajax.responseText);
            
            var convertedData = [];
            for (var i = 0; i < data.length; i++) {
                convertedData.push({
                    "weight": data[i][0],
                    "date": data[i][1],
                    "color": "#FF0F00"
                });
            }
            
            var chart = AmCharts.makeChart("chartdiv", {
                "type": "serial",
                "theme": "light",
                "marginRight": 90,
                "dataProvider": convertedData,
                    "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left",
                    "title": "Weight"
                }],
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "<b>[[category]]: [[value]]</b>",
                    "fillColorsField": "color",
                    "fillAlphas": 0.9,
                    "lineAlpha": 0.2,
                    "type": "smoothedLine",
                    "valueField": "weight"
                }],
                    "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "date",
                "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 45
                },
                    "export": {
                    "enabled": true
                }
            });
            
            var chartScrollbar = new AmCharts.ChartScrollbar();
            chart.addChartScrollbar(chartScrollbar);
            
            if (data[data.length - 2] < data[data.length - 1]) {
                _('status').innerHTML = "You gained weight.";
            } else {
                _('status').innerHTML = "You lost weight.";
            }
        }
    }
    ajax.send();
}