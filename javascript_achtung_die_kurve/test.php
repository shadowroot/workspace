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
	 * ITEMS
	*/
	game.actions = {
			freeze_time:0,
			speed_time:0,
			running:0,  //How many is still running
			bullet:[],  //bullet posittion
			bullet_vector:[],
			bullet_speed:50,
			bullet_width:5,
			last:0
	};
	game.respawn_time = {
			freeze:0,
			speed:0,
			bullet:0
	};
	game.respawn_posittion = {
			bullet:[],
			speed:[],
			freeze:[]
	};
	
	game.actions_ids = {
			freeze:0,
			bullet:0,
			speed:0
	};
	game.action_in_use = {
			speed:false,
			freeze:false,
			bullet:false
	};
	/*
		ITEMS END
	*/
	
	game.loop = function(){
		//console.log("Not Running");
		if(game.status){
			//console.log("Running");
			for(var i=0;i<=game.hero.length-1;i++){
				if(game.actions.running == 1){
					game.actions.last=i;
					game.status = false;
				}
				
				if(game.hero[i].running == false && !game.action_in_use.freeze){
					game.actions.running--;
				}
				game.key_handler();
				game.change_vector(i);
				game.draw(i);
				game.throw_items(i);
				if(!game.status){
					console.log("Game won "+game.hero[i].name);
					
				}
			}
			
		}
	};
	game.throw_items = function(i){
		/*
			RESPAWN
		*/
		if( !game.action_in_use.bullet && game.respawn_time.freeze == 0 ){
			game.respawn_posittion.bullet = [Math.random()*(game.canvas.width-game.items.bullet.width),Math.random()*(game.canvas.height-game.items.bullet.height)];
			game.respawn_time.bullet = Math.random()*5000;	
		}
		if( !game.action_in_use.freeze && game.respawn_time.freeze == 0 ){
			game.respawn_posittion.freeze = [Math.random()*(game.canvas.width-game.items.freeze.width),Math.random()*(game.canvas.height-game.items.freeze.height)];
			game.respawn_time.freeze = Math.random()*5000;
		}
		if( !game.action_in_use.speed && game.respawn_time.speed == 0){
			game.respawn_posittion.speed = [Math.random()*(game.canvas.width-game.items.speed.width),Math.random()*(game.canvas.height-game.items.speed.height)];
			game.respawn_time.speed = Math.random()*5000;
		}
		/*
		SPEED
		*/
		if(game.action_in_use.speed){
			game.actions.speed_time--;
		}


		
		if(!game.action_in_use.bullet && game.respawn_time.bullet != 0){
			game.respawn_time.bullet--;
		}
		if(!game.action_in_use.freeze && game.respawn_time.freeze != 0){
			game.respawn_time.freeze--;
		}
		if(!game.action_in_use.speed && game.respawn_time.speed != 0){
			game.respawn_time.speed--;
		}

		
		if(game.action_in_use.speed && game.actions.speed_time ==0){

			game.hero[game.actions_ids.speed].multi = 2;
			game.action_in_use.speed=false;
			
		}
		/*
			FREEZE
		*/
		if(game.action_in_use.freeze){
			game.actions.freeze_time--;
			if(game.actions_ids != i){
				game.hero[i].running=false;
			}
		}
		if(!game.action_in_use.freeze){
			game.hero[i].running=true;
		}

		if(game.action_in_use.freeze &&game.actions.freeze_time ==0){
			game.action_in_use.freeze=false;
		}
		
		
		
	};
	/*
	INIT	
	*/
	game.init = function(nick){
		/*
		ITEM IMAGES
		*/
		var bullet=new Image();
		bullet.src="bullet.gif";
		var time=new Image();
		time.src="time.jpg";
		var speed=new Image();
		speed.src="energy.gif";
		game.items = {
				bullet:bullet, //image
				
				speed:speed,   //image
				
				freeze:time    //image
				
		};
		/*
		END
		*/
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
		/*
		HERO SPAWN
		*/
			game.hero[game.my] = ({
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
			attrs:new Array() //All attributes
			});
		/*
		END
		*/
		game.actions.running+=2;	
		
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
		
	};
	/*
	INIT END
	*/
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
	game.draw = function(i){
		if(game.hero[i].running){
			
			var x = game.hero[i].x+game.hero[i].direction[0];
			var y = game.hero[i].y+game.hero[i].direction[1];
			
			/*
			RESPAWNERS
			*/
			if(game.respawn_time.bullet==0){
				game.buffer.drawImage(game.items.bullet,game.respawn_posittion.bullet[0],game.respawn_posittion.bullet[1]);
			}
			if(game.respawn_time.freeze==0){
				game.buffer.drawImage(game.items.freeze,game.respawn_posittion.freeze[0],game.respawn_posittion.freeze[1]);
			}
			if(game.respawn_time.speed==0){
				game.buffer.drawImage(game.items.speed,game.respawn_posittion.speed[0],game.respawn_posittion.speed[1]);
			}
					
			/*
				ACTION STARTERS
			*/
			if((game.hero[i].x > game.respawn_posittion.bullet[0] && game.hero[i].x < game.items.bullet.width+game.respawn_posittion.bullet[0]) 
					|| (game.hero[i].y > game.respawn_posittion.bullet[1] && game.hero[i].y<game.items.bullet.height)){
				game.buffer.fillStyle="#000000";
				game.buffer.fillRect(game.respawn_posittion.bullet[0]+3,game.respawn_posittion.bullet[1]+3,game.items.bullet.width,game.items.bullet.height);
				game.buffer.fill();
				game.action_in_use.bullet=true;
				game.actions.bullet_vector = [game.hero[i].direction[0],game.hero[i].direction[1]];
				game.actions.bullet = [x,y];
				game.actions_ids.bullet=i;
			}
			if((game.hero[i].x > game.respawn_posittion.freeze[0] && game.hero[i].x < game.items.freeze.width+game.respawn_posittion.freeze[0]) 
					|| (game.hero[i].y > game.respawn_posittion.freeze[1] && game.hero[i].y<game.items.freeze.height)){
				game.buffer.fillStyle="#000000";
				game.buffer.fillRect(game.respawn_posittion.freeze[0],game.respawn_posittion.freeze[1],game.items.freeze.width,game.items.freeze.height);
				game.buffer.fill();
				game.action_in_use.freeze=true;
				game.actions.freeze_time = 20;
				game.actions_ids.freeze = i;
			}
			if((game.hero[i].x > game.respawn_posittion.speed[0] && game.hero[i].x < game.items.speed.width+game.respawn_posittion.speed[0]) 
					|| (game.hero[i].y > game.respawn_posittion.speed[1] && game.hero[i].y<game.items.speed.height)){
				game.buffer.fillStyle="#000000";
				game.buffer.fillRect(game.respawn_posittion.speed[0],game.respawn_posittion.speed[1],game.items.speed.width,game.items.speed.height);
				game.buffer.fill();
				game.action_in_use.speed=true;
				game.actions.speed_time=30;
				game.actions_ids.speed=i;
				game.hero[i].multi=3;
			}
			
			/*
				ACTION STARTERS END
			*/

				/*
						BULLET
						*/
						if(game.action_in_use.bullet){
							game.buffer.beginPath();
							game.buffer.strokeStyle="#000000";
							var old_x = game.actions.bullet[0] - game.actions.bullet_vector[0]*50;
							var old_y = game.actions.bullet[1] - game.actions.bullet_vector[1]*50;
							game.buffer.moveTo(old_x,old_y);
							game.buffer.lineTo(game.actions.bullet[0],game.actions.bullet[1]);
							game.buffer.stroke();
							game.buffer.closePath();
							game.buffer.beginPath();
							game.buffer.strokeStyle="#ffffff";
							var new_x = game.actions.bullet[0] + game.actions.bullet_vector[0]*50;
							var new_y = game.actions.bullet[1] + game.actions.bullet_vector[1]*50;
							game.buffer.lineTo(new_x,new_y);
							game.buffer.stroke();
							var data = game.buffer.getImageData(new_x,new_y,50,50).data;
							for (var u=0;u<data.length;u++){
								if(data[u] != 0){
									data[u] = 0;
								}
								else{}
							}
							game.buffer.closePath();
						}
						
						if((x<game.canvas.width) && (x>0) && (y<game.canvas.height) && (y>0)
								 && (game.respawn_posittion.bullet[0]<x ) && ((game.respawn_posittion.bullet[0]+game.items.bullet.width) > x )
								 && (game.respawn_posittion.bullet[1]<y) && ((game.respawn_posittion.bullet[1]+game.items.bullet.height) > y)
								&& (game.respawn_posittion.speed[0]<x ) && ((game.respawn_posittion.speed[0]+game.items.speed.width) > x )
								 && (game.respawn_posittion.speed[1]<y) && ((game.respawn_posittion.speed[1]+game.items.speed.height) > y)
								 && (game.respawn_posittion.freeze[0]<x ) && ((game.respawn_posittion.freeze[0]+game.items.freeze.width) > x )
								 && (game.respawn_posittion.freeze[1]<y) && ((game.respawn_posittion.freeze[1]+game.items.freeze.height) > y)
							){
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
							}

							
							
							
						
							
						
						
						
						game.buffer.beginPath();
						game.buffer.moveTo(game.hero[i].x,game.hero[i].y);
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
			
		};////next point color check && frame limits
		
	};

	
	game.draw_maze=function(){
			
			game.buffer.fillStyle="#ff1111";
			var x;
			var y;
			game.buffer.fillRect(200,0,100,50);
			game.maze_rects.push([200,0]);
			
			while(game.maze_rects.length<=20){
				
				
					 x = Math.random()*game.canvas.width;
					 y = Math.random()*game.canvas.height;
					if(x<game.canvas.width-150 && x>150 && y<game.canvas.height-150 && y>150 && game.maze_rects.length%2==0){
						game.buffer.fillRect(x,y,50,100);
						game.maze_rects.push([x,y]);
						
					}
					else if(x<game.canvas.width-150 && x>150 && y<game.canvas.height-150 && y>150){
						game.buffer.fillRect(x,y,100,50);
						game.maze_rects.push([x,y]);
						
					}
				
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
		game.http.send("x="+game.hero[game.my].x+"&y="+game.hero[game.my].y+"&attrs="+game.hero[game.my].attrs.join(";"));
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

