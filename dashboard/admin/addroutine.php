
<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>SPORTS CLUB| Routine</title>
    <link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" rel="stylesheet" type="text/css">
    <style>
        /* ---------- Layout (fixed) ---------- */
        html, body {
            height: 100%;
            margin: 0;
        }
		.page-container .sidebar-menu {
    background-color: #6c8397;
    width: 220px;
    min-height: 100vh;
    font-family: 'Roboto', sans-serif;
    display: flex;
    flex-direction: column; /* sidebar items stacked vertically */
}

        /* The container holds sidebar and main area side-by-side */
        .page-container {
            display: flex;
            min-height: 100vh;
            align-items: stretch;
        }

        /* Sidebar (fixed width column) */
        .sidebar-menu {
            width: 220px;
            flex: 0 0 220px;
            background-color: #6c8397;
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
        }

        .logo-env {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
            background-color: #6c8397;
            flex-shrink: 0;
        }

        .logo img {
            max-height: 50px;
            max-width: 140px;
            display: block;
            object-fit: contain;
        }

        .sidebar-collapse a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            font-size: 20px;
            color: #ffffff;
            background-color: #5a7182;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .sidebar-collapse a:hover {
            background-color: #455a66;
        }

        #main-menu li a { color: #ffffff !important; }
        #main-menu li a i { margin-right: 10px; font-size: 18px; }
        #main-menu li a:hover { background-color: #5a7182; color: #fff; }
        #main-menu li.active > a, #main-menu li ul li.active > a {
            background-color: #455a66; color: #fff;
        }

        /* Main content column: grows to fill remaining width */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column; /* allows footer to be placed with margin-top:auto */
            min-height: 100vh;
            background: #f8f9fa;
        }

        /* Inner content area - scrolls if needed, keeps footer visible */
        .content-area {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
            overflow: auto;
        }
        footer.main { margin-top: auto; background: #6c8397; color: #fff; text-align: center; padding: 15px 0; width: 100%; box-sizing: border-box; z-index: 10; }

        /* ---------- Form Card Styles ---------- */
        .form-card {
            max-width: 700px;
            margin: 20px auto;
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
        .form-card input, .form-card select, .form-card textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: all 0.15s;
            background: #fff;
        }
        .form-card input:focus, .form-card select:focus, .form-card textarea:focus {
            outline: none;
            border-color: #6c8397;
            box-shadow: 0 0 6px rgba(108,131,151,0.25);
        }
        .form-card .btn { padding: 10px 20px; border-radius: 6px; border: none; font-weight: 600; cursor: pointer; transition: all 0.15s; }
        .form-card .btn-submit { background-color: #6c8397; color: #fff; margin-right: 10px; }
        .form-card .btn-reset { background-color: #ccc; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 700px) { .form-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body class="page-body page-fade" onload="collapseSidebar()">

<div class="page-container sidebar-collapsed" id="navbarcollapse">	

	<div class="sidebar-menu">
		<header class="logo-env">
			<div class="logo">
				<a href="#">
					<img src="msc_logo_Blanc-1.png" alt="" width="192" height="80" />
				</a>
			</div>
			<div class="sidebar-collapse" onclick="collapseSidebar()">
				<a href="#" class="sidebar-collapse-icon with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>
		<?php include('nav.php'); ?>
	</div>

	<div class="main-content">
		<div class="row">
			<div class="col-md-6 col-sm-8 clearfix"></div>
			<div class="col-md-6 col-sm-4 clearfix hidden-xs">		
				<ul class="list-inline links-list pull-right">
					<li style="font-size: 14px; font-weight: bold;">Welcome <?php echo $_SESSION['full_name']; ?></li>
					<li><a href="logout.php" style="font-size: 16px; font-weight: bold; color:red">Log Out <i class="entypo-logout right"></i></a></li>
				</ul>
			</div>
		</div>

                <h3>Create Routine</h3>
            <hr />

		<div class="form-card">
			<h6>NEW ROUTINE</h6>
			<form id="form1" name="form1" method="post" action="saveroutine.php">
				<div class="form-grid">
					<div>
						<label for="rname">Routine Name</label>
						<input type="text" name="rname" id="rname" required>
					</div>
					<div>
						<label for="pidd">Plan ID</label>
						<input type="text" name="pidd" id="pidd" required>
					</div>
				</div>

				<label for="day1">Day 1</label>
				<textarea name="day1" id="day1" rows="3" style="resize:none;"></textarea>

				<label for="day2">Day 2</label>
				<textarea name="day2" id="day2" rows="3" style="resize:none;"></textarea>

				<label for="day3">Day 3</label>
				<textarea name="day3" id="day3" rows="3" style="resize:none;"></textarea>

				<label for="day4">Day 4</label>
				<textarea name="day4" id="day4" rows="3" style="resize:none;"></textarea>

				<label for="day5">Day 5</label>
				<textarea name="day5" id="day5" rows="3" style="resize:none;"></textarea>

				<label for="day6">Day 6</label>
				<textarea name="day6" id="day6" rows="3" style="resize:none;"></textarea>

				<div style="margin-top:15px; text-align:center;">
					<button type="submit" class="btn btn-submit">Add Routine</button>
					<button type="reset" class="btn btn-reset">Reset</button>
				</div>
			</form>
		</div>

		<?php include('footer.php'); ?>
	</div>
</div>

</body>
</html>


				
