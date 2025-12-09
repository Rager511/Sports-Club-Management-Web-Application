<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SPORTS CLUB | Update Plan</title>

    <link rel="stylesheet" href="../../css/style.css" id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" rel="stylesheet" type="text/css">

    <style>
        /* ---------- Sidebar Styles ---------- */
        .page-container .sidebar-menu { background-color: #6c8397; width: 220px; min-height: 100vh; font-family: 'Roboto', sans-serif; display: flex; flex-direction: column; }
        .logo-env { display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; background-color: #6c8397; flex-shrink: 0; }
        .logo img { max-height: 50px; max-width: 140px; display: block; object-fit: contain; }
        .sidebar-collapse a { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; font-size: 20px; color: #fff; background-color: #5a7182; border-radius: 4px; transition: 0.3s; }
        .sidebar-collapse a:hover { background-color: #455a66; }
        #main-menu li a { color: #fff !important; }
        #main-menu li a i { margin-right: 10px; font-size: 18px; }
        #main-menu li a:hover { background-color: #5a7182; color: #fff; }
        #main-menu li.active > a, #main-menu li ul li.active > a { background-color: #455a66; color: #fff; }

        /* ---------- Layout ---------- */
        html, body { height: 100%; margin: 0; }
        .page-container { display: flex; min-height: 100vh; align-items: stretch; }
        .main-content { flex: 1; display: flex; flex-direction: column; min-height: 100vh; background: #f8f9fa; }
        .content-area { flex: 1; padding: 20px; box-sizing: border-box; overflow: auto; display:flex; justify-content:center; align-items:flex-start; padding-top:20px; }
        footer.main { margin-top: auto; background: #6c8397; color: #fff; text-align: center; padding: 15px 0; width: 100%; box-sizing: border-box; z-index: 10; }

        /* ---------- Form Card Styles ---------- */
        .form-card { max-width: 700px; margin: 20px auto; background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); font-family: 'Roboto', sans-serif; }
        .form-card h6 { background: #6c8397; color: #fff; padding: 12px; border-radius: 10px 10px 0 0; text-align: center; margin: -30px -30px 25px -30px; font-size: 16px; letter-spacing: 1px; }
        .form-card label { font-weight: 600; margin-bottom: 5px; display: block; color: #333; }
        .form-card input, .form-card select, .form-card textarea { width: 100%; padding: 10px 12px; margin-bottom: 18px; border: 1px solid #ccc; border-radius: 6px; transition: all 0.15s; background: #fff; }
        .form-card input:focus, .form-card select:focus, .form-card textarea:focus { outline: none; border-color: #6c8397; box-shadow: 0 0 6px rgba(108,131,151,0.25); }
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
                <a href="#"><img src="msc_logo_Blanc-1.png" alt="" width="192" height="80" /></a>
            </div>
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
                    <li style="font-size: 14px; font-weight: bold;">Welcome <?php echo $_SESSION['full_name']; ?></li>
                    <li><a href="logout.php" style="font-size: 14px; font-weight: bold;color:red">Log Out <i class="entypo-logout right"></i></a></li>
                </ul>
            </div>
        </div>

        <h3>Update Plan</h3>
        <hr />

        <?php
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $sql = "SELECT * FROM plan t WHERE t.pid='$id'";
        $res = mysqli_query($con, $sql);

        if($res){
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        }
        ?>

        <div class="content-area">
            <div class="form-card">
                <h6>UPDATE PLAN DETAILS</h6>
                <form id="form1" name="form1" method="post" action="updateplan.php">
                    <div class="form-grid">
                        <div>
                            <label>Sports Plan ID</label>
                            <input type="text" name="planid" readonly value="<?php echo $row['pid']; ?>">
                        </div>
                        <div>
                            <label>Sports Plan Name</label>
                            <input type="text" name="planname" value="<?php echo $row['planName']; ?>">
                        </div>
                        <div>
                            <label>Sports Plan Description</label>
                            <input type="text" name="desc" value="<?php echo $row['description']; ?>">
                        </div>
                        <div>
                            <label>Sports Plan Validity (Months)</label>
                            <input type="number" name="planval" value="<?php echo $row['validity']; ?>">
                        </div>
                        <div>
                            <label>Sports Plan Amount</label>
                            <input type="text" name="amount" value="<?php echo $row['amount']; ?>">
                        </div>
                    </div>

                    <div style="text-align:center; margin-top: 20px;">
                        <button type="submit" name="submit" class="btn btn-submit">Update Plan</button>
                        <button type="reset" class="btn btn-reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </div>
</div>

</body>
</html>
