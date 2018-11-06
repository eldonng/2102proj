<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CrowdFund - Profile Page</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
    session_start();
    // Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect($_SESSION['dblogin']);
        if (!$db) {
      echo "An error occured when connecting to DB.\n";
      exit;
    }
    if ($_SESSION['email'] != null) {
      $user = $_SESSION['email'];
    }  else {
      header("Location: index.php"); /* Redirect browser */
    }
    $query = "SELECT u.firstname, u.lastname, u.email FROM users u WHERE u.email = '$user'";
    $result = pg_query($db, $query);
    $row = pg_fetch_assoc($result);
    if (!$result) {
      echo "Query failed";
    }

    $query2 = "SELECT COUNT(DISTINCT projectid) as numproj FROM project_advertised WHERE uemail='$user'";
    $result2 = pg_query($db, $query2);
    $row2 = pg_fetch_assoc($result2);
    if (!$result2) {
      echo "Num Projects Query failed";
    }

    $query3 = "SELECT COUNT(DISTINCT pprojectid) as numfunded FROM fund WHERE uemail='$user'";
    $result3 = pg_query($db, $query3);
    $row3 = pg_fetch_assoc($result3);
    if (!$result3) {
      echo "Num Funded Query failed";
    }
?>
  <div class='rg-container'>
  <caption class='rg-header'>
    <span class='rg-hed'>
      <a class='title' href='home.php'>CrowdFund</a>
      <?php
        echo ("<div class='userProfile'>Logged in as: ".$user."</div>")
      ?>
    </span>
    <span class='rg-dek'>
    <div class='user-bar'>
      <a href="changepw.php">Change Password |</a>
      <a href="logout.php">Logout</a>
    </div>
    </span>
  </caption>

  <table class='rg-table' style='width: 70%;' summary='CrowdFund'>
  <thead>
    <tr>
      <th id = "profileHeader"> Profile </th>
    </tr>
  </thead>
    <tbody>
      <tr id ="projectForm">
        <td> Name: </td>
        <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
      </tr>
      <tr id ="projectForm">
        <td> Email: </td>
        <td><?php echo $row['email']; ?> </td>
      </tr>
      <tr id ="projectForm">
        <td><a id='profileLink' href= myprojects.php> No. of Projects Created: </a></td>
        <td> <?php echo $row2['numproj']; ?> </td>
      </tr>
      <tr id ="projectForm">
        <td><a id='profileLink' href= fundhistory.php> No. of Projects Funded: </a></td>
        <td> <?php echo $row3['numfunded']; ?></td>
      </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
