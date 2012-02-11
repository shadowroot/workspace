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
	game.pressed = new Array();
	game.maze_rects=[];
	
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
	var data = ctx.getImgame.hero[i].x = x;
	game.hero[i].y = y;ageData(0,0,300,300);
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
				game.key_handler();
				game.change_vector(i);
				game.draw(i);
			}
		}
	};
	game.init = function(nick){
		game.my=0;
		game.hero = new Array();
		console.log("init");
		game.status = false;
		/*18*/
		game.url = "http://localhost/workspace/javascript_achtung_die_kurve/controller.php";
		//game.first_communication(nick);
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
			game.hero[game.my] = ({
				/*
					Start coordinates
				*/
			name:nick,
			running:true,
			x:50,
			y:50,
			//[x,y] vector 
			direction:new Array(0,0),
			angle:0,
			color:"#ff1111",
			multi:3,
			time_multi:0,
			line_pause:100,   /*pause*/
			pause_length:3,
			immune:false,
			immune_time:0,
			bullet:0,
			freeze:0
			});

			
		
		game.draw_maze();	
		document.getElementsByTagName("body")[0].appendChild(game.butt);
		window.document.onkeydown = function(e){
			for(var o=0;o<game.pressed.length;o++){
				if(game.pressed[o] == e.keyCode){
					return;
				}
			}
			game.pressed.push(e.keyCode);

		};
		window.document.onkeyup = function(e){
			for(var o=0;o<game.pressed.length;o++){
				if(game.pressed[o] == e.keyCode){
					game.pressed.splice(o, 1);
				}
			}
			

		};
		game.key_handler = function(){
		for(var o=0;o<game.pressed.length;o++){
			switch(game.pressed[o]){
				case 81/*q*/:
	
					game.hero[0].angle-=0.1308996938995747;//(Math.PI/24)  15DEG
					break;
				case 87/*w*/:
					game.hero[0].angle+=0.1308996938995747;
					break;
				case 70/*f*/:
					game.hero[1].angle-=0.1308996938995747;
					break;
				case 71/*g*/:
					game.hero[1].angle+=0.1308996938995747;
					break;
				default:
					break;
			}
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
						game.hero[i].x = x;
						game.hero[i].y = y;
						
						if(game.hero[i].line_pause == 0){
							if(game.hero[i].pause_length != 0){
								game.hero[i].pause_length--;
								return;
							}
							else{
								game.hero[i].line_pause=100;
								game.hero[i].pause_length=3;
							}
						}
						else{
							game.hero[i].line_pause--;
						}
						game.buffer.stroke();
						
						
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

	
	game.draw_maze=function(){
			
			game.buffer.fillStyle="#ff1111";
			u=0;
			while(game.maze_rects.length<=20){
				
				var x = Math.random()*game.canvas.width;
				var y = Math.random()*game.canvas.height;
				for(var u=0;u<game.maze_rects.length;u++){
					if(((((x+70)>game.maze_rects[u][0]) || ((x-70)<game.maze_rects[u][0])) && (((y+120)>game.maze_rects[u][1]) || ((y-120)<game.maze_rects[u][1])) && u%2==0) && x>150 && y>150 && x<game.canvas.width-150 && y<game.canvas.heigth-150){
						game.buffer.fillRect(x,y,50,100);
						game.maze_rects.push([x,y]);
					}
					else if(((((x-70)>game.maze_rects[u][0]) || ((x+70)<game.maze_rects[u][0])) && (((y+120)>game.maze_rects[u][1]) || ((y-120)<game.maze_rects[u][1]))) && x>150 && y>150 && x<game.canvas.width-150 && y<game.canvas.heigth-150){
						game.buffer.fillRect(x,y,100,50);
						game.maze_rects.push([x,y]);
					}
					else{
						x += 150;
						y += 150;
						game.buffer.fillRect(x,y,50,100);
						game.maze_rects.push([x,y]);
					}
					
				}
				u++;
				game.maze_rects.push([x,y]);
			}
	};


	
	game.change_vector = function(i){
		if(game.hero[i].running){
			var x = Math.cos(game.hero[i].angle)*game.hero[i].multi;
			var y = Math.sin(game.hero[i].angle)*game.hero[i].multi;
	
			game.hero[i].direction = [x,y];
			
		}
	};
	game.first_communication = function(nick){
			game.http = new XMLHttpRequest();
			game.http.open("GET", game.url+"?name="+nick, true);
			game.http.send();
			game.http.onreadystatechange = function(){
					if(game.http.readyState == 400){
							var a = game.http.responseText.split(";");
							game.id = a[0];
							game.my = a[1];
					}
			};

	};
	game.http_comm=function(data){
		game.http.open("POST", game.url+"?ID="+game.id, true);
		game.http.send("x="+game.hero[0].x+"&y="+game.hero[0].y);
		game.http.onreadystatechange = function(){
				if(game.http.readyState == 200){
						game.http_process(game.http.responseText);
				}
		};
	};
	game.http_process = function(data){
		
		var pos = new Array();
		pos[0] = data.indexOf("id=");
		pos[1] = data.indexOf("&",pos[0]);
		var id = data.substr(pos[0]+3,pos[1]-(pos[0]+3));
		data = data.substr(0,pos[0]-1)+data.substr(pos[1],data.length-1);
		var datas = data.split("&");
		for(var u=0;u<=datas.length;u++){
			var names = datas[u].split("=");
			eval("game.hero["+id+"]."+names[0]+"= \""+names[1]+"\"");
		}
	};
	

}
/*
 * Constructor
 */

	var curve = new game();
	curve.init("jonny");
	setInterval("curve.loop()","100");


/*
 * Controllers

 sin 5° =  0,0872
 */

</script>

