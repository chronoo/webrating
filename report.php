<!-- <h1>Админка</h1> -->
<!-- <div id="control">
		 <p><a href="?page=user&mode=site_control">Пользователи</a></p>
		 <p><a href="?page=user&mode=site_control">Сайты</a></p>
</div> -->
<h1 id="site_title"><?echo mysql_real_escape_string($_GET["url"])?></h1>
<!-- <div class="button" id="AddProject">
	<p>Добавить</p>
</div> -->
<div class="stripe"></div>
<div id="control">
		 <span id="visit">Посещения</span>
		 <span id="visitor">Посетители</span>
		 <span id="referer">Источники</span>		 
</div>
<div class="stripe"></div>
<div id="date_select">
		 <span id="weak">Неделя</span>
		 <span id="month">Месяц</span>	
		 <span id="year">Год</span> 		 
</div>
<br>
<input class="text_in" type="text" id="us_begin">
<input class="text_in" type="text" id="us_finish">
<span id="go">Перейти</span>
<div class="stripe"></div>
<div id="graf"></div>
<div id="back"><a href="?page=user">К списку сайтов</a></div>
<div class="stripe"></div>
<p>Код счётчика</p>
<p id="counter_cod">&ltscript type="text/javascript"&gtwindow.onload = function()
{	
    var a = document.referrer;
    var url=document.location.href;
    var site=document.location.host;
	var token='
	<?
		session_start(); 
		$url=mysql_real_escape_string($_GET["url"]);
		$login=$_SESSION['login'];

		$host="localhost";
	    $user="root";
	    $pass="";
	    $db_name="metric";
	    $link = mysqli_connect($host,$user,$pass,$db_name);

	    $res = mysqli_fetch_array(mysqli_query($link,"SELECT `key` from site where user_id=(select user_id from user where login='$login') and site='$url'"));
		echo $res[0];
		?>
	';
    var ref;
    if (a != '') {
        ref=new URL(a).hostname;
    }
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.open('POST', 'http://localhost/add_stat.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("url="+url+"&site="+site+"&ref="+ref+"&token="+token);
	}&lt/script&gt
 </p>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" src="js/report.js"></script>