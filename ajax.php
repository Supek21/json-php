<!DOCTYPE html>
<html lang="pl">
<head>
<title>Technologia AJAX</title>
<meta charset="utf-8" />
</head>
<body>
<script>
var ajax;
if(typeof XMLHttpRequest == "undefined")
{
ajax = new ActiveXObject('Microsoft.XMLHTTP');
}
else
{
ajax = new XMLHttpRequest();
}
function pobierz(zasob, znacznik)
{
if(document.getElementById(znacznik) != null)
{
ajax.open("GET", "./"+zasob, "true");
ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencodede;charset=UTF-8");
ajax.onreadystatechange = function()
{
if(ajax.readyState == 4 && ajax.status == 200) wypisz(ajax.responseText, znacznik);
else document.getElementById(znacznik).innerHTML = "Czekaj!!!";
}
ajax.send();
}
}
function wypisz(daneJson, identyfikator)
{
var wyjscie = 'parsowanie danych JSON ...';
document.getElementById(identyfikator).innerHTML = wyjscie;
var odpowiedz = eval("("+daneJson+")");
document.getElementById(identyfikator).innerHTML = 'dane odebrane';

wyjscie += '<table border="1">';
wyjscie += '<tbody>';
for( var i in odpowiedz.dane.ksiazka)
{

wyjscie += '<tr>';
wyjscie += '<td>';
wyjscie += odpowiedz.dane.ksiazka[i].tytul;
wyjscie += '</td>';
wyjscie += '<td>';
wyjscie += odpowiedz.dane.ksiazka[i].autorzy;
wyjscie += '</td>';
}
wyjscie += '</tbody>';
wyjscie += '</table>';


document.getElementById(identyfikator).innerHTML = wyjscie;
}
</script>
<div id="info">Kliknij przycisk poniżej aby pobrać dane z serwera:</div>
<input type="button" value="Pobież dane z serwera" onclick="pobierz('ksiazki.json','info');" />
</body>
</html> 