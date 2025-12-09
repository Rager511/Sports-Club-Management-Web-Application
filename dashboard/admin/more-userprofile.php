<?php
require '../../include/db_conn.php';
page_protect();

if(isset($_POST['submit'])){
  $usrname = $_POST['login_id'];
  $fulname = $_POST['full_name'];

  $query = "UPDATE admin SET username='".$usrname."', Full_name='".$fulname."' WHERE username='".$_SESSION['full_name']."'";

  if(mysqli_query($con,$query)){
    echo "<head><script>alert('Profile Changed');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=logout.php'>";
  } else {
    echo "<head><script>alert('NOT SUCCESSFUL, Check Again');</script></head></html>";
    echo "error".mysqli_error($con);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SPORTS CLUB | Admin</title>
    <link rel="stylesheet" href="../../css/style.css" id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" rel="stylesheet" type="text/css">

    <style>
        /* ---------- Layout (fixed) ---------- */
        html, body { height: 100%; margin: 0; }

        .page-container .sidebar-menu {
            background-color: #6c8397;
            width: 220px;
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
        }

        .page-container { display: flex; min-height: 100vh; align-items: stretch; }

        .sidebar-menu { width: 220px; flex: 0 0 220px; background-color: #6c8397; min-height: 100vh; font-family: 'Roboto', sans-serif; display: flex; flex-direction: column; }

        .logo-env { display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; background-color: #6c8397; flex-shrink: 0; }

        .logo img { max-height: 50px; max-width: 140px; display: block; object-fit: contain; }

        .sidebar-collapse a { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; font-size: 20px; color: #ffffff; background-color: #5a7182; border-radius: 4px; transition: background 0.3s; }

        .sidebar-collapse a:hover { background-color: #455a66; }

        #main-menu li a { color: #ffffff !important; }
        #main-menu li a i { margin-right: 10px; font-size: 18px; }
        #main-menu li a:hover { background-color: #5a7182; color: #fff; }
        #main-menu li.active > a, #main-menu li ul li.active > a { background-color: #455a66; color: #fff; }

        .main-content { flex: 1; display: flex; flex-direction: column; min-height: 100vh; background: #f8f9fa; }
        .content-area { flex: 1; padding: 20px; box-sizing: border-box; overflow: auto; }
        footer.main { margin-top: auto; background: #6c8397; color: #fff; text-align: center; padding: 15px 0; width: 100%; box-sizing: border-box; z-index: 10; }

        /* ---------- Form Card Styles ---------- */
		.form-card {
			width: 600px;       /* exact width like your previous tables */
			margin: 20px auto;  /* centers it */
			background: #ffffff;
			border-radius: 12px;
			padding: 30px;
			box-shadow: 0 4px 12px rgba(0,0,0,0.08);
			font-family: 'Roboto', sans-serif;
		}

        .form-card h6 {
            background: #6c8397;
            color: #fff;
            padding: 12px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            margin: -30px -30px 25px -30px;
            font-size: 16px;
            letter-spacing: 1px;
        }

        .form-card label { font-weight: 600; margin-bottom: 5px; display: block; color: #333; }
        .form-card input { width: 100%; padding: 10px 12px; margin-bottom: 18px; border: 1px solid #ccc; border-radius: 6px; transition: all 0.15s; background: #fff; }
        .form-card input:focus { outline: none; border-color: #6c8397; box-shadow: 0 0 6px rgba(108,131,151,0.25); }

        .form-card .btn { padding: 10px 20px; border-radius: 6px; border: none; font-weight: 600; cursor: pointer; transition: all 0.15s; margin-right: 10px; }
        .form-card .btn-submit { background-color: #6c8397; color: #fff; }
        .form-card .btn-reset { background-color: #ccc; }

        .btn-container { text-align: center; margin-top: 15px; }
    </style>
</head>

<body class="page-body page-fade" onload="collapseSidebar()">

<div class="page-container sidebar-collapsed" id="navbarcollapse">
    <div class="sidebar-menu">
        <header class="logo-env">
            <div class="logo"><a href="#"><img src="msc_logo_Blanc-1.png" alt="" width="192" height="80" /></a></div>
            <div class="sidebar-collapse" onclick="collapseSidebar()">
                <a href="#" class="sidebar-collapse-icon with-animation"><i class="entypo-menu"></i></a>
            </div>
        </header>
        <?php include('nav.php'); ?>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-md-6 col-sm-8 clearfix"></div>
            <div class="col-md-6 col-sm-4 clearfix hidden-xs">
                <ul class="list-inline links-list pull-right">
                    <li style="font-size:16px; font-weight:bold;">Welcome <?php echo $_SESSION['full_name']; ?></li>
                    <li><a href="logout.php" style="font-size:16px; font-weight:bold;color:red">Log Out <i class="entypo-logout right"></i></a></li>
                </ul>
            </div>
        </div>

        <h3>Edit User Profile</h3>
        <p>(You will be required to login again after profile update)</p>
        <hr />

        <div class="form-card">
            <h6>CHANGE PROFILE</h6>
            <form id="form1" name="form1" method="post" action="">
                <label for="login_id">ID:</label>
                <input type="text" name="login_id" id="login_id" value="<?php echo $_SESSION['user_data']; ?>" required>

                <label for="full_name">FULL NAME:</label>
                <input type="text" name="full_name" id="full_name" value="<?php echo $_SESSION['username']; ?>" maxlength="25" required>

                <label>PASSWORD</label>
                <span class="form-control" style="margin-bottom:10px;">*********</span>
                <div class="btn-container" style="margin-bottom:10px;">
                    <a href="change_pwd.php" class="a1-btn a1-orange">Change Password</a>
                </div>
                <div class="btn-container">
                    <input type="submit" class="btn btn-submit" name="submit" value="SUBMIT">
                    <input type="reset" class="btn btn-reset" name="reset" value="Reset">
                </div>
            </form>
        </div>

        <?php include('footer.php'); ?>
    </div>
</div>

</body>
</html>
