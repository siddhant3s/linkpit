<?php
  require 'config.php';
  require 'functions.php';
  
  $FULLPATH = 'http://' . $DOMAIN_NAME . $SUB_DIR;
  header('X-XRDS-Location:' . $FULLPATH . 'yadis.xrdf');
  session_start();
  
  try {
      function openid_auth($openid_url)
      {
          if (isset($openid_url)) {
              global $FULLPATH;
              $openid = new Dope_OpenID($openid_url);
              $openid->setReturnURL($FULLPATH);
              $openid->SetTrustRoot($FULLPATH);
              $openid->setOptionalInfo(array('nickname', 'fullname', 'email'));
              $endpoint_url = $openid->getOpenIDEndpoint();
              
              if ($endpoint_url) {
                  // If we find the endpoint, you might want to store it for later use.
                  $_SESSION['openid_endpoint_url'] = $endpoint_url;
                  // Redirect the user to their OpenID Provider
                  
                  $openid->redirect();
                  // Call exit so the script stops executing while we wait to redirect.
                  exit;
              } else {
                  //echo 'EPURL'.$endpoint_url;
                  /*
                   * Else we couldn't find an OpenID Provider endpoint for the user.
                   * You can report this error any way you like, but just for demonstration
                   * purposes we'll get the error as reported by Dope OpenID. It will be
                   * displayed farther down in this file with the HTML.
                   */
                  $the_error = $openid->getError();
                  $error = "Error Code: {$the_error['code']}<br />";
                  $error .= "Error Description: {$the_error['description']}<br />";
                  echo $error;
              }
          }
      }
      //OpenID authentication finalising when returning from the Provider's website
      if (isset($_GET['openid_mode'])) {
          //<-----This happens when the provider calls our page
          if ($_GET['openid_mode'] == 'cancel') {
              //<------either telling that user cancell the authentication.....
              /*TODO Have to log this error message instead of displaying it*/
              echo 'User has canceled authentication!';
              exit();
          } else {
              //<--------....or giving us all the required info that user passed authentication
              require_once 'class.dopeopenid.php';
              $openid_url = $_GET['openid_identity'];
              $openid = new Dope_OpenID($openid_url);
              $validate_result = $openid->validateWithServer();
              $_SESSION['OPENID_AUTH'] = ($validate_result ? true : false);
              $_SESSION['OPENID_IDENTITY'] = $_GET['openid_identity'];
              $user_data = $openid->filterUserInfo($_GET);
              /*The following code tries to set the $_SESSION['OPENID_WELCOME_NAME']
               first by the ClaimID itself. If the information like the first name or email
               address is provided, they are used as the $_SESSION['OPENID_WELCOME_NAME']
               for welcoming the user.*/
              $_SESSION['OPENID_WELCOME_NAME'] = $_GET['openid_identity'];
              
              if (isset($user_data['fullname']))
                  $_SESSION['OPENID_WELCOME_NAME'] = $user_data['fullname'];
              elseif (isset($user_data['nickname']))
                  $_SESSION['OPENID_WELCOME_NAME'] = $user_data['nickname'];
              elseif (isset($user_data['email']))
                  $_SESSION['OPENID_WELCOME_NAME'] = $user_data['email'];
              //echo($user_data['namePerson/first']);
              header('Location: ' . $FULLPATH);
          }
      }
  }
  catch (ErrorException $e) {
      echo "Error ";
      echo $e->getMessage();
  }
  
  //Give the $logged_in variable it's value
  $logged_in = false;
  $recent_linkpit = array();
  if (!isset($_SESSION['OPENID_AUTH']) || $_SESSION['OPENID_AUTH'] == false)
      //user not logged in
      $logged_in = false;
  else {
      //turn $logged_in to true and connect to DB to retrieve information on recent linkpits
      global $recent_linkpit;
      $logged_in = true;
      $dbp = dbConnect();
      $query = "SELECT tag FROM linkpit_redirections WHERE tagger='" . $_SESSION['OPENID_IDENTITY'] . "' ORDER BY reg_date DESC LIMIT 5;";
      //echo $query;
      if ($res = mysql_query($query)) {
          while ($row = mysql_fetch_assoc($res))
              array_push($recent_linkpit, $row['tag']);
          //print_r($recent_linkpit);
      } else {
          die("DB Error while fetching recent linkpit");
      }
      mysql_close($dbp);
  }
  ////////////////////////////////////////////////////    
  /**********************************************************************************/
  /* The Following script act as a dispatcher pased on the $request_uri, which is   */
  /* the part of the URL after the website complete name. Eg: If                    */
  /* the requested page is http://linkpit.co.cc/something then `something' is saved */
  /* in the $request_uri. Following script will serve the request based on this     */
  /* string.                                                                        */
  /**********************************************************************************/
  //request URI to be the stuff after the website name
  $request_uri = explode($SUB_DIR, $_SERVER['REQUEST_URI'], 2);
  $request_uri = $request_uri[1];
  if ($request_uri) {
      //work only if $request_uri is present
      //echo "request_uri=$request_uri";
      global $logged_in;
      
      if (stripos($request_uri, 'login/') === 0) {
          //if $request_uri starts with /login/servicename/username
          $split_login = explode('login/', $request_uri, 2);
          //set $_GET['openid_identifier'] to the servicename/username
          $_GET['openid_identifier'] = $split_login[1];
      }
      //This is triggered when user tries to log-in. It sends user to the Provider website.
      if (!isset($_GET['openid_mode']) && isset($_GET['openid_identifier'])) {
          //splits into two service/usernam
          $splited_identity = explode('/', $_GET['openid_identifier'], 2);
          if (array_key_exists($splited_identity[0], $std_services))
              //if service is known
              $openid_url = str_replace('{username}', $splited_identity[1], $std_services[$splited_identity[0]]);
          else
              $openid_url = $_GET['openid_identifier'];
          require 'class.dopeopenid.php';
          openid_auth($openid_url);
      }
      
      if (stripos($request_uri, 'logout') === 0) {
          // logout on linkpit.co.cc/logout
          $_SESSION['OPENID_AUTH'] = false;
          $_SESSION['OPENID_IDENTITY'] = "";
          session_destroy();
          header('Location: ' . $FULLPATH);
      }
      //no Login or log out to be done now. Only tag, URL and tag|url parsing to be done
      $dbp = dbConnect();
      
      //If the request_uri is a valid tag as in linkpit.co.cc/atag 
      if (valid_tag($request_uri)) {
          if ($url = get_url_from_tag($request_uri)) {
              //get the corresponding URL
              //if the tag is registered.
              //echo "SESSION[NEWTAG]=".$_SESSION['newtag'];
              if (isset($_SESSION['newtag']) && ($_SESSION['newtag'] == $request_uri)) {
                  //if this is the first time and this user registered the tag, congratulate him
                  unset($_SESSION['newtag']);
                  $message = <<<MSG
                                Congratulations, your <a href="$url">URL</a> has now been linked to the tag: <a href="$FULLPATH$request_uri"><b><u>$request_uri</u></b></a> <br/>
                                You can now go to this URL by visiting <br/>
                                <b><a href="$FULLPATH$request_uri">$FULLPATH$request_uri</a><br/></b>
                                You can copy-paste the following Linkpit URL and pass it on:<br/>
                                <input type='text' value='$FULLPATH$request_uri' size='30' style="border: 1px #000000 solid;  solid;text-align: center;
                                font-family: Arial, Sans-Serif;font-size: 16px;background-color: #B1B1B1;padding: 5px;" readonly="readonly" /><br/>
                                Opt the new way to pass URLs across chat rooms, Email and SMSs. Pass on <b>[$request_uri]</b> instead of passing http://linkpit.co.cc/$request_uri and tell them about Linkpit, if they ask about this strange syntax!
                                <br/> Refresh this page to go to the URL
                                
MSG;
              }
              else
                  //get him to the the respected link
                  header("Location: " . $url);
          }
          else
              //tag not found
              $message = <<<MSG
                         The tag you specified, <b><u>$request_uri</u></b> is not yet linked to any URL.
                        That also mean that it is available and you can use it to link one of your URL.<br/>
                        Enter a URL you want to link to the tag <b><u>$request_uri</u></b><br/><br/><form name='linkurl' action='#'>
                        <input name='url' type='text'   size='30' style="border: 1px #000000 solid;  solid;text-align: center;font-family: 'Arial, Sans-Serif';font-size:16px;background-color: #B1B1B1;padding: 5px;" onkeydown="if (event.keyCode==13) {document.linkurl.url.click();}" />
                        <input type='button' value='Link it!' onclick="parent.location='$FULLPATH$request_uri|'+document.linkurl.url.value"/>
                        </form>
MSG;
              
          }
          //The next thing decides if the request_uri is a valid URL. If yes, it registers it
          elseif (valid_url($request_uri)) {
              if ($tag = register_url($request_uri)) {
                  //tag registration successful
                  //store this info and take it to the tag page where he will be congratulated
                  $_SESSION['newtag'] = $tag;
                  header("Location: " . $FULLPATH . $tag);
              }
              else
                  //the URL was valid but some error occured. Contact the admin.
                  die('<br/>An error occured, URL not registered');
          }
          //The Next thing decides if the request_URI is a valid tag|URL combination
          elseif ($tag_url = get_tag_url($request_uri)) {
              if ($tag = register_url_tag($tag_url[1], $tag_url[0])) {
                  //15min
                  $_SESSION['newtag'] = $tag;
                  header("Location: " . $FULLPATH . $tag);
              }
              else
                  //the URL and tag was valid but some error occured. Contact the admin.
                  die('<br/>An error occured, URL not registered');
          } else {
              $message = <<<MSG
                <div style="text-align: left;">
                An error occured. You didn't used Linkpit in a syntax that it understand. This may be due to following reasons:
                <ul>
                <li>You didn't specified a valid tag name. A tag name is an 
                alphanumeric string which can also have hyphens(-), underscores(_) and period(.) but no spaces whole length must not exceed $max_tag_length </li>
                <li>The URL you specified might be invalid. Note that URL always start with <b>http://</b>, <b>ftp://</b> or similar protocol name</li>
                <li>You may have not specified the tag, URL order properly. Note that it is tag|URL where the | is the vertical bar which is typed by pressing <Shift> and \ Key</li>
                </ul>
                </div>    
MSG;
          }
      }
      //End of Dispatcher
