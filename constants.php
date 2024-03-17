<?php
//application level constants
define("BASE_URL","http://localhost/bca4thapp");
define("BASE_PATH",dirname(dirname(__DIR__)));
define("ADMIN_BASE_PATH",BASE_PATH.'/admin');
define("ADMIN_BASE_URL",BASE_URL.'/admin');
define("ADMIN_ASSETS_URL",ADMIN_BASE_URL.'/assets');
define("ADMIN_LTE_URL",ADMIN_BASE_URL.'/assets/adminlte');

define("PUBLIC_ASSETS_PATH",BASE_PATH.'/assets');
define("PUBLIC_ASSETS_URL",BASE_URL.'/assets');
define("PUBLIC_UPLOAD_PATH",PUBLIC_ASSETS_PATH.'/uploads');
define("PUBLIC_UPLOAD_URL",PUBLIC_ASSETS_URL.'/uploads');

//database connection settings
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASSWORD","");
define("DB_DATABASE","bca4thapp_db");

//echo BASE_PATH;