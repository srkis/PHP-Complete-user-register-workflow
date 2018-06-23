<?php
/**
 * Created by PhpStorm.
 * User: srki
 * Date: 19.6.2018
 * Time: 21:52
 */


require_once ($_SERVER['DOCUMENT_ROOT'] . "/tuts/register_workflow/config.php");
$user = new User();

if(isset($_GET['email'])){
    $email  = $_GET['email'];

    if($user->activateAccount($email)){
        header("Location:http://localhost/tuts/register_workflow/");
    }




}