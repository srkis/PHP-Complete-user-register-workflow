<?php
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","123");
define("DB_NAME","tutorial");

spl_autoload_register(function($className){
   require_once ($_SERVER['DOCUMENT_ROOT'] . "/tuts/register_workflow/classes/{$className}.php");
});