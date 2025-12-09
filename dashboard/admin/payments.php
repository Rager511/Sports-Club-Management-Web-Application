<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SPORTS CLUB  | Payments</title>
    <link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
	<link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" type="text/css" rel="stylesheet">

    <style>
        /* Sidebar */
        .page-container .sidebar-menu { background-color: #6c8397; width: 220px; min-height: 100vh; font-family: 'Roboto', sans-serif; display: flex; flex-direction: column; }
        .logo-env { display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; background-color: #6c8397; flex-shrink: 0; }
        .logo img { max-height: 50px; max-width: 140px; display: block; object-fit: contain; }
        .sidebar-collapse a { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; font-size: 20px; color: #fff; background-color: #5a7182; border-radius: 4px; transition: 0.3s; }
        .sidebar-collapse a:hover { background-color: #455a66; }
        #main-menu li a { color: #fff !important; }
        #main-menu li a i { margin-right: 10px; font-size: 18px; }
        #main-menu li a:hover { background-color: #5a7182; color: #fff; }
        #main-menu li.active > a, #main-menu li ul li.active > a { background-color: #455a66; color: #fff; }

        /* Table styles */
        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-family: 'Roboto', sans-serif;
            margin-top: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        .modern-table thead {
            background-color: #6c8397;
            color: #fff;
        }

        .modern-table th, .modern-table td {
            padding: 12px 15px;
            text-align: left;
        }

        .modern-table tbody tr {
            background-color: #f8f9fa;
            transition: background 0.2s;
        }

        .modern-table tbody tr:nth-child(even) { background-color: #e9ecef; }
        .modern-table tbody tr:hover { background-color: #d1d8e0; }

        .modern-table .btn-action {
            padding: 6px 12px;
            background-color: #6c8397;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.2s;
        }

        .modern-table .btn-action:hover { background-color: #5a7182; }

        /* Responsive scroll */
        .table-responsive {
            overflow-x: auto;
            margin-top: 20px;
        }
		footer {
			position: fixed;
			bottom: 0;
			left: 0;
			width: 100%;
		}
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
                    <li><a href="logout.php" style="font-size: 14px; font-weight: bold;color:red">Log Out <i class="entypo-logout right"></i></a></li>
                </ul>
            </div>
        </div>

        <h3>Payments</h3>
        <hr />

        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Membership Expiry</th>
                        <th>Name</th>
                        <th>Member ID</th>
                        <th>Phone</th>
                        <th>E-Mail</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query  = "select * from enrolls_to where renewal='yes' ORDER BY expire";
                $result = mysqli_query($con, $query);
                $sno    = 1;

                if (mysqli_affected_rows($con) != 0) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $uid   = $row['uid'];
                        $planid= $row['pid'];
                        $query1  = "select * from users WHERE userid='$uid'";
                        $result1 = mysqli_query($con, $query1);

                        if (mysqli_affected_rows($con) == 1) {
                            while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                                echo "<tr>";
                                echo "<td>".$sno."</td>";
                                echo "<td>".$row['expire']."</td>";
                                echo "<td>".$row1['username']."</td>";
                                echo "<td>".$row1['userid']."</td>";
                                echo "<td>".$row1['mobile']."</td>";
                                echo "<td>".$row1['email']."</td>";
                                echo "<td>".$row1['gender']."</td>";
                                echo "<td>
                                    <form action='make_payments.php' method='post' style='margin:0;'>
                                        <input type='hidden' name='userID' value='".$uid."'/>
                                        <input type='hidden' name='planID' value='".$planid."'/>
                                        <input type='submit' class='btn-action' value='Add Payment'/>
                                    </form>
                                </td>";
                                echo "</tr>";
                                $sno++;
                            }
                        }
                    }
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>

    <?php include('footer.php'); ?>

</div>
</body>
</html>
