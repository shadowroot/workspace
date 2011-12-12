<?php
$path = "temp/";
if(isset($_FILES['csv'])){
	if(is_uploaded_file($_FILES['csv'])){
		$temp = $temp.$_FILES['csv']['name'].".temp";
		if(move_uploaded_file($_FILES['csv']['tmp_name'] , $temp)){
			if($_FILES['csv']['size'] == filesize($temp)){
				chmod($temp,"777");
				$hFile = fopen($temp, 'r');
				$data = fread($hFile, filesize($temp));
				fclose($hFile);
				$rows = explode("\n", $data);
				$out = "<h2>Výpis Vašeho souboru je tato tabulka:</h2>";
				$out .= "<table>";
				foreach ($rows as $row){
					$out .= "<tr>";
					$cols = explode(",", $row);
					foreach ($cols as $col){
						if($col[0] == '"'){
							$col = substr($col, 1, -1);
						}
						if($col[0] == "'"){
							$col = substr($col, 1, -1);
						}
						$out .= "<td>".$col."</td>";
					}
					$out .= "</tr>";
				}
				$out .= "</table>";
				echo $out;
			}
			else{
				echo "Upload neuspesny";
			}
		}
	}
}

?>