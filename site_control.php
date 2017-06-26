<?
	$host="localhost";
    $user="root";
    $pass="";
    $db_name="metric";
    $link = mysqli_connect($host,$user,$pass,$db_name);

    $query="SELECT 
			site
			FROM `site`";
	$resp=mysqli_query($link,$query); 	
	while($data0 = mysqli_fetch_array($resp))
	{
		echo '<div class="item"><p>'.$data0[0].'</p></div><div class="stripe"></div>';
	}	
?>
<script type="text/javascript" src="js/site_adm.js"></script>