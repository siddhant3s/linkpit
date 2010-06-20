<?php
require_once 'config.php';
require_once 'mnemonic.php';

$url_pattern = '(([\w]+:)?\/\/)(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&amp;?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?';

$tag_pattern='[a-zA-Z0-9_.-]+';
$tag_url_preg="/^$tag_pattern\|$url_pattern/"; //preg compatible

function get_tag_url($uri)
{
global $tag_url_preg;
        if(!preg_match($tag_url_preg,$uri))
            return false;
        else
           return explode('|',$uri,2);
}
function valid_tag($uri)
{
global $tag_pattern;
        $tag_preg="/^$tag_pattern$/";
        if(preg_match($tag_preg,$uri) && (strlen($uri)<=16))
            return true;
        else
           return false;
}
function valid_url($uri)
{
global $url_pattern;
        $url_preg="/^$url_pattern/";
        if(!preg_match($url_preg,$uri))
            return false;
        else
           return true;
}
              


function get_url_from_tag($tag)
{
        global $MYSQL_TABLE_REDIRECTIONS;
        $table=$MYSQL_TABLE_REDIRECTIONS;
        //echo $table;
        $query="SELECT url FROM ".$table." WHERE tag='".mysql_real_escape_string($tag)."';";
        //print "query=$query";
        $result=mysql_query($query);
        if ($result)
        {
                $url=mysql_fetch_assoc($result);//should return array with only one row
                //print_r($url);
                $no_of_url=count($url);
                if($no_of_url==0)
                        {
                        echo ("This tag $tag doesn't have any URL associated with it");
                        return false;
                        }
                elseif($no_of_url!=1)
                        {
                        die("This tag $tag didn't returned unique query. Please contact the website administrator");
                        return false;
                        }
                else{
                        //increment the value of hits columns
                        $query="UPDATE $table SET hits = hits + 1 WHERE tag='$tag';";
                        mysql_query($query) or die(mysql_error());
                        
                        return $url['url']; //return the URL
                    }
        }
        else
        {
                die("An error occured in retriving the URL for the tag $tag");
                return false;
        }
        
        
}
function register_url($url)
{
        global $tag_length;
        global $MYSQL_TABLE_REDIRECTIONS;
        global $logged_in;
        
        $newtag=mnemonic($tag_length,0);
        //echo $newtag;
        $query="SELECT url FROM ".$MYSQL_TABLE_REDIRECTIONS." WHERE tag='".mysql_real_escape_string($newtag)."';";
        //echo $query;
        //exit();
        while( ! mysql_query($query))//keep trying till a random tag which is not already in DB is found
        {//TODO: A do-while loop would have been nicer
                $newtag=mnemonic($tag_length,0);
                $query="SELECT url FROM ".$MYSQL_TABLE_REDIRECTIONS." WHERE tag='".mysql_real_escape_string($newtag)."';";
        }
        
        //now we have our tag, we have our URL, we have to get other information
        $tagger="";
        if($logged_in)
                $tagger=$_SESSION['OPENID_IDENTITY'];
        else
                $tagger='guest';
        
        $ipaddress=$_SERVER['REMOTE_ADDR'];
        $date_now=$mysqldate = date( 'Y-m-d H:i:s');
        $query="INSERT INTO ".$MYSQL_TABLE_REDIRECTIONS." value('$newtag','$url','$tagger','$ipaddress','$date_now',0);";
        if(mysql_query($query))
               return $newtag;
        else
                {
                die("Cannot insert into Database for URL: $url and tag:$newtag");
                return false;
                }

        
}

function register_url_tag($url,$tag)
{
        
        global $MYSQL_TABLE_REDIRECTIONS;
        //echo $newtag;
        $query="SELECT url FROM ".$MYSQL_TABLE_REDIRECTIONS." WHERE tag='".mysql_real_escape_string($tag)."';";
        if(mysql_num_rows(mysql_query($query)))
        {
                //echo "tag existed";
                return register_url($url);
        }
        else
        {
                global $MYSQL_TABLE_REDIRECTIONS;
                global $logged_in;
                $tagger="";
                if($logged_in)
                        $tagger=$_SESSION['OPENID_IDENTITY'];
                else
                        $tagger='guest';
        
                $ipaddress=$_SERVER['REMOTE_ADDR'];
                $date_now=$mysqldate = date( 'Y-m-d H:i:s');
                $query="INSERT INTO ".$MYSQL_TABLE_REDIRECTIONS." value('$tag','$url','$tagger','$ipaddress','$date_now',0);";
                if(mysql_query($query))
                        return $tag;
                else
                {
                        die("Cannot insert into Database for URL: $url and tag:$tag");
                        return false;
                }
        }
}               
        
                               
?>
