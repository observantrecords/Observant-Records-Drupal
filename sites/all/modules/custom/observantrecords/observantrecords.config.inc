<?php
$or_db_name = (ENVIRONMENT == 'development') ? 'observantrecords_dev' : 'observantrecords';
define('OR_DB_HOST', 'mysql.eponymous4.com');
define('OR_DB_USER', 'eponymous4');
define('OR_DB_PASSWORD', '3825crux');
define('OR_DB_NAME', $or_db_name);
