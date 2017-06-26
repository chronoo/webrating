<?
	$host="localhost";
    $user="root";
    $pass="";
    $db_name="metric";
    $link = mysqli_connect($host,$user,$pass,$db_name);

    $query="SELECT 
			login,
			active
			FROM `user` 
			where status=1";
	$resp=mysqli_query($link,$query); 	
	while($data0 = mysqli_fetch_array($resp))
	{
		if($data0[1]=='1')
			echo '<div class="item"><p>'.$data0[0].'</p></div><div class="stripe"></div>';
		else
			echo '<div class="item"><p>'.$data0[0].'</p><span>(заблокирован)</span></div><div class="stripe"></div>';
	}	
?>
<script type="text/javascript" src="js/user_adm.js"></script>