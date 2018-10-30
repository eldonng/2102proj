<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CrowdFund - Add Project</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="stylesheet" <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
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
    <body>
      <form method = "POST" action = "addproject.php">
      <div class='rg-container'>
        <table class='rg-table' summary='CrowdFund'>
          <caption class='rg-header'>
            <span class='rg-hed'>
              <a class='title' href="home.php">CrowdFund</a>
              <?php
                echo ("<div class='userProfile'>Logged in as: ".$user."</div>")
              ?>
            </span>
            <span class='rg-dek'>
            <div class='user-bar'>
              <a href="profile.php">Profile</a> |
              <a href="logout.php">Logout</a>
            </div>
            </span>
          </caption>
          <thead>
            <tr>
              <th id = "addProject"> Add a project! <i class="fas fa-plus-circle"></i></th>
            </tr>
          </thead>
            <tbody>
              <tr id = "projectForm">
                <td> Title: </td>
                <td><input class = "form-field" type = "text" name = "title" </td>
              </tr>
              <tr id = "projectForm">
                <td> Start Date: </td>
                <td><input class = "form-field" type = "date" name = "startdate" </td>
              </tr>
              <tr id = "projectForm">
                <td> End Date: </td>
                <td><input class = "form-field" type = "date" name = "enddate" </td>
              </tr>
              <tr id = "projectForm">
                <td> Category: </td>
                <td><input class = "form-field" type = "text" name = "category" </td>
              </tr>
              <tr id = "projectForm">
                <td> Target Amount: </td>
                <td><input class = "form-field" type = "text" name = "targetamount" </td>
              </tr>
              <tr id = "projectForm">
                <td> Description: </td>
                <td><textarea class="form-fieldLong" type="varchar(256)" name="description"/></textarea></td>
              </tr>
              <tr id = "projectForm">
                <td></td>
              <td><input class = "submit-button" type = "submit" name = "submit"></td>
          </tr>
              </tbody>
        </table>
      </div>
    </form>
    </body>
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=password");
      if (!$db) {
        echo "An error occured when connecting to DB.\n";
        exit;
    }
    $uniqueId = uniqid();
    $uniqueId8 = substr($uniqueId, 0, 8);
    if (isset($_POST['submit'])) {
        $query = "INSERT INTO project_advertised(uemail, projectid, title, startdate, enddate, category, targetamount, description) VALUES('$user', '$uniqueId8' , '$_POST[title]', '$_POST[startdate]', '$_POST[enddate]',
          '$_POST[category]', '$_POST[targetamount]', '$_POST[description]')";
        $result = pg_query($db, $query);
        if (!$result) {
          echo '<script language="javascript">';
          echo 'alert("Failed to add project")';
          echo '</script>';
        } else {
          echo '<script language="javascript">';
          echo 'alert("Succesfully added project!")';
          echo '</script>';
        }
    }
    ?>
</body>
</html>
