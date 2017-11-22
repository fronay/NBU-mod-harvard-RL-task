<?php

//changed mysql version:
$dbc = mysql_connect("us-cdbr-iron-east-05.cleardb.net", "be5bf6ff9d1667","1c70fb5d");
mysql_select_db($dbc, "heroku_62647533dcc7434");

//mysqli data from heroku:
//mysql://be5bf6ff9d1667:1c70fb5d@us-cdbr-iron-east-05.cleardb.net/heroku_62647533dcc7434?reconnect=true

//sql version:
/*
$dbc = mysql_connect('localhost', 'username', 'password');
mysql_select_db('db_name', $dbc);
*/

?>