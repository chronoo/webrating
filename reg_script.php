<?
    $username = mysql_real_escape_string($_POST[username]);
    $password = md5($_POST[password]);
    $email = mysql_real_escape_string($_POST[email]);

    $host="localhost";
    $log="root";
    $pass="";
    $db_name="metric";
    $link = mysql_connect($host,$log,$pass,$db_name); 
    mysql_select_db($db_name,$link);
           
    $result = mysql_query("INSERT INTO user VALUES (
        NULL,       /*id*/
        1,          /*статус*/
        1,          /*активность*/
        '$username',/*логин*/
        '$password',/*пароль*/
        NULL,       /*токен*/
        '$email'    /*почта*/
        )",$link);
    header("Location: /");
?>