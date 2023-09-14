<?php
/**
 * Debug Modus
 */
if ($_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
}

// Set config data
include_once("app/config/app.config.php");
$appConfig = $appConfig ?? [];

// Set index controller
include_once("app/controller/IndexController.class.php");

// Initialize instance from IndexController
$IndexInstance =  new IndexController($appConfig);

// Get view data
$View = $IndexInstance->getView();

// Render view
include_once("app/view/app.tpl.php");

