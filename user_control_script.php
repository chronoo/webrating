<?
	$host="localhost";
    $log="root";
    $pass="";
    $db_name="metric";
    $link = mysqli_connect($host,$log,$pass,$db_name);

    $user =$_POST['user'];
    $action = $_POST['action'];

    if($action=='заблокировать')
    {
    	$query="UPDATE user SET active=2 WHERE login='$user'";
        mysqli_query($link,$query);
    }else if ($action=='разблокировать')    	
    {
    	$query="UPDATE user SET active=1 WHERE login='$user'";
        mysqli_query($link,$query);
    }else if ($action=='удалить') 
    {
        mysqli_query($link,"DELETE from site WHERE user_id=(select user_id from user where login='$user')");
        mysqli_query($link,"DELETE from user WHERE login='$user'");
    }

    //echo "$query";
    mysqli_query($link,$query);
    mysqli_close($link);
?>