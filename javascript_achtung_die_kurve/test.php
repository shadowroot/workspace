<canvas id="gamespace" width="1000" height="400"
	style="background: #000000;"></canvas>
<?php

?>
<script type="text/javascript">
function game(){
	var game = this;
	game.hero = null;
	
	
	game.canvas = document.getElementById("gamespace");
	game.buff = document.createElement("canvas");
	game.buff.width = game.canvas.width;
	game.buff.height = game.canvas.height;
	game.buffer = game.buff.getContext("2d");
	game.ctx = game.canvas.getContext("2d");
	/*
	ctx.beginPath();
	ctx.moveTo(100,100);
	ctx.lineTo(101,101);
	ctx.lineTo(102,102);
	ctx.lineWidth = 10;
	ctx.strokeStyle = "black";
	ctx.stroke();
	ctx.fillStyle="#000000";
	ctx.fillRect(0,0,300,300);
	var data = ctx.getImageData(0,0,300,300);
	var i=0;
	
	for (i=0;i<=5;i++){
		//90% alfa
		if((data.data[i] | 0x00) != 0x00){
			document.write("collision");
		}
		
	}
	*/
	game.loop = function(){
		//console.log("Not Running");
		if(game.status){
			//console.log("Running");
			for(var i=0;i<=game.hero.length-1;i++){
				game.change_vector(i);
				game.draw(i);
			}
		}
	};
	game.init = function(){
		game.player = 0;
		game.id = null;
		game.hero = new Array();
		console.log("init");
		game.status = false;
		/*18*/
		game.url = "http://localhost/workspace/javascript_achtung_die_kurve/controller.php";
		game.butt = document.createElement("input");
		game.butt.type = "button";
		game.butt.id="pause";
		game.butt.value="Start/Stop";
		game.butt.onclick = function(){
			if(!game.status){
				game.status = true;

			}
			else{
				game.status = false;
			}

		};
			game.hero.push({
				/*
					Start coordinates
				*/
			name:"Jonny",
			running:true,
			x:50,
			y:50,
			//[x,y] vector 
			direction:new Array(0,0),
			angle:0,
			color:"#ff1111",
			multi:2
			});

			game.hero.push({
				/*
					Start coordinates
				*/
			name:"bot",
			running:true,
			x:300,
			y:300,
			//[x,y] vector 
			direction:new Array(0,0),
			angle:0,
			color:"#ffffff",
			multi:2
			});
			
		//game.first_communication();
			
		document.getElementsByTagName("body")[0].appendChild(game.butt);
		window.document.onkeydown = function(e){
			game.key_handler(e);

		};
		window.document.onkeypress = function(e){
			game.key_handler(e);

		};
		game.key_handler = function(e){
		console.log(e.keyCode);
		switch(e.keyCode){
			case 81/*q*/:

				game.hero[0].angle-=0.04363323129985824;//(Math.PI/72)
				break;
			case 87/*w*/:
				game.hero[0].angle+=0.04363323129985824;
				break;
			case 70/*f*/:
				game.hero[1].angle-=0.04363323129985824;
				break;
			case 71/*g*/:
				game.hero[1].angle+=0.04363323129985824;
				break;
			default:
				break;
		}

		};
	};
	game.draw = function(i){
		if(game.hero[i].running){
			game.buffer.beginPath();
			var x = game.hero[i].x+game.hero[i].direction[0];
			var y = game.hero[i].y+game.hero[i].direction[1];
			game.buffer.moveTo(game.hero[i].x,game.hero[i].y);
			
			if((x<game.canvas.width) && (x>0) && (y<game.canvas.height) && (y>0)){
				var data = game.buffer.getImageData(x,y,1,1).data;
				for (var u=0;u<data.length;u++){
					if(data[u] != 0){
						game.hero[i].running = false;
						console.log(game.hero[i].name+ " ended.");
						var div = document.createElement("div");
						div.innerHTML = game.hero[i].name+ " ended.";
						document.body.appendChild(div);
						return;
					}
				}
						
						game.buffer.strokeStyle=game.hero[i].color;
						game.buffer.lineTo(x,y);
						
						game.buffer.closePath();
						game.buffer.stroke();
						
						game.hero[i].x = x;
						game.hero[i].y = y;
						var buff_data = game.buffer.getImageData(0,0,game.buff.width,game.buff.height);
						game.ctx.putImageData(buff_data,0,0);
						
			}
			else{
				game.hero[i].running = false;
				console.log(game.hero[i].name+ " ended.");
				var div = document.createElement("div");
				div.innerHTML = game.hero[i].name+ " ended.";
				document.body.appendChild(div);
				return;
			}
			
		}////next point color check && frame limits
		
	};
	game.change_vector = function(i){
		if(game.hero[i].running){
			var x = Math.cos(game.hero[i].angle)*game.hero[i].multi;
			var y = Math.sin(game.hero[i].angle)*game.hero[i].multi;
	
			game.hero[i].direction = [x,y];
			
		}
	};
	game.first_communication = function(){
			game.http = new XMLHttpRequest();
			game.http.open("GET", game.url+"?name="+game.hero[0].name, true);
			game.http.send();
			game.http.onreadystatechange = function(){
					if(game.http.readyState == 400){
							var a = game.http.responseText.split(";");
							game.id = a[0];
							game.player = a[1];
					}
			};

	};
	game.http_comm=function(data){
		game.http.open("POST", game.url+"?ID="+game.id, true);
		game.http.send("x="+game.hero[0].x+"&y="+game.hero[0].y);
		game.http.onreadystatechange = function(){
				if(game.http.readyState == 400){
						game.http_process(game.http.responseText);
				}
		};
	};
	game.http_process = function(data){
		var datas = data.split("&");
		for(var u=0;u<=datas.length;u++){
			var names = datas[u].split("=");
			game.names[0] = names[1];
			
		}
	};

}
/*
 * Constructor
 */
var curve = new game();
curve.init();
setInterval("curve.loop()","50");

/*
 * Controllers

 sin 5° =  0,0872
 */

</script>

