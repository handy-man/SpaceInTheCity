<?PHP

function Navigation_home($home)
{
$activePage = basename($_SERVER['PHP_SELF']);


echo "<div class='navbar navbar-default navbar-fixed-top' role='navigation'><div class='container'><div class='navbar-header'>
	<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
    <span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button>
    <a class='navbar-brand' href='" . $home . "/index.php'>SpaceInTheCity</a></div><div class='navbar-collapse collapse'>
    <ul class='nav navbar-nav'>";
	
			if ($activePage == "index.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
			
			echo "<a href='" . $home . "/home/index.php'>Home</a></li>";
			
			echo"</ul><ul class='nav navbar-nav navbar-right'>";
			
            if (isset($_SESSION['displayname'])){
			echo "<li><a href='" . $home . "/home/logout.php'>Logout</a></li>";
			}
			echo "
          </ul>
        </div>
      </div>
    </div>";
	}

function Navigation_admin()
{
$activePage = basename($_SERVER['PHP_SELF']);

echo "<div class='navbar navbar-default navbar-fixed-top' role='navigation'><div class='container'><div class='navbar-header'>
	<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
    <span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button>
    <a class='navbar-brand' href='./index.php'>ACOG - Admin backend</a></div><div class='navbar-collapse collapse'>
    <ul class='nav navbar-nav'>";
	
	echo"<li class='dropdown'>
            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Home page edit<b class='caret'></b></a>
            <ul class='dropdown-menu'>
			
            <li><a href='./edit.php?file=p1index'>First paragraph</a></li>
                <li><a href='./edit.php?file=p2index'>Upcoming Events</a></li>
                <li><a href='./news.php?file=p3index'>News</a></li>
              </ul>
            </li>";
			
			echo"<li class='dropdown'>
            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Tech help edit<b class='caret'></b></a>
            <ul class='dropdown-menu'>
			<li><a href='./edit.php?file=p1help-pc'>PC gaming</a></li>
			<li><a href='./edit.php?file=p1help-gen'>General info</a></li>
			<li class='divider'></li>
            <li><a href='./edit.php?file=p1help-one'>xbox one</a></li>
            <li><a href='./edit.php?file=p1help-360'>xbox 360</a></li>
			<li class='divider'></li>
			<li><a href='./edit.php?file=p1help-ps4'>Playstation 4</a></li>
            <li><a href='./edit.php?file=p1help-ps3'>Playstation 3</a></li>
		<li class='divider'></li>
		<li><a href='./edit.php?file=p1help-nintendo'>Nintendo</a></li>
              </ul>
            </li>
			<li class='dropdown'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Misc edit<b class='caret'></b></a>
              <ul class='dropdown-menu'>";
			  
          if ($activePage == "committee-edit.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				
				echo "<a href='./committee-edit.php'>Committee</a></li>
                <li><a href='./edit.php?file=calendar'>Calendar</a></li>
				<li><a href='./edit.php?file=twitch'>Twitch - stream</a></li>
                <li><a href='./edit.php?file=twitch-under'>Twitch - under text</a></li>
              </ul>
            </li>
			<li class='dropdown'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Servers edit<b class='caret'></b></a>
              <ul class='dropdown-menu'>
                <li><a href='./edit.php?file=p1teamspeak'>Teamspeak</a></li>
                <li><a href='./edit.php?file=p1minecraft'>Minecraft</a></li>
              </ul>
            </li>";
			
					if ($activePage == "photo-uploader.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
		  echo "<a href='./photo-uploader.php'>Photo uploader</a></li>";
			
						echo "<li class='dropdown'>
				<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Super tools<b class='caret'></b></a>
				<ul class='dropdown-menu'>";
				
		if ($activePage == "admin-activate.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				   
				   echo "<a href='./admin-activate.php'>Activate user</a></li>";
				   
				   		if ($activePage == "admin-edit.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				   
				  echo "<a href='./admin-edit.php'>Admin manager</a></li>";
				  
		  if ($activePage == "admin-ref.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				   
		  echo "<a href='./admin-ref.php'>Referee manager</a></li>";
				  
				  				   		if ($activePage == "admin-port.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				   
				   echo "<a href='./admin-port.php'>Port Moderators</a></li>";
				   
				   		if ($activePage == "admin-pass.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				   
				   echo "<a href='./admin-pass.php'>Password changer</a></li>";
				   
				   		  		  
				   
		if ($activePage == "admin-email.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
					echo "<a href='./admin-email.php'>Email changer</a></li>";
					
						   
		if ($activePage == "admin-login.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
					echo "<a href='./admin-login.php'>Login as someone else</a></li>";			
				 
		if ($activePage == "admin-settings.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
		  
		  
				   
				   echo "<a href='./admin-settings.php'>Settings</a></li>
				</ul>
            </li>
		</ul>
			<ul class='nav navbar-nav navbar-right'>
			<li> <a href='" . $home . "/user/" . $_SESSION['uid'] . "'>My Profile</a></li>
            <li><a href='./logout.php'>Logout</a></li>
          </ul>
        </div>
      </div>
    </div>";
	}
?>