<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SPORTS CLUB | Member History</title>
    <link rel="stylesheet" href="../../css/style.css" id="style-resource-5">
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

                    <!-- Member Info -->
            <div class="form-card">
                <h3>Member History</h3>
                <p>
                    Details of: <strong>
                    <?php
                        $id = $_POST['name'];
                        $query = "SELECT * FROM users WHERE userid='$id'";
                        $result = mysqli_query($con, $query);

                        if (mysqli_affected_rows($con) != 0) {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                $name   = $row['username'];
                                $memid  = $row['userid'];
                                $gender = $row['gender'];
                                $mobile = $row['mobile'];
                                $email  = $row['email'];
                                $joinon = $row['joining_date'];
                                echo $name;
                            }
                        }
                    ?>
                    </strong>
                </p>
            </div>

            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Membership ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Join On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo "<tr>
                                    <td>$memid</td>
                                    <td>$name</td>
                                    <td>$gender</td>
                                    <td>$mobile</td>
                                    <td>$email</td>
                                    <td>$joinon</td>
                                  </tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        <br><br>

        <!-- Payment History -->
            <div class="form-card">
                <h3>Payment History</h3>
                <p>Payment history of: <strong><?php echo $name; ?></strong></p>
            </div>

            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Plan Name</th>
                            <th>Plan Desc</th>
                            <th>Validity</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                            <th>Expire Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query1 = "SELECT * FROM enrolls_to WHERE uid='$memid'";
                            $result = mysqli_query($con, $query1);
                            $sno = 1;

                            if (mysqli_affected_rows($con) != 0) {
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $pid = $row['pid'];
                                    $query2 = "SELECT * FROM plan WHERE pid='$pid'";
                                    $result2 = mysqli_query($con, $query2);
                                    if ($result2) {
                                        $row1 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                        echo "<tr>
                                                <td>$sno</td>
                                                <td>{$row1['planName']}</td>
                                                <td width='380'>{$row1['description']}</td>
                                                <td>{$row1['validity']}</td>
                                                <td>{$row1['amount']}</td>
                                                <td>{$row['paid_date']}</td>
                                                <td>{$row['expire']}</td>
                                                <td>
                                                    <a href='gen_invoice.php?id={$row['uid']}&pid={$row['pid']}&etid={$row['et_id']}'>
                                                        <input type='button' class='btn-action btn-memo' value='Memo'>
                                                    </a>
                                                </td>
                                              </tr>";
                                        $sno++;
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>

        </div> <!-- content-area -->


    <?php include('footer.php'); ?>

</div>
</body>
</html>
