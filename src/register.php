<!DOCTYPE html>
<head>
  <title>CrowdFund | Create New Account</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
<h2>Create New Account</h2>
  <ul>
	<form name="display" action="register.php" method="POST">
      <li>First Name:
      <input type="text" name="firstname" /></li>
      <li>Last Name:
      <input type="text" name="lastname" /></li>
	  <li>Email:
      <input type="text" name="email"/></li>
	  <li>Password:
      <input type="password" name="password"/></li>
	  <input type="submit" name="create" value="Create Account" /></li>
    </form>
  </ul>
  
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db     = pg_connect("host=localhost port=5432 dbname=projectdemo user=postgres password=cowcowmilk");
    if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;	
    }	
    if (isset($_POST['create'])) {
		$query = "INSERT INTO users VALUES('$_POST[email]', '$_POST[password]', '$_POST[firstname]', '$_POST[lastname]')";
		$result    = pg_query($db, $query);		// To store the result row
		if($result) {
			echo "<ul>Account Created Successfully</ul>
			<li><a href=\"index.php\">Return to Login Page</a></li>";
		} else {
			echo "<ul>Unable to add user into database, or user already exists </ul>";
		}
    }
	?>  
</body>
</html>