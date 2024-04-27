<?php
  // DB Params
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');

  define('DB_PASS', '12345');
  define('DB_NAME', 'eco_plus');
  date_default_timezone_set('Asia/Colombo'); // Set the time zone to Colombo

  // App Root
  define('APPROOT', dirname(dirname(__FILE__)));
  // URL Root
  define('URLROOT', 'http://localhost/ecoplus');
  define('IMGROOT', 'http://localhost/ecoplus/public/img');
  define('JSROOT', 'http://localhost/ecoplus/public/js');
  define('Google_API', 'AIzaSyCHC8CdWrCw593DZUii78rtRV-whzvwKwE');
  //define('Google_API', '');
  define('PBROOT', dirname (dirname(dirname(__FILE__))).'\public');
  // Site Name
  define('SITENAME', 'Eco Plus');