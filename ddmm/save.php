<?php
	
	$a = $_POST['imgdata'];

	$a = str_replace('data:image/jpeg;base64,', '', $a);
	$b = base64_decode($a);

	file_put_contents("a.jpeg", $b);

	echo 1;

?>