?>           



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Linkpit</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- Simple OpenID Selector -->
	<link rel="stylesheet" href="css/openid.css" type="text/css"  />
  <link type="text/css" href="css/jquery-ui-1.8.2-custom.css" rel="stylesheet" />
  <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script>
  <script type="text/javascript" src="js/ac_search.js"></script>
	<script type="text/javascript" src="js/openid-jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	    openid.init('openid_identifier');
	});
	</script>
	<!-- /Simple OpenID Selector -->
</head>
<body>
<!-- start header -->
<div id="header">
	<div id="logo">
		<h1>Linkpit</h1>
		<p>
			URL shortner with a difference
		</p>
	</div>
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="<?php echo $FULLPATH; ?>">Homepage</a></li>
			<li><a href="#">Why Linkpit</a></li>
			<li><a href="#">Integration</a></li>
			<li><a href="#">About Us</a></li>
			<li><a href="#">Contact Us</a></li>
		</ul>
	</div>
</div>
<!-- end header -->
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
	<?php if(isset($message)){ ?>
		<div class="post purplebox">
				
			<div class="title">
				<h1>Message</h1>
			</div>
			<div class="entry">
			  <center>
					<?php echo $message;?>
			  </center>	
			</div>
			<div class="btm">
				<div class="l">
					<div class="r">
						<p class="meta">
							</p>
					</div>
				</div>
			</div>
		</div><br/>
	<?php } ?>	
		<div class="post greenbox">
				
			<div class="title">
				<h1>Welcome to LinkPit</h1>
			</div>
			<div class="entry">
					This is <strong>Linkpit</strong>, a free, URL shortner. Linkpit not only make your URLs short, but easy to 
					remember too. Each URL is transformed into a <i>tag</i>. To go to that URL, you just need to know it's 
					corresponding tag. You can thus visit <?php echo($FULLPATH);?><u><i>tag</i></u> to reach to your URL.
					<br/><br/>Linkpit generates a tag which can be pronounced easily and thus commited in memory if required. So all
					you have to remember (or pass-on) is the tag and you will be able to access your long URL.
        	Linkpit also allow you to specify your own tag (if it's not already taken).
      </div>
      <script type="text/javascript">
      function toggle_show(id)
      {
          if(document.getElementById(id).style.display=='block')
              document.getElementById(id).style.display='none';
          else
              document.getElementById(id).style.display='block';
      }
      </script>			

   <div class="entry">
      <h2><a href="#" onclick="toggle_show('howto');" title="Click to Show/Hide">How to Use
      Linkpit</a></h2>

      <div id="howto" style="display: none;">
        <h5>Simplest way to to use Linkpit</h5>To shorten a URL, just type the following on
        your browser address bar (and press Return Key):<br />

        <p align='center' style="border: 1px solid black; padding: 0px;margin: 2px 80px;">
        <b><?php echo $DOMAIN_NAME;?>/<i><u>your-url</u></i></b></p><u>Example</u>:

        <p align='center' style="border: 1px solid black; padding: 0px;margin: 2px 80px;">
        <?php echo $DOMAIN_NAME;?>/http://en.wikipedia.org/wiki/Random_walk</p><br />

        <h5>Shorten a URL to a specific tag of your choice</h5>Type the following on your
        browser address bar:<br />

        <p align='center' style="border: 1px solid black; padding: 0px;margin: 2px 80px;">
        <b><?php echo $DOMAIN_NAME;?>/<i>a-tag|<u>your-url</u></i></b></p><u>Example:</u>

        <p align='center' style="border: 1px solid black; padding: 0px;margin: 2px 80px;">
        <?php echo $DOMAIN_NAME;?>/randwalk|http://en.wikipedia.org/wiki/Random_walk</p>
      </div>
  </div>
				

			<div class="btm">
				<div class="l">
					<div class="r">
						<p class="meta">
							<a href="#" class="more">Read More</a> &nbsp;&nbsp;&nbsp; <a href="#" class="comments">Comments </a>
						</p>
					</div>
				</div>
			</div>
  </div>
  <br/>
		
		<div class="two-columns">
			<div class="columnA" >
				<div class="title red">
					<h2>Tag Search</h2>
				</div>
				<div class="content" >
					Gives detailed statistics on your Tag with an easy to use search Box.<br/><center>Coming Soon.</center>
				</div>
			</div>
			<div class="columnB">
				<div class="title blue">
					<h2>Features</h2>
				</div>
				<div class="content">
					<ul>
						<li><a href="#">Additional</a></li>
						<li><a href="#">Features</a></li>
						<li><a href="#">Coming</a></li>
						<li><a href="#">Soon </a></li>
						<li><a href="#">Do</a></li>
						<li><a href="#">LinkPit</a></li>
					</ul>
				</div>
			</div>
			<div class="btm">
				&nbsp;
			</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
		<li>
			<h2>Search</h2>
			<ul><li>
			  <center>
			    <div class="ui-widgets">
            <input id="search" style="width: 100%; height: 25px; font-size: 16px;" />
          </div>
			  </center>
			</ul></li>
    </li>

			<li>
			<h2><?php echo ($logged_in)?"Welcome":"Login"; ?></h2>
			<ul>
			<?php
			if (!$logged_in) 
			{
         //echo ('You are not permitted to access this page! Please log in again.');
         ?>
<li>
<!-- Simple OpenID Selector -->
<form action="<?php echo $FULLPATH;?>" method="get" id="openid_form">
	<input type="hidden" name="action" value="verify" />

	
    		Sign-in or Create New Account
    		
    		<div id="openid_choice">
	    		<p>Please click your account provider:</p>
	    		<div id="openid_btns"></div>
			</div>
			
			<div id="openid_input_area">
				<input id="openid_url" name="openid_url" type="text" value="http://" />
				<br/>
				<input id="openid_submit" type="submit" value="Sign-In"/>
			</div>
			<noscript>
			<p>OpenID is service that allows you to log-on to many different websites using a single indentity.
			Find out <a href="http://openid.net/what/">more about OpenID</a> and <a href="http://openid.net/get/">how to get an OpenID enabled account</a>.</p>
			</noscript>
	
</form>
<!-- /Simple OpenID Selector -->
</li>
<?php 
			}
			else
			{
			        $login_msg= <<<LOGIN_MSG
                           <li> Welcome $_SESSION[OPENID_WELCOME_NAME] </li>
                           <li> <a href={$FULLPATH}logout     >Logout</a></li>
LOGIN_MSG;
			        echo $login_msg;
			        
			        
			}
?>
			</ul>
			</li>
			<?php if($logged_in){ ?>
			<li>
			<h2>Your Recent Linkpit</h2>
			<center>
			<ul>
				<?php 
				global $recent_linkpit;
				//print_r($recent_linkpit);
				$no_of_recent=count($recent_linkpit);
				if($no_of_recent)
				  for ($i=0; $i<$no_of_recent; $i++)
            echo "<li><a href='$FULLPATH$recent_linkpit[$i]'>$recent_linkpit[$i]</a></li>";
				else
   	        echo "<li> You do not have any Linkpit with this account</li>";
				?>
				<li>More Account related features(like favorite Linkpits) comming soon.</li>
			</ul>
			</center>
			</li>
			<?php } ?>
		</ul>
	</div>
	<!-- end sidebar -->
</div>
<!-- end page -->
<div style="clear: both;">
	&nbsp;
</div>
<div id="footer">
	<p>
		&copy;2010 Siddhant Sanyam       All Rights Reserved. &nbsp;&bull;&nbsp; Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>
	</p>
</div>
    <div id="search-info" title="Search Info">      
      <p>
        <h1 align="center" id="tag-name">TAG NAME</h1>
        <h5 align="center" id="tag-url">URL</h5>
        <h1 align="center" id="tag-hits">HITS</h1>
      </p>
    </div>
</body>
</html>
