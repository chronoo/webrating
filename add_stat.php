<?	
	header('Access-Control-Allow-Origin: *');
	$host="localhost";
    $log="root";
    $pass="";
    $db_name="metric";
    $link = mysqli_connect($host,$log,$pass,$db_name);    

    $ref =$_POST['ref'];
    $url =$_POST['url'];
    $site =$_POST['site'];
    $token=$_POST['token'];

	 if (!empty($_SERVER['HTTP_CLIENT_IP']))
	{
	  $ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
	  $ip=$_SERVER['REMOTE_ADDR'];
	}
	$query = mysqli_query($link,"SELECT site_id from site where site='$site' and `key`=$token");
 
	 if (mysqli_num_rows($query) > 0)
	 {
	 	mysqli_query($link,"INSERT IGNORE refer SET url='$ref'");
	    mysqli_query($link,"INSERT IGNORE visitor SET ip='$ip'");	
	    mysqli_query($link,"INSERT IGNORE page VALUES(NULL,'$url',((select site_id from site where site='$site')))");		
	    mysqli_query($link,"INSERT IGNORE statistic VALUES(
				NULL,
				date_sub(NOW(), INTERVAL 3 HOUR),
				(SELECT page_id from page where url='$url'),
				(SELECT refer_id from refer where url='$ref'),
				(SELECT visit_id from visitor where ip='$ip')
	    	)");
 	}
 	mysqli_close($link);
?>