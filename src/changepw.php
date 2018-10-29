<!DOCTYPE html>
<head>
  <title>CrowdFund | Forgot Password</title>
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
<?php
session_start();
if($_SESSION['email'] != null) {
  $user = $_SESSION['email'];
}  else {
  header("Location: index.php"); /* Redirect browser */
}
?>

<header>
    <nav>
    <ul>
    <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </nav>
  </header>
  <form class = "form-container" name="reset" action="changepw.php" method="POST" >
      <div class ="form-title"><h2> Change Password</h2></div>
      <div class="form-title">Enter Current Password: </div>
      <input class="form-field" type="password") name="psw" />
      <div class="form-title">Enter New Password: </div>
      <input class="form-field" type="password") name="newPsw" />
      <div class="form-title">Re-enter New Password: </div>
      <input class="form-field" type="password") name="reEnterPsw" />
      <div class="submit-container">
      <input class ="submit-button" type="submit" name="changepw" value="Change Password" />
      </div>
    </form>

  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=projectdemo user=postgres password=eldon");
    if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;
    }

    if (isset($_POST['changepw'])) {
      if($_POST[psw] == null || $_POST[newPsw] == null || $_POST[reEnterPsw] == null) {
        echo '<script language="javascript">';
        echo 'alert("Please do not leave any fields empty")';
        echo '</script>';
      } elseif($_POST[newPsw] != $_POST[reEnterPsw]) {
        echo '<script language="javascript">';
        echo 'alert("New passwords do not match!")';
        echo '</script>';
      } else {
        $hashpw = hash('sha256', hash('sha256', $user).$_POST[psw]);
        $result = pg_query($db, "SELECT * FROM users WHERE email = '$user' AND password = '$hashpw'");		// Query template
        $row    = pg_fetch_assoc($result);		// To store the result row
		    if(!$row) {
          echo '<script language="javascript">';
          echo 'alert("You have entered an incorrect password")';
          echo '</script>';
	    	} else {
          $hashpw = hash('sha256', hash('sha256', $user).$_POST[newPsw]);
          $reset = pg_query($db, "UPDATE users SET password = '$hashpw' WHERE email = '$user'");
          echo '<script language="javascript">';
          echo 'alert("Password Changed Successfully")';
          echo '</script>';
        }
      }
  }
    ?>


</body>
</html>
