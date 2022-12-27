var open = false;
var table_shown = false;

$(document).ready(function () {
	$("#logopic").click(function () {
		$("#logopic").effect("slide", { mode: "hide", direction: "right", distance: 13000 }, 2000, callback);
	});
	function callback() {
		setTimeout(function () {
			$("#logopic").effect("slide");
		}, 1000);
	};
});

function rollOptions() {
	if (open == false) {
		document.getElementById("optionsList").style.display = "block";
		open = true;
	} else {
		document.getElementById("optionsList").style.display = "none";
		open = false;
	}
}

function changeTheme() {
	if (window.localStorage) {
		if ((localStorage.getItem("darkTheme") == "false") || (localStorage.getItem("darkTheme") == null)) {
			localStorage.setItem("darkTheme", "true");
			document.getElementById("themeButton").innerHTML = "Light Theme";
			pickTheme();
		} else if ((localStorage.getItem("darkTheme") == "true")) {
			localStorage.setItem("darkTheme", "false");
			document.getElementById("themeButton").innerHTML = "Dark Theme";
			pickTheme();
		}
	}
}

function pickTheme() {
	var light = "#4da2bd"
	var dark = "#1a137d";
	if ((localStorage.getItem("darkTheme") == "true")) {
		document.body.style.backgroundColor = "#130f40";
		document.getElementById("logo").style.backgroundColor = dark;
		document.getElementById("footer").style.backgroundColor = dark;
		document.getElementById("logopic").style.backgroundColor = dark;
		document.body.style.color = "white";

	} else if ((localStorage.getItem("darkTheme") == "false")) {
		document.body.style.backgroundColor = "#d1dae6";
		document.getElementById("logo").style.backgroundColor = light;
		document.getElementById("footer").style.backgroundColor = light;
		document.getElementById("logopic").style.backgroundColor = light;
		document.body.style.color = "black";
	}
}

function determineDialog() {
	if (window.sessionStorage) {
		if ((sessionStorage.getItem("dialogShown") == "false") || (sessionStorage.getItem("dialogShown") == null)) {
			sessionStorage.setItem("dialogShown", "true");
			$('#dialog').dialog(
				{
					buttons: [
						{
							text: "Tak!",
							icon: "ui-icon-heart",
							click: function () {
								$(this).dialog("close");
							}
						},
						{
							text: "No pewnie!",
							icon: "ui-icon-heart",
							click: function () {
								$(this).dialog("close");
							}
						}
					]
				});
		} else {
			$('#dialog').css("display", "none");
		}
	}
}

        function addWiki() {
            if (table_shown == false) {
                let arr1 = ['Wikipedia', 'https://pl.wikipedia.org/wiki/Ket_(typ_o%C5%BCaglowania)', 'https://pl.wikipedia.org/wiki/Slup',
                    'https://pl.wikipedia.org/wiki/Kuter_(typ_o%C5%BCaglowania)', 'https://pl.wikipedia.org/wiki/Szkuner', 'https://pl.wikipedia.org/wiki/Bryg',
                    'https://pl.wikipedia.org/wiki/Fregata_(typ_o%C5%BCaglowania)']
                var rows = document.getElementById("table").getElementsByTagName("tr");

                var th = document.createElement("th");
                rows[0].appendChild(th);
                th.appendChild(document.createTextNode(arr1[0]));

                for (var i = 1; i < 7; i++) {
                    var td = document.createElement("td");
                    rows[i].appendChild(td);
                    var a = document.createElement("a");
                    td.appendChild(a);
                    var attr = document.createAttribute("href");
                    var target = document.createAttribute("target");
                    attr.value = arr1[i];
                    target.value = "_blank";
                    a.setAttributeNode(attr);
                    a.setAttributeNode(target);

                    a.appendChild(document.createTextNode(arr1[i]));

                    if (localStorage.getItem("darkTheme") == "true") {
                        a.style.color = "white";
                    }
                }

                var wikibutton = document.getElementById('wikibutton')
                wikibutton.parentNode.removeChild(wikibutton);
            }
        }