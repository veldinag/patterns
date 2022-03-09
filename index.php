<?php
    session_start();
    require_once 'autoload.php';
    require_once "configuration/db_conf.php";
    require_once "configuration/site_conf.php";

    try {
        App::init();
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }