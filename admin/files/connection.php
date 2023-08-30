<?php 
session_start();
$con=null;

if(isset($_SESSION['adminLogin'][0]) AND isset($_SESSION['adminLogin'][1]))
{
    if(!empty($_SESSION['adminLogin'][0]) AND !empty($_SESSION['adminLogin'][1]))
    {
        include '../files/function.php';
        $con=connection();
    }
    else
    {
        header('location:../login.php');
    }
}
else
{
    header('location:../login.php');
}
?>