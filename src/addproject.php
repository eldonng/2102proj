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
                <td> Category: </td>
                <td>
                  <div class="dropdown" id = "category">
                    <div class="dropdown-trigger">
                      <button type="button" class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                        <span id="dropdown-value">Select one</span>
                        <span class="icon is-small">
                          <i class="fas fa-angle-down" aria-hidden="true"></i>
                        </span>
                      </button>
                    </div>
                    <div class="dropdown-menu" id="dropdown-menu" role="menu">
                      <div class="dropdown-content">
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
              </td>
              </tr>
              <tr style="display: none;" id = "projectForm">
                <td><input value = "test" id = "category-value" class = "form-field" type = "text" name = "category" </td>
              </tr>
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
        document.getElementById("category-value").value = newCategory;
      }
    </script>
    </body>
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect($_SESSION['dblogin']);
      if (!$db) {
        echo "An error occured when connecting to DB.\n";
        exit;
    }
    $uniqueId = uniqid();
    $uniqueId8 = substr($uniqueId, 0, 8);
    $sameNameError = 'Project with same title has already been created!';

    if (isset($_POST['submit'])) {
        if ($_POST[category] == "test") {
          echo '<script language="javascript">';
          echo 'alert("Select a category!")';
          echo '</script>';
        } else {
            $query = "SELECT add_project ('$user', '$uniqueId8','$_POST[title]', '$_POST[startdate]', '$_POST[enddate]',
            '$_POST[category]', '$_POST[targetamount]', '$_POST[description]')";
            $result = pg_query($db, $query);
            $row = pg_fetch_array($result);
            if ($row[0] == $sameNameError) {
              echo '<script language="javascript">';
              echo 'alert("Failed to add project")';
              echo '</script>';
            } else {
              echo '<script language="javascript">';
              echo 'alert("Succesfully added project!")';
              echo '</script>';
            }
          }
    }
    ?>
</body>
</html>
