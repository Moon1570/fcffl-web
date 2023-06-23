<?php 
    $url = $_SERVER['SCRIPT_NAME'];
    //echo $url;
    $dashboard = "";
    $icons= "";
    $map = "";
    $notifications = "";
    $user = "";
    $clients = "";
    $typography = "";
    $lfc = "";
    session_start();
    if ($url == "/fcffl-web/fcfl-admin-dir/dashboard.php") {
        $dashboard = "active";
    } 
    elseif ($url == "/fcffl-web/fcfl-admin-dir/icons.php") {
        $icons = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-admin-dir/map.php") {
        $map = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-admin-dir/notifications.php") {
      $notifications = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-admin-dir/user.php") {
      $user = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-admin-dir/clients.php") {
      $clients = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-admin-dir/typography.php") {
      $typography = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-admin-dir/lfc.php") {
      $lfc = "active";
    }
    ?>
<div class="sidebar" data="<?php echo $_SESSION['sidebar-color']?>">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            CT
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            FCFL
          </a>
        </div>
        <ul class="nav">
          <li class="<?php echo "$dashboard";  ?>">
            <a href="./dashboard.php">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="<?php echo "$icons";  ?>">
            <a href="./icons.php">
              <i class="tim-icons icon-atom"></i>
              <p>Icons</p>
            </a>
          </li>
          <li class="<?php echo "$map";  ?>">
            <a href="./map.php">
              <i class="tim-icons icon-pin"></i>
              <p>Map</p>
            </a>
          </li>
          <li class="<?php echo "$lfc";  ?>">
            <a href="./lfc.php">

              <i class="tim-icons icon-badge"></i>
              <p>LFC</p>
            </a>
          </li>
          <li class="<?php echo "$user";  ?>">
            <a href="./user.php">
              <i class="tim-icons icon-user-run"></i>
              <p>User Profile</p>
            </a>
          </li>
          <li class="<?php echo "$clients";  ?>">
            <a href="./clients.php">
              <i class="tim-icons icon-single-02"></i>
              <p>Clients</p>
            </a>
          </li>
          <li class="<?php echo "$typography";  ?>">
            <a href="./typography.php">
              <i class="tim-icons icon-align-center"></i>
              <p>Typography</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    