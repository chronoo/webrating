<!DOCTYPE html>
<html>
	<head>
		<title>Сайт</title>
		<meta charset="utf-8"/>
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	</head>
	<body>
		<div id="parent">
			<?include_once('header.php');?>
			<div id="content">
				<?switch ($_GET["page"])
					{
						case 'about':
							include_once('about.php');
							break;
						case 'reg':
							include_once('reg.php');
							break;
						case 'comin':
							include_once('comin.php');
							break;
						case 'outcome':
							include_once('outcome_script.php');
							break;
						case 'ban':
							include_once('ban.php');
							break;
						case 'log_error':
							include_once('log_error.php');
							break;
						case 'user':
							if(!isset($_GET["url"]))
								include_once('user.php');
							else
								include('report.php');
							break;
						case 'admin':
							include_once('admin.php');
							break;
						default: include_once('main.php');
					}?>
			</div>
		</div>
</body>
</html>