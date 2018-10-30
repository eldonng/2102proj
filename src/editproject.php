<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CrowdFund - Edit Project</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<?php
	session_start();
	$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=password");
	if (!db) {
		echo "error connecting to DB.\n";
		exit;
	}
	$projectid = $_GET["projectid"];
	$uemail = $_SESSION["email"];
	$query = "SELECT uemail, title, startdate, enddate, category, amountfund, targetamount, description, status FROM project_advertised WHERE projectid = '$projectid'";
	$result = pg_query($db, $query);
	$row = pg_fetch_assoc($result);
	if (!$result) {
		echo "Query failed.";
	}
  // if ($row[uemail] != $uemail) {
  //   // header("Location: home.php"); /* Redirect browser */
    // echo '<script type="text/javascript">
    //       alert("You cannot edit projects that are not yours!");
    //       window.location="home.php";
    //       </script>';
  // }
  if (isset($_POST['submit'])) {
    $query2 = "UPDATE project_advertised SET title = '$_POST[title]', startdate = '$_POST[startdate]', enddate = '$_POST[enddate]',
    category = '$_POST[category]', targetamount= '$_POST[targetamount]', description = '$_POST[description]'
    WHERE projectid = '$projectid'";
    $result2 = pg_query($db, $query2);
    if (!$result2) {
      echo '<script language="javascript">';
      echo 'alert("Failed to update project!")';
      echo '</script>';
    } else {
      echo '<script language="javascript">';
      echo 'alert("Succesfully updated project!")';
      echo '</script>';
    }
    $query3 = "SELECT title, startdate, enddate, category, amountfund, targetamount, description, status FROM project_advertised WHERE projectid = '$projectid'";
    $result3 = pg_query($db, $query3);
    $row = pg_fetch_assoc($result3);
  }
  if (isset($_POST['delete'])) {
    $query4 ="DELETE from fund WHERE pprojectid = '$projectid'";
    $result4 = pg_query($db, $query4);
    $query5 = "DELETE from project_advertised WHERE projectid = '$projectid'";
    $result5 = pg_query($db, $query5);
    if (!$result5) {
      echo '<script language="javascript">';
      echo 'alert("Failed to delete project!")';
      echo '</script>';
    } else {
      echo '<script language="javascript">';
      echo 'alert("Succesfully deleted project!")';
      echo '</script>';
    }
    echo '<script type="text/javascript">
          window.location="myprojects.php";
          </script>';
  }
?>
<body>
  <form action="editproject.php?projectid=<?php echo $projectid;?>" method="POST" >
  <div class='rg-container'>
    <table class='rg-table' summary='CrowdFund'>
      <caption class='rg-header'>
        <span class='rg-hed'>
          <a class='title' href="home.php">CrowdFund</a>
          <?php
            echo ("<div class='userProfile'>Logged in as: ".$uemail."</div>")
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
          <th id = "addProject"> Edit a project! <i class="fas fa-edit"></i></th>
        </tr>
      </thead>
        <tbody>
          <tr id = "projectForm">
            <td> Title: </td>
            <td><input class = "form-field" type = "text" name = "title" value ="<?php echo $row[title];?>"  </td>
          </tr>
          <tr id = "projectForm">
            <td> Start Date: </td>
            <td><input class = "form-field" type = "date" name = "startdate" value ="<?php echo $row[startdate];?>" </td>
          </tr>
          <tr id = "projectForm">
            <td> End Date: </td>
            <td><input class = "form-field" type = "date" name = "enddate" value ="<?php echo $row[enddate];?>" </td>
          </tr>
          <tr id = "projectForm">
            <td> Category: </td>
            <td><input class = "form-field" type = "text" name = "category" value ="<?php echo $row[category];?>" </td>
          </tr>
          <tr id = "projectForm">
            <td> Target Amount: </td>
            <td><input class = "form-field" type = "text" name = "targetamount" value ="<?php echo $row[targetamount];?>"</td>
          </tr>
          <tr id = "projectForm">
            <td> Description: </td>
            <td><textarea class="form-fieldLong" type="varchar(256)" name="description"/><?php echo $row[description];?></textarea></td>
          </tr>
          <tr id = "projectForm">
            <td></td>
            <td><input class = "submit-button" type = "submit" name = "submit"</td>
        </tbody>
  </div>
</form>
</body>


</html>

<script>
function validate_delete() {
  if(confirm("Are you sure you want to delete this project?")) {
    return true;
  } else {
    return false;
  }
}
</script>
