<?
	session_start();
	$begin=DateTime::createFromFormat('Y-m-d\TH:i:s+', $_POST['begin'])->format('Y-m-d H:i:s');
	$end=DateTime::createFromFormat('Y-m-d\TH:i:s+', $_POST['finish'])->format('Y-m-d H:i:s');
	$mode=$_POST['mode'];
	$site=$_POST['site'];
	$period=(int)$_POST['period'];

	$cond="`time`>='$begin' AND `time`<='$end'";
	$host="localhost";
    $user="root";
    $pass="";
    $db_name="metric";
    $link = mysqli_connect($host,$user,$pass,$db_name);

	if($mode==='visit')
    {$query="SELECT
			page.url,						
			COUNT(statistic.page_id) as 'count'
			FROM `statistic`, `page`
			WHERE statistic.page_id=page.page_id AND $cond AND page.site_id=(select site_id from site where site='$site')
			GROUP BY statistic.page_id";}
	else if($mode==='all')		
    {    	
    	if($period<29){ 
    		$mult=1;   	
		}else if($period<90)
		{
			$mult=7;
		}else{
			$mult=30;
		}
		$query="SELECT 
			@a:=FLOOR(TIMESTAMPDIFF(SECOND,time,'$end')/(60*60*24*$mult)) as 'day',
			count(@a) as 'count' 
			from statistic, page 
			where $cond
			AND page.page_id=statistic.page_id AND page.site_id=(select site_id from site where site='$site')
			group by day 
			order by day DESC";
	}
	else if($mode==='part')
    {$query="SELECT 
			a.url,
			count(a.url)
			from (SELECT distinct refer.url,id
			FROM statistic, refer, 
			PAGE, site
			WHERE 
			statistic.page_id = page.page_id
			and refer.refer_id = statistic.refer_id
			and page.url like 'http://$site%'
			AND refer.url NOT LIKE  '$site%') a
			where a.url NOT LIKE  '$site%'
			group by a.url";
	}	
	$resp=mysqli_query($link,$query);
	while($data0 = mysqli_fetch_array($resp))
	{
		$data[] = $data0;
	}
	echo json_encode($data);
?>