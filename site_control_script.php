<?
	$host="localhost";
    $log="root";
    $pass="";
    $db_name="metric";
    $link = mysqli_connect($host,$log,$pass,$db_name);

    $site =$_POST['site'];
    $action = $_POST['action'];

    if($action=='удалить') 
    {
        mysqli_query($link,"DELETE from page WHERE site_id=(select site_id from site where site='$site')");
        mysqli_query($link,"DELETE from site WHERE site='$site'");
    }
    mysqli_query($link,$query);
    mysqli_close($link);
?>