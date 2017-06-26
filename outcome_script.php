<?
    session_start();    
    unset($_SESSION['authorized']);
    $_SESSION['authorized']=0;
    header("Location: /");    
?>