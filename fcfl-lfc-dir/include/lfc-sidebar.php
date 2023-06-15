<?php 
    $url = $_SERVER['SCRIPT_NAME'];
    //echo $url;
    $dashboard = "";
    $icons= "";
    $myclients = "";
    $notifications = "";
    $user = "";
    $clients = "";
    $typography = "";
    $rtl = "";

    if ($url == "/fcffl-web/fcfl-lfc-dir/dashboard.php") {
        $dashboard = "active";
    } 
    elseif ($url == "/fcffl-web/fcfl-lfc-dir/icons.php") {
        $icons = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-lfc-dir/myclients.php") {
        $myclients = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-lfc-dir/notifications.php") {
      $notifications = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-lfc-dir/user.php") {
      $user = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-lfc-dir/clients.php") {
      $clients = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-lfc-dir/typography.php") {
      $typography = "active";
    }
    elseif ($url == "/fcffl-web/fcfl-lfc-dir/rtl.php") {
      $rtl = "active";
    }
    ?>
<div class="sidebar" data="blue">
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
          <li class="<?php echo "$myclients";  ?>">
            <a href="./myclients.php">
              <i class="tim-icons icon-planet"></i>
              <p>My Clients</p>
            </a>
          </li>
          <li class="<?php echo "$notifications";  ?>">
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
          <li class="<?php echo "$rtl";  ?>">
            <a href="./rtl.php">
              <i class="tim-icons icon-world"></i>
              <p>RTL Support</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    