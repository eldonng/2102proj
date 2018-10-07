<!DOCTYPE html>
<head>
  <title>CrowdFund | Forgot Password</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
<h2>Reset Password</h2>
  <ul>
	<form name="display" action="forgotpass.php" method="POST">
	  <li>Email:</li>
      <li><input type="text" name="email"></li>
      <li>New Password:</li>
	  <li><input type="password" name="psw"></li>
	  <input type="submit" name="resetpw" value="Reset Password" /></li>
    </form>
  </ul>
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db     = pg_connect("host=localhost port=5432 dbname=projectdemo user=postgres password=cowcowmilk");	
    if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;	
    }
    $result = pg_query($db, "SELECT * FROM users WHERE email = '$_POST[email]'");		// Query template
    $row    = pg_fetch_assoc($result);		// To store the result row
    if (isset($_POST['resetpw'])) {
		if(!$row) {
			echo "<ul>The email does not exist in database</ul>
			<li><a href=\"register.php\">Click here to register a new account</a></li>";
		} else {
            $reset = pg_query($db, "UPDATE users SET password = '$_POST[psw]' WHERE email = '$_POST[email]'");	
            echo "<ul>Password Reset Successful!</ul>
            <li><a href=\"index.php\">Return to Login Page</a></li>";
        }
	}
    ?>  
	
	
</body>
</html>