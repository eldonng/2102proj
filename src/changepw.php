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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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

<form method = "POST" action = "changepw.php">
      <div class='rg-container'>
        <table class='rg-table' summary='CrowdFund'>
          <caption class='rg-header'>
            <span class='rg-hed'>
              <a class='title' href="home.php">CrowdFund</a>
          </caption>
          </span>
          <span class='rg-dek'>
            <div class='user-bar'>
              <a href="profile.php">Profile |</a>
              <a href="logout.php">Logout</a>
            </div>
          </span>
          <thead>
            <tr>
              <th id = "login"> Change Password </th>
            </tr>
          </thead>
            <tbody>
              <tr id = "projectForm">
                <td> Enter Current Password: </td>
                <td><input class = "form-field" type = "password" name = "psw"> </td>
              </tr>
              <tr id = "projectForm">
                <td> Enter New Password: </td>
                <td><input class = "form-field" type = "password" name = "newPsw"> </td>
              </tr>
              <tr id = "projectForm">
                <td> Re-Enter New Password: </td>
                <td><input class = "form-field" type = "password" name = "reEnterPsw"> </td>
              </tr>
              <tr id = "projectForm">
                <td></td>
              <td><input class = "submit-button" type = "submit" name = "changepsw" value="Change Password"></td>
              <tr id = "projectForm">
                <td></td>
          </tr>
              </tbody>
        </table>
      </div>
    </form>
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect($_SESSION['dblogin']);
    if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;
    }

    if (isset($_POST['changepsw'])) {
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
