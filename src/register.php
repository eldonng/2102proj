<!DOCTYPE html>
<head>
  <title>CrowdFund | Create New Account</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!DOCTYPE html>
<head>
  <title>CrowdFund | Login</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <!-- <link rel="stylesheet" href="style.css"> -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="formstyle.css">
    
</head>
<body>
<header>
    <nav>
    <ul>
      <li><a href="index.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
      <li><a href="forgotpass.php"><i class="fas fa-question"></i> Forgot Password</a></li>
    </ul>
  </nav>
  </header>
	<form class = "form-container" name="signup" action="register.php" method="POST" >
      <div class ="form-title"><h2> Create an Account</h2></div>
      <div class="form-title">First Name: </div>
      <input class="form-field" type="text" name="firstname" />
      <div class="form-title">Last Name: </div>
      <input class="form-field" type="text" name="lastname" />
      <div class="form-title">Email Address: </div>
      <input class="form-field" type="text" name="email" />
      <div class="form-title">Password: </div>
      <input class="form-field" type="password") name="password" />
      <div class="submit-container">
      <input class ="submit-button" type="submit" name="create" value="Create Account" />
      </div>
    </form>

  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect($_SESSION['dblogin']);
        if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;
    }
    if (isset($_POST['create'])) {
      if($_POST[email] == null || $_POST[password] == null || $_POST[firstname] == null || $_POST[lastname] == null) {
        echo '<script language="javascript">';
        echo 'alert("Please do not leave any fields empty")';
        echo '</script>';
      } else {
        $hashpw = hash('sha256', hash('sha256', $_POST[email]).$_POST[password]);
		    $query = "INSERT INTO users VALUES('$_POST[email]', '$hashpw', '$_POST[firstname]', '$_POST[lastname]')";
		    $result    = pg_query($db, $query);		// To store the result row
		    if($result) {
          echo '<script language="javascript">';
          echo 'alert("Account Created Successfully")';
          echo '</script>';
		    } else {
          echo '<script language="javascript">';
          echo 'alert("Unable to add user into database, or user already exists")';
          echo '</script>';
        }
      }
    }
	?>
</body>
</html>
