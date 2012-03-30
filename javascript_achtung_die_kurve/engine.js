function game(){
	var _g = this;
	_g.hero = [];
	
	_g.attrs = {};
	_g.canvas = document.getElementById("_gspace");
	_g.buff = document.createElement("canvas");
	_g.buff.width = _g.canvas.width;
	_g.buff.height = _g.canvas.height;
	_g.buffer = _g.buff.getContext("2d");
	_g.ctx = _g.canvas.getContext("2d");
	_g.pressed = new Array();
	_g.maze_rects=[];
	_g.started=false;
	_g.http = new XMLHttpRequest();
	
	/*
	 * ITEMS
	*/
	
	_g.defaults = {
		respawn_time:100,
		bullet_speed:50,
		disapear_time:50,
		iteration_number:10
	};
	
	_g.dbg = "";
	_g.attrs.actions = {
			freeze_time:0,
			speed_time:0,
			running:0,  //How many is still running
			bullet:[],  //bullet posittion
			bullet_vector:[],
			bullet_speed:50,
			bullet_width:5,
			last:0
	};
	_g.attrs.respawn_time = {
			freeze:0,
			speed:0,
			bullet:0
	};
	_g.attrs.respawn_posittion = {
			bullet:[],
			speed:[],
			freeze:[]
	};
	_g.attrs.disapear_time = {
			freeze:0,
			speed:0,
			bullet:0
	};
	_g.attrs.already_respawned = {
			freeze:0,
			speed:0,
			bullet:0
	};
	_g.attrs.ready_to_respawn = {
			freeze:false,
			speed:false,
			bullet:false
	};
	
	_g.attrs.actions_ids = {
			freeze:0,
			bullet:0,
			speed:0
	};
	_g.attrs.action_in_use = {
			speed:false,
			freeze:false,
			bullet:false
	};
	_g.attrs.ready_to_start = [
		false,
		false,
		false,
		false
	];
	_g.debug=true;
	_g.attrs.errors = "";
	/*
		ITEMS END
	*/
	
	_g.loop = function(){
		//console.log("Not Running");
		_g.started=true;
		for(var i=0;i<=_g.attrs.ready_to_start.length-1;i++){
			_g.started=_g.started && _g.attrs.ready_to_start[i];
		}
		
		if(_g.attrs.errors != "" && _g.started && !_g.debug){
			
			var div = document.createElement("div");
			var name = _g.attrs.errors.split(";");
			for(var u=0;u<=name.length-1;u++){
				div.innerHTML+="<p>"+name[u]+"</p>";
			}
			document.body.appendChild(div);
			_g.attrs.errors = "";
			if(_g.debug){
				alert(_g.attrs.errors);
			}
			_g.started=false;
			
		}
		else{

			if(_g.debug){
				_g.started=true;
			}
				
			 
			if((_g.status &&_g.started)){
				_g.started=true;
				//console.log("Running");
				for(var i=0;i<=_g.hero.length-1;i++){
					
					if(_g.attrs.actions.running == 1){
						_g.attrs.actions.last=i;
						_g.status = false;
					}
					
					if(!_g.hero[i].running){
						if(!_g.attrs.action_in_use.freeze || (_g.attrs.action_in_use.freeze && _g.attrs.actions_ids.freeze ==i)){
							_g.attrs.actions.running--;
						}
					}
					
					_g.key_handler();
					_g.throw_items(i);
					_g.change_vector(i);
					_g.draw(i);
					_g.http_comm();
				}
				
			}
		}
	};
	_g.throw_items = function(i){
		/*
			RESPAWN
		*/
		if( _g.attrs.already_respawned.bullet==1 && _g.attrs.disapear_time.bullet>0){
			_g.attrs.disapear_time.bullet--;
		}
		if( _g.attrs.already_respawned.freeze==1 && _g.attrs.disapear_time.freeze>0){
			_g.attrs.disapear_time.freeze--;
		}
		if( _g.attrs.already_respawned.speed==1 && _g.attrs.disapear_time.speed>0){
			_g.attrs.disapear_time.speed--;
		}
		
		if( ((!_g.attrs.action_in_use.bullet && _g.attrs.respawn_time.bullet <= 0) || _g.attrs.respawn_time.bullet<=0) && !_g.attrs.ready_to_respawn.bullet  && _g.attrs.already_respawned.bullet<=0 &&
				_g.attrs.disapear_time.bullet<=0){
			var tf=0;


				_g.attrs.respawn_posittion.bullet = [Math.random()*(_g.canvas.width-_g.items.bullet.width),Math.random()*(_g.canvas.height-_g.items.bullet.height)];
				_g.attrs.respawn_time.bullet = Math.random(0,1)*500;
				
				for(var u=0;u<=_g.maze_rects.length-1;u++){
				
					if((_g.maze_rects[u][0]+100 > _g.attrs.respawn_posittion.bullet[0] && _g.maze_rects[u][0] < _g.attrs.respawn_posittion.bullet[0]+_g.items.bullet.width) &&
							(_g.maze_rects[u][1]+100 > _g.attrs.respawn_posittion.bullet[1] && _g.maze_rects[u][1] < _g.attrs.respawn_posittion.bullet[1]+_g.items.bullet.height)){	

						tf--;
						
					}
					else{
						tf++;
					}
				

				}
			
			
			if(tf==_g.maze_rects.length){
				
				_g.attrs.ready_to_respawn.bullet=true;
			}
				
		}
		if( ((!_g.attrs.action_in_use.freeze && _g.attrs.respawn_time.freeze <= 0) || _g.attrs.respawn_time.freeze<=0) && !_g.attrs.ready_to_respawn.freeze  && _g.attrs.already_respawned.freeze<=0 &&
				_g.attrs.disapear_time.freeze<=0){
			var tf=0;
			
				_g.attrs.respawn_posittion.freeze = [Math.random()*(_g.canvas.width-_g.items.freeze.width),Math.random()*(_g.canvas.height-_g.items.freeze.height)];
				_g.attrs.respawn_time.freeze = Math.random(0,1)*500;
			
				for(var u=0;u<=_g.maze_rects.length-1;u++){

					if((_g.maze_rects[u][0]+100 > _g.attrs.respawn_posittion.freeze[0] && _g.maze_rects[u][0] < _g.attrs.respawn_posittion.freeze[0]+_g.items.freeze.width) &&
							(_g.maze_rects[u][1]+100 > _g.attrs.respawn_posittion.freeze[1] && _g.maze_rects[u][1] < _g.attrs.respawn_posittion.freeze[1]+_g.items.freeze.height)){	

						tf--;
						
					}
					else{
						tf++;
					}
				}
			
			
			if(tf==_g.maze_rects.length){
				_g.attrs.ready_to_respawn.freeze=true;
			}

		}
		if( ((!_g.attrs.action_in_use.speed && _g.attrs.respawn_time.speed <= 0 ) || _g.attrs.respawn_time.speed<=0) && !_g.attrs.ready_to_respawn.speed && _g.attrs.already_respawned.speed<=0 && 
				_g.attrs.disapear_time.speed<=0){
			var tf=0;
			
			_g.attrs.respawn_posittion.speed = [Math.random()*(_g.canvas.width-_g.items.speed.width),Math.random()*(_g.canvas.height-_g.items.speed.height)];
			_g.attrs.respawn_time.speed = Math.random(0,1)*500;
			
				for(var u=0;u<=_g.maze_rects.length-1;u++){

					if((_g.maze_rects[u][0]+100 > _g.attrs.respawn_posittion.speed[0] && _g.maze_rects[u][0] < _g.attrs.respawn_posittion.speed[0]+_g.items.speed.width) &&
							(_g.maze_rects[u][1]+100 > _g.attrs.respawn_posittion.speed[1] && _g.maze_rects[u][1] < _g.attrs.respawn_posittion.speed[1]+_g.items.speed.height)){	

						tf--;
						
					}
					else{
						tf++;
					}
				}
			
			if(tf==_g.maze_rects.length){
				_g.attrs.ready_to_respawn.speed=true;
			}
				

		}
		/*
			SPEED
		*/
		
		if(_g.attrs.action_in_use.speed){
			_g.attrs.actions.speed_time--;
		}


		
		if(!_g.attrs.action_in_use.bullet && _g.attrs.respawn_time.bullet > 0){
			_g.attrs.respawn_time.bullet--;
		}
		
		if(!_g.attrs.action_in_use.freeze && _g.attrs.respawn_time.freeze > 0){
			_g.attrs.respawn_time.freeze--;
		}
		
		if(!_g.attrs.action_in_use.speed && _g.attrs.respawn_time.speed > 0){
			_g.attrs.respawn_time.speed--;
		}

		
		if(_g.attrs.action_in_use.speed && _g.attrs.actions.speed_time == 0){

			_g.hero[_g.attrs.actions_ids.speed].multi = 2;
			_g.attrs.action_in_use.speed=false;
			
		}
		/*
			FREEZE
		*/
		if(_g.attrs.action_in_use.freeze){
			_g.attrs.actions.freeze_time--;
			if(_g.attrs.actions_ids.freeze != i){
				_g.hero[i].running=false;
			}
		}
		if(!_g.attrs.action_in_use.freeze){
			_g.hero[i].running=true;
		}

		if(_g.attrs.action_in_use.freeze &&_g.attrs.actions.freeze_time <=0){
			_g.attrs.action_in_use.freeze=false;
		}
		
		
		
	};
	/*
	INIT	
	*/
	_g.init = function(nick){
		/*
		ITEM IMAGES
		*/
		var bullet=new Image();
		bullet.src="bullet.gif";
		var time=new Image();
		time.src="time.jpg";
		var speed=new Image();
		speed.src="energy.png";
		_g.items = {
				bullet:bullet, //image
				
				speed:speed,   //image
				
				freeze:time    //image 
				
		};
		/*
		END
		*/
		_g.my=0;
		console.log("init");
		_g.status = false;
		/*18*/
		_g.url = "http://localhost/workspace/javascript_achtung_die_kurve/controller.php";
		
		_g.butt = document.createElement("input");
		_g.butt.type = "button";
		_g.butt.id="pause";
		_g.butt.value="Start/Stop";
		_g.butt.onclick = function(){
			if(!_g.status){
				_g.status = true;

			}
			else{
				_g.status = false;
			}

		};
		/*
		HERO SPAWN
		*/
			_g.hero[_g.my] = ({
			name:nick,
			running:true,
			x:50,
			y:50,
			//[x,y] vector 
			direction:new Array(0,0),
			angle:0,
			color:"#ff1111",
			multi:2,
			time_multi:0,
			line_pause:100,   /*pause*/
			pause_length:3,
			immune:false,
			immune_time:0    //  
			});
		/*
		END
		*/
		_g.attrs.actions.running+=2;	
		_g.draw_maze();
		_g.first_communication(nick);
		document.getElementsByTagName("body")[0].appendChild(_g.butt);
		window.document.onkeydown = function(e){
			for(var o=0;o<_g.pressed.length;o++){
				if(_g.pressed[o] == e.keyCode){
					return;
				}
			}
			_g.pressed.push(e.keyCode);

		};
		window.document.onkeyup = function(e){
			for(var o=0;o<_g.pressed.length;o++){
				if(_g.pressed[o] == e.keyCode){
					_g.pressed.splice(o, 1);
				}
			}
			

		};
		setInterval(function(){_g.loop();},"100");
	};
	/*
	INIT END
	*/
	_g.key_handler = function(){
		for(var o=0;o<_g.pressed.length;o++){
			switch(_g.pressed[o]){
				case 81/*q*/:
	
					_g.hero[0].angle-=0.1308996938995747;//(Math.PI/24)  15DEG
					break;
				case 87/*w*/:
					_g.hero[0].angle+=0.1308996938995747;
					break;
				case 70/*f*/:
					_g.hero[1].angle-=0.1308996938995747;
					break;
				case 71/*g*/:
					_g.hero[1].angle+=0.1308996938995747;
					break;
				default:
					break;
			}
		}

		};
	_g.draw = function(i){
					if(_g.attrs.ready_to_respawn.bullet && _g.attrs.already_respawned.bullet < 1){
						_g.buffer.drawImage(_g.items.bullet,_g.attrs.respawn_posittion.bullet[0],_g.attrs.respawn_posittion.bullet[1],_g.items.bullet.width,_g.items.bullet.height);
						_g.attrs.already_respawned.bullet++;
						_g.attrs.disapear_time.bullet=_g.defaults.disapear_time;
						_g.attrs.ready_to_respawn.bullet=false;
						console.log("Bullet respawned");
					}
					if(_g.attrs.ready_to_respawn.freeze && _g.attrs.already_respawned.freeze < 1){
						_g.buffer.drawImage(_g.items.freeze,_g.attrs.respawn_posittion.freeze[0],_g.attrs.respawn_posittion.freeze[1],_g.items.freeze.width,_g.items.freeze.height);
						_g.attrs.already_respawned.freeze++;
						_g.attrs.disapear_time.freeze=_g.defaults.disapear_time;
						_g.attrs.ready_to_respawn.freeze=false;
						console.log("Freeze respawned");
					}
					if(_g.attrs.ready_to_respawn.speed && _g.attrs.already_respawned.speed < 1){
						_g.buffer.drawImage(_g.items.speed,_g.attrs.respawn_posittion.speed[0],_g.attrs.respawn_posittion.speed[1],_g.items.speed.width,_g.items.speed.height);
						_g.attrs.already_respawned.speed++;
						_g.attrs.disapear_time.speed=_g.defaults.disapear_time;
						_g.attrs.ready_to_respawn.speed=false;
						console.log("Speed respawned");
					}
					if(_g.attrs.disapear_time.bullet<=0 && _g.attrs.already_respawned.bullet == 1){
						_g.buffer.fillStyle="#000000";
						_g.buffer.fillRect(_g.attrs.respawn_posittion.bullet[0]-1,_g.attrs.respawn_posittion.bullet[1]-1,_g.items.bullet.width+2,_g.items.bullet.height+2);
						_g.buffer.fill();
						_g.attrs.already_respawned.bullet--;
					}
					if(_g.attrs.disapear_time.speed<=0 && _g.attrs.already_respawned.speed == 1){
						_g.buffer.fillStyle="#000000";
						_g.buffer.fillRect(_g.attrs.respawn_posittion.speed[0]-1,_g.attrs.respawn_posittion.speed[1]-1,_g.items.speed.width+2,_g.items.speed.height+2);
						_g.buffer.fill();
						_g.attrs.already_respawned.speed--;
					}
					if(_g.attrs.disapear_time.freeze<=0 && _g.attrs.already_respawned.freeze == 1 ){
						_g.buffer.fillStyle="#000000";
						_g.buffer.fillRect(_g.attrs.respawn_posittion.freeze[0]-1,_g.attrs.respawn_posittion.freeze[1]-1,_g.items.freeze.width+2,_g.items.freeze.height+2);
						_g.buffer.fill();
						_g.attrs.already_respawned.freeze--;
					}
					
							
					/*
						ACTION STARTERS
					*/
					if(_g.attrs.already_respawned.bullet==1 && (_g.hero[i].x > _g.attrs.respawn_posittion.bullet[0] && _g.hero[i].x < _g.items.bullet.width+_g.attrs.respawn_posittion.bullet[0]) 
							&& (_g.hero[i].y > _g.attrs.respawn_posittion.bullet[1] && _g.hero[i].y<_g.items.bullet.height+_g.attrs.respawn_posittion.bullet[1])){
						_g.buffer.fillStyle="#000000";
						_g.buffer.fillRect(_g.attrs.respawn_posittion.bullet[0],_g.attrs.respawn_posittion.bullet[1],_g.items.bullet.width,_g.items.bullet.height);
						_g.buffer.fill();
						_g.attrs.action_in_use.bullet=true;
						_g.attrs.already_respawned.bullet--;
						_g.attrs.actions.bullet_vector = [_g.hero[i].direction[0],_g.hero[i].direction[1]];
						_g.attrs.actions.bullet = [_g.hero[i].x,_g.hero[i].y];
						_g.attrs.actions_ids.bullet=i;
						console.log("Bullet in use");
					}
					
					if(_g.attrs.already_respawned.freeze==1 && (_g.hero[i].x > _g.attrs.respawn_posittion.freeze[0] && _g.hero[i].x < _g.items.freeze.width+_g.attrs.respawn_posittion.freeze[0]) 
							&& (_g.hero[i].y > _g.attrs.respawn_posittion.freeze[1] && _g.hero[i].y<_g.items.freeze.height+_g.attrs.respawn_posittion.freeze[1])){
						_g.buffer.fillStyle="#000000";
						_g.buffer.fillRect(_g.attrs.respawn_posittion.freeze[0],_g.attrs.respawn_posittion.freeze[1],_g.items.freeze.width,_g.items.freeze.height);
						_g.buffer.fill();
						_g.attrs.action_in_use.freeze=true;
						_g.attrs.already_respawned.freeze--;
						_g.attrs.actions.freeze_time = 20;
						_g.attrs.actions_ids.freeze = i;
						console.log("Freeze in use");
					}
					
					if(_g.attrs.already_respawned.speed==1 && (_g.hero[i].x > _g.attrs.respawn_posittion.speed[0] && _g.hero[i].x < _g.items.speed.width+_g.attrs.respawn_posittion.speed[0]) 
							&& (_g.hero[i].y > _g.attrs.respawn_posittion.speed[1] && _g.hero[i].y<_g.items.speed.height+_g.attrs.respawn_posittion.speed[1])){
						_g.buffer.fillStyle="#000000";
						_g.buffer.fillRect(_g.attrs.respawn_posittion.speed[0],_g.attrs.respawn_posittion.speed[1],_g.items.speed.width,_g.items.speed.height);
						_g.buffer.fill();
						_g.attrs.already_respawned.speed--;
						_g.attrs.action_in_use.speed=true;
						_g.attrs.actions.speed_time=30;
						_g.attrs.actions_ids.speed=i;
						_g.hero[i].multi=3;
						console.log("Speed in use");
					}
					
					if(_g.attrs.action_in_use.bullet){
						console.log("Bullet lauched");
						_g.attrs.action_in_use.bullet=false;
						
						_g.buffer.beginPath();
						_g.buffer.strokeStyle="#000000";
						var old_x = _g.attrs.actions.bullet[0] - _g.attrs.actions.bullet_vector[0]*50;
						var old_y = _g.attrs.actions.bullet[1] - _g.attrs.actions.bullet_vector[1]*50;
						_g.buffer.moveTo(old_x,old_y);
						_g.buffer.lineTo(_g.attrs.actions.bullet[0],_g.attrs.actions.bullet[1]);
						_g.buffer.stroke();
						_g.buffer.closePath();
						_g.buffer.beginPath();
						_g.buffer.strokeStyle="#ffffff";
						_g.buffer.fillStyle="#000000";
						var new_x = curve.attrs.actions.bullet[0] + curve.attrs.actions.bullet_vector[0]*50;
						var new_y = curve.attrs.actions.bullet[1] + curve.attrs.actions.bullet_vector[1]*50;
						curve.buffer.lineTo(new_x,new_y);
						curve.buffer.stroke();
						var d =curve.buffer.getImageData(new_x,new_y,1,1).data;
						if(d[0] != 0 || d[1] != 0 || d[2] != 0){
							curve.buffer.fillRect(new_x,new_y,50,50);
							return;
						}
						_g.buffer.closePath();
						_g.attrs.actions.bullet = [new_x,new_y];
						console.log("Bullet hit");
					}
		if(_g.hero[i].running){

			var x = _g.hero[i].x+_g.hero[i].direction[0];
			var y = _g.hero[i].y+_g.hero[i].direction[1];

			/*
			RESPAWNERS
			*/
			
			
			/*
				ACTION STARTERS END
			*/

				/*
						BULLET
						*/
						
						
						if((x<_g.canvas.width) && (x>0) && (y<_g.canvas.height) && (y>0)
								 && ((!_g.attrs.already_respawned.bullet) || ((x<_g.attrs.respawn_posittion.bullet[0] ) || ((_g.attrs.respawn_posittion.bullet[0]+_g.items.bullet.width) < x ))
								 && (_g.attrs.respawn_posittion.bullet[1]>y) || ((_g.attrs.respawn_posittion.bullet[1]+_g.items.bullet.height) < y))
								&& ((!_g.attrs.already_respawned.speed) || ((_g.attrs.respawn_posittion.speed[0]>x || ((_g.attrs.respawn_posittion.speed[0]+_g.items.speed.width) < x ))
								 && (_g.attrs.respawn_posittion.speed[1]>y) || ((_g.attrs.respawn_posittion.speed[1]+_g.items.speed.height) < y)))
								 && ((!_g.attrs.already_respawned.freeze) || ( (_g.attrs.respawn_posittion.freeze[0]>x ) || ((_g.attrs.respawn_posittion.freeze[0]+_g.items.freeze.width) < x ))
								 && ( _g.attrs.respawn_posittion.freeze[1]>y) || ((_g.attrs.respawn_posittion.freeze[1]+_g.items.freeze.height) < y))
							){
							var data = _g.buffer.getImageData(x+_g.hero[i].direction[0],y+_g.hero[i].direction[1],1,1).data;
								for (var u=0;u<=2;u++){
									if(data[u] != 0){
										_g.hero[i].running = false;
										console.log(_g.hero[i].name+ " ended.");
										var div = document.createElement("div");
										div.innerHTML = _g.hero[i].name+ " ended.";
										document.body.appendChild(div);
										break;
										// return;
									}
									
								}
							}



						_g.buffer.beginPath();
						_g.buffer.moveTo(_g.hero[i].x,_g.hero[i].y);
						_g.buffer.strokeStyle=_g.hero[i].color;
						_g.buffer.lineTo(x,y);
						
						_g.buffer.closePath();
						_g.hero[i].x = x;
						_g.hero[i].y = y;
						
						if(_g.hero[i].line_pause == 0){
							if(_g.hero[i].pause_length != 0){
								_g.hero[i].pause_length--;
								return;
							}
							else{
								_g.hero[i].line_pause=100;
								_g.hero[i].pause_length=3;
							}
						}
						else{
							_g.hero[i].line_pause--;
						}
						_g.buffer.stroke();
						
						
						var buff_data = _g.buffer.getImageData(0,0,_g.buff.width,_g.buff.height);
						_g.ctx.putImageData(buff_data,0,0);
			
		};////next point color check && frame limits
		
	};

	
	_g.draw_maze=function(){
			
			_g.buffer.fillStyle="#ff1111";
			var x;
			var y;
			_g.buffer.fillRect(200,0,100,50);
			_g.maze_rects.push([200,0]);
			
			while(_g.maze_rects.length<=20){
				
				
					 x = Math.random()*_g.canvas.width;
					 y = Math.random()*_g.canvas.height;
					if(x<_g.canvas.width-150 && x>150 && y<_g.canvas.height-150 && y>150 && _g.maze_rects.length%2==0){
						_g.buffer.fillRect(x,y,50,100);
						_g.maze_rects.push([x,y,0]);
						
					}
					else if(x<_g.canvas.width-150 && x>150 && y<_g.canvas.height-150 && y>150){
						_g.buffer.fillRect(x,y,100,50);
						_g.maze_rects.push([x,y,1]);
						
					}
				
			}
	};


	
	_g.change_vector = function(i){
		if(_g.hero[i].running){
			var x = Math.cos(_g.hero[i].angle)*_g.hero[i].multi;
			var y = Math.sin(_g.hero[i].angle)*_g.hero[i].multi;
	
			_g.hero[i].direction = [x,y];
			
		}
	};
	_g.first_communication = function(nick){
		//console.log("First communication");
		
			_g.http.open("POST", _g.url+"?name="+nick, true);
			_g.http.send("");
			_g.http.onreadystatechange = function(){
				if(_g.http.readyState == 4){
					var text = _g.http.responseText;
					if(text != ""){
						_g.http_process(text);
					}
					else{
						_g.attrs.errors = _g.attrs.errors+"Communication null;";
					}
				}
		};

	};
	_g.http_comm=function(){
		//console.log("communication ");
			_g.http.open("POST", _g.url, true);
			_g.http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			//var text = Base64.encode("hero["+_g.my+"]="+JSON.stringify(_g.hero[_g.my])+"&attrs="+JSON.stringify(_g.attrs));
			_g.http.send("hero["+_g.my+"]="+JSON.stringify(_g.hero[_g.my]));
			_g.http.onreadystatechange = function(){
					if(_g.http.readyState == 4){
						var text = _g.http.responseText;
						if(text != ""){
							_g.http_process(text);
						}
						else{
							_g.attrs.errors = _g.attrs.errors+"Communication null;";
						}
					}
			};
	};
	_g.http_process = function(data){
		var datas = data.split("&");
					for(var u=0;u<=datas.length-1;u++){
						var names = datas[u].split("=");
						if(names[0].indexOf("attrs.ready_to_start") < 0){
							eval('(_g.'+names[0]+' = '+names[1]+')');
						}
					}
			
	};
	

}

/*
 * Constructor
 */

	var curve = new game();
	curve.init("jonny");
	
