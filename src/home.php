<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CrowdFund | Home</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

</head>

<?php
session_start();
if($_SESSION['email'] != null) {
  $user = $_SESSION['email'];
}  else {
  header("Location: index.php"); /* Redirect browser */
}
$db = pg_connect($_SESSION['dblogin']);
  if (!$db) {
    echo "An error occured when connecting to DB.\n";
    exit;
  }
  $user = $_SESSION['email'];
  $queryAdmin = "SELECT email FROM users where admin = true AND email = '$user';";
  $result = pg_query($db, $queryAdmin);
  $row = pg_fetch_assoc($result);
  if($row['email'] == $user) {
    $style = "";
  } else {
    $style = "style='display:none;'";
  }

  $updateExpire = pg_query($db, "update project_advertised set status = 'expired' where now()::date > enddate;");

  if (isset($_POST['submit'])) {
      $query = pg_query($db, "SELECT title, (amountfund*100/targetamount) as pctamount, targetamount, projectid, enddate FROM project_advertised where upper(title) like upper('%$_POST[project_title]%') and category like '%$_POST[category]%' 
        and status <> 'expired' ORDER BY title");
  } else if (isset($_POST['showfunded'])) {
    $query = pg_query($db, "SELECT title, (amountfund*100/targetamount) as pctamount, targetamount, projectid, enddate FROM project_advertised where (amountfund*100/targetamount) >= 100 and status <> 'expired' ORDER BY title");
  } else {
      $query = pg_query($db, "SELECT title, (amountfund*100/targetamount) as pctamount, targetamount, projectid, enddate FROM project_advertised where status <> 'expired' ORDER BY title");
  }
  if (!$query) {
    echo $_POST[category];
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
            <a <?php echo $style; ?> href = "adminhome.php">Admin | </a>
            <a href="profile.php">Profile</a> |
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
            <input style="display: none;" value="" id="category-value" class="form-field" type="text" name="category">
            <input type="text" name="project_title" class="searchTerm" placeholder="Search a project">
            <button type="submit" name="submit" class="searchButton">
              <i class="fa fa-search"></i>
            </button>
            <div class="dropdown categoryDropdown" id="category">
              <div class="dropdown-trigger">
                <button type="button" class="button categoryButton" aria-haspopup="true" aria-controls="dropdown-menu">
                  <span style="width: 100px;" id="dropdown-value">Select Category</span>
                  <span class="icon is-small">
                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                  </span>
                </button>
              </div>
              <div class="dropdown-menu" id="dropdown-menu" role="menu">
                <div class="dropdown-content">
                  <a onclick="updateCategory('Select Category')" value="select" class="dropdown-item">
                    Select Category
                  </a>
                  <hr class="dropdown-divider">
                  <a onclick="updateCategory('Arts')" value="arts" class="dropdown-item">
                    Arts
                  </a>
                  <a onclick="updateCategory('Technology')" value="technology" class="dropdown-item">
                    Technology
                  </a>
                  <a onclick="updateCategory('Comics')" value="comics" class="dropdown-item">
                    Comics
                  </a>
                  <a onclick="updateCategory('Games')" value="games" class="dropdown-item">
                    Games
                  </a>
                </div>
              </div>
            </div>
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {

      // Dropdowns

      var $dropdowns = getAll('.dropdown:not(.is-hoverable)');

      if ($dropdowns.length > 0) {
        $dropdowns.forEach(function ($el) {
          $el.addEventListener('click', function (event) {
            event.stopPropagation();
            $el.classList.toggle('is-active');
          });
        });

        document.addEventListener('click', function (event) {
          closeDropdowns();
        });
      }

      function closeDropdowns() {
        $dropdowns.forEach(function ($el) {
          $el.classList.remove('is-active');
        });
      }

      // Close dropdowns if ESC pressed
      document.addEventListener('keydown', function (event) {
        var e = event || window.event;
        if (e.keyCode === 27) {
          closeDropdowns();
        }
      });

      // Functions

      function getAll(selector) {
        return Array.prototype.slice.call(document.querySelectorAll(selector), 0);
      }
    });

    function updateCategory(newCategory) {
      document.getElementById("dropdown-value").innerHTML = newCategory;
      if (newCategory == "Select Category") {
        document.getElementById("category-value").value = "";
      } else {
        document.getElementById("category-value").value = newCategory;
      }
    }
  </script>
</body>

</html>