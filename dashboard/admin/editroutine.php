<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SPORTS CLUB | View Routine</title>
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

        /* ---------- Table Card Styles ---------- */
        .form-card { max-width: 900px; margin: 20px auto; background: #fff; border-radius: 12px; padding: 20px 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); font-family: 'Roboto', sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table th, table td { padding: 10px; text-align: center; border: 1px solid #ccc; }
        table th { background-color: #6c8397; color: #fff; font-weight: 600; }
        table tr:nth-child(even) { background-color: #f2f2f2; }
        .a1-btn { padding: 6px 12px; border-radius: 6px; font-weight: 600; cursor: pointer; border: none; }
        .a1-blue { background-color: #6c8397; color: #fff; }
        .a1-orange { background-color: #f39c12; color: #fff; }
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
                    <li style="font-size:16px; font-weight:bold;">Welcome <?php echo $_SESSION['full_name']; ?></li>
                    <li><a href="logout.php" style="font-size:16px; font-weight:bold;color:red">Log Out <i class="entypo-logout right"></i></a></li>
                </ul>
            </div>
        </div>

        <h3>Edit Routine</h3>
        <hr />

        <div class="form-card">
            <table>
                <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Routine Name</th>
                        <th>Routine Details</th>
                        <th>Delete Routine</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query  = "SELECT * FROM sports_timetable";
                    $result = mysqli_query($con, $query);
                    $sno = 1;
                    if (mysqli_affected_rows($con) != 0) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<tr>";
                            echo "<td>".$sno."</td>";
                            echo "<td>".$row['tname']."</td>";
                            echo '<td><a href="editdetailroutine.php?id='.$row['tid'].'"><button class="a1-btn a1-blue">Edit Routine</button></a></td>';
                            echo "<td>
                                    <form action='deleteroutine.php' method='post' onsubmit='return ConfirmDelete()'>
                                        <input type='hidden' name='name' value='".$row['tid']."' />
                                        <button class='a1-btn a1-orange' type='submit'>Delete</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                            $sno++;
                        }
                    } else {
                        echo "<tr><td colspan='4'>No routines found.</td></tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>

        <?php include('footer.php'); ?>
    </div>
</div>

</body>
</html>
