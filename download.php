<?php
$currentDomain = $_GET['domain'];

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
	<code>
		<pre>
sudo mkdir -p /var/www/<?php echo $currentDomain; ?>/public_html
sudo chown -R www-data:www-data /var/www/<?php echo $currentDomain; ?>/public_html
sudo chmod 755 /var/www
#Add host
sudo ln -s /etc/nginx/sites-available/<?php echo $currentDomain; ?>.conf /etc/nginx/sites-enabled/<?php echo $currentDomain; ?>.conf
sudo service nginx restart
		</pre>
	</code>
	<form method="post">
		<input name="domain" type="hidden" class="form-control" value="<?php echo $currentDomain; ?>">
		<button type="submit">Download</button>
	</form>
</body>
</html>