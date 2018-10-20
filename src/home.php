<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CrowdFund | Home</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

</head>

<?php
session_start();
if($_SESSION['email'] != null) {
  $user = $_SESSION['email'];
}  else {
  header("Location: index.php"); /* Redirect browser */
}
$db = pg_connect("host=localhost port=5432 dbname=projectdemo user=postgres password=eldon");
  if (!$db) {
    echo "An error occured when connecting to DB.\n";
    exit;
  }
  $user = $_SESSION['email'];
  if (isset($_POST['submit'])) {
      $query = pg_query($db, "SELECT title, (amountfund*100/targetamount) as pctamount, targetamount, projectid, enddate FROM project_advertised where upper(title) like upper('%$_POST[project_title]%') ORDER BY title");
  } else if (isset($_POST['showfunded'])) {
    $query = pg_query($db, "SELECT title, (amountfund*100/targetamount) as pctamount, targetamount, projectid, enddate FROM project_advertised where (amountfund*100/targetamount) >= 100 ORDER BY title");
  } else {
      $query = pg_query($db, "SELECT title, (amountfund*100/targetamount) as pctamount, targetamount, projectid, enddate FROM project_advertised ORDER BY title");
  }
  if (!$query) {
  echo "An error occured while querying DB.\n";
  exit;
}
?>

<body>
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
          <a href="changepw.php">Change Password</a> |
          <a href="logout.php">Logout</a>
        </div>
        <div class='action-bar'>
          <form action="addproject.php">
            <button type="submit" id="createproject" />Add Project
            <i class="fa fa-plus"></i>
            </button>
          </form>
          <form action="home.php" method="POST">
            <button type="submit" name="showfunded" id="createproject" />Show Funded
            <i class="fa fa-check"></i>
            </button>
          </form>
          <form action="myprojects.php" method="POST">
            <button type="submit" name="myprojects" id="createproject" />My Projects
            <i class="fas fa-book"></i>
            </button>
          </form>
        </div>

        </span>
      </caption>
      <form action="home.php" method="POST">
        <div class="wrap">
          <div class="search">
            <input type="text" name="project_title" class="searchTerm" placeholder="Search a project">
            <button type="submit" name="submit" class="searchButton">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <thead>
        <tr>
          <th class='text '>Project Title</th>
          <th class=' '>% Funded</th>
          <th class=' '>Target</th>
          <th class=' '>End Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while ($row = pg_fetch_array($query)) {
              echo "<tr>";
              echo "<td class='text ' data-title='Project Title'><a href=\"viewproject.php?projectid=".$row['projectid']."\">".$row['title']."</a></td>";
              if ($row['pctamount'] >= 100){
                echo "<td class='text' data-title='% Funded'><progress class=\"progress is-funded show-value\" value=\"".$row['pctamount']."\" max=\"100\"></progress>
                </td>";
              } else if ($row['pctamount'] >= 65){
                echo "<td class='text' data-title='% Funded'><progress class=\"progress is-approaching show-value\" value=\"".$row['pctamount']."\" max=\"100\"></progress>
                </td>";
              } else {
                echo "<td class='text' data-title='% Funded'><progress class=\"progress is-starting show-value\" value=\"".$row['pctamount']."\" max=\"100\">90%</progress>
                </td>";
              }
              echo "<td class='text' data-title='Target'>$".$row['targetamount']."</td>";
              echo "<td class='text' data-title='End Date'>".$row['enddate']."</td>";
              echo "</tr>";
          }
          ?>
      </tbody>
    </table>
  </div>
</body>

</html>
