<?php
	
	if(isset($_POST['imgdata'])){
		$a = $_POST['imgdata'];

		$a = str_replace('data:image/png;base64,', '', $a);
		$b = base64_decode($a);

		$name = time();

		file_put_contents("upload/". $name .".png", $b);

		echo $name;
	}elseif(isset($_POST["name"])){
		echo 1;
	}else{
		echo 0;
	}
		

?>
