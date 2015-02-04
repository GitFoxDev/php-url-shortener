function shortUrl()
{
	var long_url = document.getElementById('longUrl').value;
	if (long_url !== '') {
		var params = 'act=shorten&url=' + long_url;
		/*document.getElementById("sresult").innerHTML = params + 'Ok!';
		alert('Ok');*/

		var xmlhttp;
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.open("POST", "index.php?go=shorten", false);
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4) {
				if(xmlhttp.status == 200) {
					document.getElementById("sresult").innerHTML = xmlhttp.responseText;
				}
				else if(xmlhttp.status == 400) {
					 document.getElementById('serror').innerHTML('<span class="message">Oops 400!</span>'); 
				} else {
					 document.getElementById('serror').innerHTML('<span class="message">Oops?!</span>'); 
				}
			}
		}
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(params);
	} else {
		document.getElementById('serror').innerHTML('<span class="message">Please enter long URL</span>'); 
	}
}
