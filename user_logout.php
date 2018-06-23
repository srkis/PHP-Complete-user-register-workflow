<?php
/**
 * Created by PhpStorm.
 * User: srki
 * Date: 22.6.2018
 * Time: 20:17
 */

require_once ($_SERVER['DOCUMENT_ROOT'] . "/tuts/register_workflow/config.php");
$ses = new Session();
$ses->start();
$ses->destroy();
