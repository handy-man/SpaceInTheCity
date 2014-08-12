<?PHP

function Navigation_basic($home)
{
$activePage = basename($_SERVER['PHP_SELF']);

echo "<div class='navbar navbar-default navbar-fixed-top' role='navigation'><div class='container'><div class='navbar-header'>
	<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
    <span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button>
    <a class='navbar-brand' href='" . $home . "/index.php'>SpaceInTheCity</a></div><div class='navbar-collapse collapse'>
    <ul class='nav navbar-nav'>";
	
		
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

function Navigation_home($home)
{
$activePage = basename($_SERVER['PHP_SELF']);

echo "<div class='navbar navbar-default navbar-fixed-top' role='navigation'><div class='container'><div class='navbar-header'>
	<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
    <span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button>
    <a class='navbar-brand' href='./index.php'>SpaceInTheCity</a></div><div class='navbar-collapse collapse'>
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
			
			if ($_SESSION['admin'] == 2){
			
									echo "<li class='dropdown'>
				<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Super tools<b class='caret'></b></a>
				<ul class='dropdown-menu'>";
				
		if ($activePage == "admin-new.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				   
				   echo "<a href='./admin-new.php'>New user</a></li>";
				   
				   		if ($activePage == "admin-edit.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				   
				  echo "<a href='./admin-edit.php'>Admin manager</a></li>";
				  
				   
				   		if ($activePage == "admin-pass.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				   
				   echo "<a href='./admin-pass.php'>Password changer</a></li>
				</ul>
            </li>";
		
		
								echo "<li class='dropdown'>
				<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Property management<b class='caret'></b></a>
				<ul class='dropdown-menu'>";
				
		if ($activePage == "building-manager.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				   
				   echo "<a href='./building-manager.php'>Building management</a></li>";
				   
				   		if ($activePage == "development-manager.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				   
				  echo "<a href='./development-manager.php'>Development manager</a></li>";
				  
				   
				   		if ($activePage == "property-manager.php")
		  {
		  echo "<li class='active'>";
		  }
		  else
		  {
		  echo "<li>";
		  }
				   
				   echo "<a href='./property-manager.php'>Property manager</a></li>
				</ul>
            </li>
		</ul>";
		
			
			}
			
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
?>