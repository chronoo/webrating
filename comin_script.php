<?
    session_start();    
    $username = $_POST[username];
    $password = md5($_POST[password]);
    $host="localhost";
    $log="root";
    $pass="";
    $db_name="metric";
    $link = mysql_connect($host,$log,$pass,$db_name); 
    mysql_select_db($db_name,$link);
    $sql =sprintf("SELECT pass,status,active,login FROM user where login='%s'",mysql_real_escape_string($username));           
    $result = mysql_fetch_row(mysql_query($sql));
    if($result[0]==$password && $username==$result[3])
    {
        if($result[2]==="1"){
            $_SESSION['status']=$result[1];
            $_SESSION['authorized']=1; 
            $_SESSION['login']=$username; 
            if($result[1]=='1')                
                header("Location: index.php?page=user");
            elseif ($result[1]=='2') {
                header("Location: index.php?page=admin");
            }
        }else{
            header("Location: index.php?page=ban");
            exit();
        }
    }else{
        $_SESSION['authorized']=0;
        header('Location: index.php?page=log_error'); 
    }    
?>