<?php
/*
 * CHACHA CUBE
 * 
 * Compression algorithm using cube like bigger 3D sudoku.
 * Using checksums in each square
 * 3sqrt of size in Bytes = resolution of square
 * 
 * Crypt algorithm
 * 
 */
$filename = 'test.dat';
$file = fopen($filename, 'a+');
$size = filesize($filename);
$data = fread($file, $size);
fclose($file);

$row = pow($size, (1/3));

$index = 0;
$sum_x = array();
$sum_y = array();
$sum_z = array();

for ($z=0;$z<=$row;$z++){
	
	
	for($y=0;$y<=$row;$y++){

		
		for($x=0;$x<=$row;$x++){
			$sum_x[$z][$y] += $data[$index];
			$sum_y[$z][$x] += $data[$index];
			$sum_z[$x][$y] += $data[$index];
			$index++;
		}
		
		
	}
	
	
}
touch("test.cha");
$fcha = fopen("test.cha", 'a+');
$delimiter = ";";
$puts = $size.$delimiter.$row.$delimiter;

$i=0;
for($n=0;$n<=$row;$n++){
	for($m=0;$m<=$row;$m++){
		$size = 0;
		$size += $sum_z[$n][$m];
	}
	$z[$i] = $size;
	$i++;
}

for($u=0;$u<=$row;$u++){
	for($i=0;$i<=$row;$i++){
		$puts .= $sum_x[$i].$delimiter;
	}

	for($i=0;$i<=$row;$i++){
		$puts .= $sum_y[$i].$delimiter;
	}
}

for($k=0;$k<=($row*$row);$k++){
	$puts .= $z[$k].$delimiter;
}
	
$all = fwrite($fcha, $puts);




	if(strlen($puts) == $all){
		touch("test.size");
		$fsize = fopen("test.size", 'w+');
		fwrite($fsize, $all);
		fclose($fsize);
	}
	
	
	
fclose($fcha);
?>