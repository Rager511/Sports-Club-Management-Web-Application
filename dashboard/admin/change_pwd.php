<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SPORTS CLUB | Change Password</title>
    <link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
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
        .sidebar-menu { width: 220px; flex: 0 0 220px; background-color: #6c8397; min-height: 100vh; display: flex; flex-direction: column; }
        .logo-env { display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; background-color: #6c8397; flex-shrink: 0; }
        .logo img { max-height: 50px; max-width: 140px; display: block; object-fit: contain; }
        .sidebar-collapse a { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; font-size: 20px; color: #ffffff; background-color: #5a7182; border-radius: 4px; transition: background 0.3s; }
        .sidebar-collapse a:hover { background-color: #455a66; }
        #main-menu li a { color: #ffffff !important; }
        #main-menu li a i { margin-right: 10px; font-size: 18px; }
        #main-menu li a:hover { background-color: #5a7182; color: #fff; }
        #main-menu li.active > a, #main-menu li ul li.active > a { background-color: #455a66; color: #fff; }
        .main-content { flex: 1; display: flex; flex-direction: column; min-height: 100vh; background: #f8f9fa; }
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

        .form-card label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        .form-card input {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: all 0.15s;
            background: #fff;
        }

        .form-card input:focus {
            outline: none;
            border-color: #6c8397;
            box-shadow: 0 0 6px rgba(108,131,151,0.25);
        }

        .btn-container {
            text-align: center;
            margin-top: 15px;
        }

		.btn-submit, .btn-reset {
			display: inline-block;      /* make sure button shows */
			color: #fff;                /* text color */
			background-color: #6c8397;  /* submit background */
			padding: 10px 20px;
			border-radius: 6px;
			border: none;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.15s;
			margin-right: 10px;
		}

		.btn-reset {
			background-color: #ccc;
			color: #000;                /* reset text color */
		}

		.form-card .btn-submit, .form-card .btn-reset {
			display: inline-block !important;  /* force it visible */
			color: #fff !important;           /* text color */
			background-color: #6c8397 !important; /* submit background */
			padding: 10px 20px;
			border-radius: 6px;
			border: none;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.15s;
			margin-right: 10px;
		}

		.form-card .btn-reset {
			background-color: #ccc !important;
			color: #000 !important;
		}
    </style>
</head>

<body class="page-body page-fade" onload="collapseSidebar()">

<div class="page-container sidebar-collapsed" id="navbarcollapse">
    <!-- Sidebar -->
    <div class="sidebar-menu">
        <header class="logo-env">
            <div class="logo"><a href="#"><img src="msc_logo_Blanc-1.png" alt="" width="192" height="80" /></a></div>
            <div class="sidebar-collapse" onclick="collapseSidebar()">
                <a href="#" class="sidebar-collapse-icon with-animation"><i class="entypo-menu"></i></a>
            </div>
        </header>
        <?php include('nav.php'); ?>
    </div>

    <!-- Main Content -->
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

        <h3>Change Password</h3>
        <hr />

        <div class="form-card">
            <h6>CHANGE PASSWORD</h6>
            <form id="form1" name="form1" method="POST" action="change_s_pwd.php">
                <label for="login_id">ID:</label>
                <input type="text" id="login_id" name="login_id" readonly value="<?php echo $_SESSION['user_data']; ?>" required>

                <label for="login_key">LOGIN KEY:</label>
                <input type="text" id="login_key" name="login_key" placeholder="Your secret key" required>

                <label for="pwfield">PASSWORD:</label>
                <input type="password" id="pwfield" name="pwfield" placeholder="Your new password" required minlength="6">

                <label for="confirmfield">CONFIRM PASSWORD:</label>
                <input type="password" id="confirmfield" name="confirmfield" placeholder="Confirm your new password" required minlength="6">

                <div class="btn-container">
                    <input type="submit" class="btn btn-submit" value="SUBMIT">
                    <input type="reset" class="btn btn-reset" value="RESET">
                </div>
            </form>
        </div>

        <?php include('footer.php'); ?>
    </div>
</div>

</body>
</html>
