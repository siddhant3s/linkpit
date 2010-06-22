<?php
require_once("config.php");

$q = strtolower($_GET["term"]);

if (!$q) return;

$db = mysql_connect($MYSQL_HOST, $MYSQL_USERNAME, $MYSQL_PASSWORD)  or die("Error. Coudn't Connect to Database".mysql_error());
mysql_select_db($MYSQL_DATABASE, $db) or die("Error. Coudn't Select the Database: ".mysql_error());

$query = "SELECT tag FROM " . $MYSQL_TABLE_REDIRECTIONS . " WHERE tag LIKE " . "'%" . $q . "%' LIMIT 0, 15;";
$result = mysql_query($query, $db);

if($result)
{
  echo "[";
  $num_row = mysql_num_rows($result) ;
  $i = 0;

  while( $row = mysql_fetch_assoc($result) )
  {
    echo '"' . $row['tag'] . '"';

    $i++;
    if( $i < $num_row ) 
      echo ",";
  }
  echo "]";
}

?>

