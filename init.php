<?php
//Start The Session 
session_start();

//include database config file
require_once "config/databaseConfig.php";

require_once "autoloader.php";

//Include Helper Functions
require_once 'helpers.php';

//Define Global Constants
define('APP_NAME','IET');
define('PROJECT_DIR','tamkar');
