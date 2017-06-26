<?
    $host="localhost";
    $user="root";
    $pass="";
    $db_name="metric";
    $link = mysqli_connect($host,$user,$pass,$db_name);
    session_start();
    $username=$_SESSION['login'];
    $site=$_POST['site_name'];
    $site=htmlspecialchars($site);
    $key=rand(100000,10000000);
    $query="INSERT IGNORE site
	VALUES 
	(NULL,
	'$site',
	$key,
	(select user_id from user where login='$username'))";
	$resp=mysqli_query($link,$query); 
	header("Location: index.php?page=user");	  
?>