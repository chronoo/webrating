<!-- <h1>Админка</h1> -->
<!-- <div id="control">
		 <p><a href="?page=user&mode=site_control">Пользователи</a></p>
		 <p><a href="?page=user&mode=site_control">Сайты</a></p>
</div> -->
<h1>Список сайтов</h1>
<!-- <div class="button" id="AddProject">
	<p>Добавить</p>
</div> -->
<div id="work_field">
<?
	session_start();  
	$host="localhost";
    $user="root";
    $pass="";
    $db_name="metric";
    $link = mysqli_connect($host,$user,$pass,$db_name);
    $username=$_SESSION['login'];
    $query="SELECT 
			site
			FROM site WHERE
			user_id=(select user_id from user where login='$username')";
	$resp=mysqli_query($link,$query); 	
	while($data0 = mysqli_fetch_array($resp))
	{
		echo '<div class="item"><a href="?page=user&url='.$data0[0].'">'.$data0[0].'</a></div>';
	}
?>
<div class="stripe"></div>
<form action="add_site.php" method="POST" ENCTYPE="multipart/form-data">
	Адрес
	<input class="text_in" type="text" name="site_name">
        <input class="butt" id="but_in" name="AddSite" type="submit" value="Добавить">
</form>
</div>