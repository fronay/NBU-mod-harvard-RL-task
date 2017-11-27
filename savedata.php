<?php

// Submit Data to mySQL database
// original: josh de lieuw; modded sniperdrone

// Edit this line to include your database connection script
//
//  The script you link should contain the following two lines:
//
//  $dbc = mysql_connect('localhost', 'username', 'password');
//  mysql_select_db('databasename', $dbc);

// mac: cd into /usr/local/mysql/bin
// sudo mysql -u USERNAME -p NAME_OF_DB -h NAME_OF_HOST
// type SUDO password, then SQL password
// passsword is 0892cd8c9cf8d55 for heroku version right now

// ********** MYSQLI VERSION **********//

//-----------------------------
// mysqli db connection: 
//-----------------------------

// ---- LOCAL -----:
// $db_conn = mysqli_connect('localhost:3306', 'root', 'REDACTED_PASSWORD', 'rocket_db');
// ---- HEROKU ----: 
// replace temp password with actual db password
$db_conn = mysqli_connect('us-cdbr-iron-east-05.cleardb.net', 'be5bf6ff9d1667', '0892cd8c9cf8d55', 'heroku_62647533dcc7434');

//-----------------------------
//mysqli insert function
//-----------------------------

// escaping string function first
function escape($unsafe_string) {
    return mysqli_real_escape_string($dbc , $unsafe_string);
}

function mysqli_insert($table, $inserts, $dbc) {
    // $values = array_map('mysql_real_escape_string', array_values($inserts));
    // $values = array_walk(array_values($inserts), 'escape');
    // TODO: fix escaping issue
    $values = array_values($inserts);
    $keys = array_keys($inserts);
    $sqlString = 'INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\');';
    error_log(print_r($sqlString, true));
    return mysqli_query($dbc, $sqlString);
}

//-----------------------------
// decode ajax submittal
//-----------------------------
// get the table name
$tab = $_POST['table'];
//error_log(print_r("$tab:::",true));
//error_log(print_r($tab,true));

// decode the data object from json
$trials = json_decode($_POST['json']);

//-- get the optional data (decode as array)
//$opt_data = json_decode($_POST['opt_data'], true);
//$opt_data_names = array_keys($opt_data);

//-----------------------------
// Table creation
//-----------------------------
$createSubID = "CREATE TABLE IF NOT EXISTS space_novel_subid (subid VARCHAR(30));";
mysqli_query($db_conn, $createSubID);
$createSpaceNovelData = "CREATE TABLE IF NOT EXISTS space_novel_data (subid VARCHAR(30),state1 VARCHAR(30),stim_left VARCHAR(30), stim_right VARCHAR(30), rt_1 VARCHAR(30),choice1 VARCHAR(30),rt_2 VARCHAR(30),points VARCHAR(30),state2 VARCHAR(30),score VARCHAR(30),practice VARCHAR(30),rews1 VARCHAR(30),rews2 VARCHAR(30),trial_index VARCHAR(30),time_elapsed VARCHAR(30));";
mysqli_query($db_conn, $createSpaceNovelData);
$createSubInfo = "CREATE TABLE IF NOT EXISTS space_novel_subinfo (subid VARCHAR(30), age VARCHAR(30), sex VARCHAR(30),score VARCHAR(30), time_elapsed VARCHAR(30));";
mysqli_query($db_conn, $createSubInfo);


//----------------------------
// Iterate through data arrays and submit mysql query
//------------------------------

// for each element in the trials array, insert the row into the mysql table
for($i=0;$i<count($trials);$i++)
{
    $to_insert = (array)($trials[$i]);
    # $msg = "iteration over trials number " . $i . "trials self : " . $trials[$i];
    /* add any optional, static parameters that got passed in (like subject id or condition)
    for($j=0;$j<count($opt_data_names);$j++){
        $to_insert[$opt_data_names[$j]] = $opt_data[$opt_data_names[$j]];
    }
    */
    $result = mysqli_insert($tab, $to_insert, $db_conn);
}


//-----------------------------
// confirm the results
//-----------------------------
if (!$result) {
    die('Invalid query: ' . mysql_error());
} else {
    print "successful insert!";
    echo "successful insert!";
}

?>
