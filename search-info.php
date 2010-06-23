<?php
require_once("config.php");


$q = strtolower($_GET["term"]); 
if (!$q) return;

$db = mysql_connect($MYSQL_HOST, $MYSQL_USERNAME, $MYSQL_PASSWORD)  or die("Error. Coudn't Connect to Database".mysql_error());
mysql_select_db($MYSQL_DATABASE, $db) or die("Error. Coudn't Select the Database: ".mysql_error());

$query = "SELECT url, hits FROM " . $MYSQL_TABLE_REDIRECTIONS . " WHERE tag='" . mysql_real_escape_string($q) . "'";

$result = mysql_query($query, $db);

if($result)
{
  $row = mysql_fetch_assoc($result);
  echo '["' . $row['url'] . '","' . $row['hits'] . '"]';
}

?>

