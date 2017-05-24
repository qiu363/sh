<?php

	if(isset($_POST['imgdata'])){
		$a = $_POST['imgdata'];

		if (preg_match("/data:image\/jpeg/", $a)) {
			$a = str_replace('data:image/jpeg;base64,', '', $a);
			$type = "jpg";
		} else if (preg_match("/data:image\/png/", $a)) {
			$a = str_replace('data:image/png;base64,', '', $a);
			$type = "png";
		}

		$b = base64_decode($a);

		$name = time();

		file_put_contents("upload/" . $name . "." . $type, $b);

		echo $name . "." . $type;
	}elseif(isset($_POST["name"])){
		echo 1;
	}else{
		echo 0;
	}

?>
