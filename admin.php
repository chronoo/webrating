<!-- <h1>Админка</h1> -->
<div id="control">
		 <a href="?page=admin&mode=user_control">Пользователи</a>
		 <a href="?page=admin&mode=site_control">Сайты</a>
</div>
<div class="stripe"></div>
<div id="users">
<?
	if($_GET["mode"]=='site_control')
		include_once('site_control.php');
	else
		include_once('user_control.php');
?>
</div>