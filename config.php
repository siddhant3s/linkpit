<?php
$DOMAIN_NAME=$_SERVER['SERVER_NAME']; //like linkpit.co.cc. leave untouched if not sure.
$SUB_DIR = (dirname($_SERVER['SCRIPT_NAME'])=='/')?'/':dirname($_SERVER['SCRIPT_NAME']).'/'; //could be dir1/dir2/dir3/linkpit. Leave blank if in root. Must end with a slash.


$MYSQL_HOST='localhost'; //Database hostname
$MYSQL_USERNAME='siddhant_wp'; //Username
$MYSQL_PASSWORD='linkpit';//password
$MYSQL_DATABASE='siddhant_wp'; //name of your database

$tag_length=6;// the default tag length
$max_tag_length=16;//maximum tag length that can be specified by user

/*table prefix. Need to change if you have Linkpit table name clashing with some
other table name*/
$MYSQL_TABLE_PREFIX='linkpit_'; 
$MYSQL_TABLE_REDIRECTIONS=$MYSQL_TABLE_PREFIX.'redirections';

$std_services=array(
                'google'        => 'https://www.google.com/accounts/o8/id',
                'yahoo'         => 'http://yahoo.com/',
                'aol'           => 'http://openid.aol.com/{username}/',
                'myopenid'      => 'http://{username}.myopenid.com/',
                'livejournal'   => 'http://{username}.livejournal.com/',
                'flickr'        => 'http://flickr.com/{username}/',
                'technorati'    => 'http://technorati.com/people/technorati/{username}/',
                'wordpress'     => 'http://{username}.wordpress.com/',
                'blogger'       => 'http://{username}.blogspot.com/',
                'verisign'      => 'http://{username}.pip.verisignlabs.com/',
                'vidoop'        => 'http://{username}.myvidoop.com/',
                'claimid'       => 'http://claimid.com/{username}'
                );

?>
