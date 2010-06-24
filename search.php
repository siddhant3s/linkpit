<?php

require_once("config.php");
require_once("functions.php");

/**
 * Prints INFO related to a particular tag 'q' as
 * an array.
 *
 * Currently in format:
 * [ url, hits ]
 *
 */
function getTagInfo( $q )
{
  global $MYSQL_TABLE_REDIRECTIONS;
  $db = dbConnect();
  $query = "SELECT url, hits FROM " . $MYSQL_TABLE_REDIRECTIONS . " WHERE tag='" . mysql_real_escape_string($q) . "'";

  $result = mysql_query($query, $db);

  if($result)
  {
    $row = mysql_fetch_assoc($result);
    echo '["' . $row['url'] . '","' . $row['hits'] . '"]';
  }
}

/**
 * Prints the TAGS which has 'q' in it. Used by Autocompletion
 * Tag Search.
 */
function getSearchMatches( $q )
{
  global $MYSQL_TABLE_REDIRECTIONS;
  $db = dbConnect();
  $query = "SELECT tag FROM " . $MYSQL_TABLE_REDIRECTIONS . " WHERE tag LIKE " . "'%" . $q . "%' ORDER BY LOCATE('$q',LCASE(tag)) LIMIT 0, 15;";
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
}

/**
  * Request Controller
  */

$request = strtolower($_GET["request"]);
$q = strtolower($_GET["term"]);

if( !$request || !$q)
    getSearchMatches($q);
else
  if( $request == "info" )
    getTagInfo($q);
  else if( $request == "matches" )
    getSearchMatches($q);

?>


