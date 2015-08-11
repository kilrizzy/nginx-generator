<?php
if(isset($_POST['domain'])){
	$domain = $_POST['domain'];
	$filename = $domain.'.conf';
	//include
	ob_start();
	include('template.php');
	$contents = ob_get_contents();
	ob_end_clean();

	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	//header("Content-Length: ". filesize("$filename").";");
	header("Content-Disposition: attachment; filename=".$filename);
	header("Content-Type: application/octet-stream; "); 
	header("Content-Transfer-Encoding: binary");
	echo $contents;
	die();
}
?>
<html>
<body>
	<form method="post">
		<input name="domain" type="text" class="form-control" placeholder="website.com">
		<button type="submit">Download</button>
	</form>
</body>
</html>