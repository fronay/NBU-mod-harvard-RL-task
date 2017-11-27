<?php


// local version: 
$db_conn = mysqli_connect('localhost:3306', 'root', 'MasterPassLab16', 'rocket_db');
//mysqli_select_db(, $dbc);

// TEST
$test = "CREATE TABLE beidlAss (name VARCHAR(20), owner VARCHAR(20), species VARCHAR(20), sex CHAR(1), birth DATE, death DATE);";
mysqli_query($db_conn, $test);

//changed mysql version:

/*
$dbc = mysql_connect("us-cdbr-iron-east-05.cleardb.net", "be5bf6ff9d1667","1c70fb5d");
mysql_select_db("heroku_62647533dcc7434", $dbc);
*/


//mysqli data from heroku:
//mysql://be5bf6ff9d1667:1c70fb5d@us-cdbr-iron-east-05.cleardb.net/heroku_62647533dcc7434?reconnect=true

// 
//  ./mysql -u 'be5bf6ff9d1667' -p 'heroku_62647533dcc7434' -h 'us-cdbr-iron-east-05.cleardb.net' 
//for connection
// passsword is 1c70fb5d
//sql version:
/*
$dbc = mysql_connect('localhost', 'username', 'password');
mysql_select_db('db_name', $dbc);
*/

?>