<div id="header">
	<div id="pages">
		<a href="?page=index">Главная</a>
		<a href="?page=about">О сайте</a>
	</div>
	<div id="action">
	<?
		session_start();	
		if(isset($_SESSION['authorized']) && $_SESSION['authorized']==1)
		{
			$nick=$_SESSION['login'];
			$status=$_SESSION['status'];
			if($status=="1")
				$kabinet="user";
			else
				$kabinet="admin";
			echo "<a href='?page=$kabinet'>
							$nick
						</a>
					<a href='?page=outcome'>
							Выйти
						</a>";
		}else{
			echo "<a href='?page=comin'>
							Вход
						</a>
					<a href='?page=reg'>
							Регистрация
						</a>";
		}
		?>	
	</div>
</div>