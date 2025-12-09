<?php
require '../../include/db_conn.php';
page_protect();
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <title>SPORTS CLUB  | View Member</title>
   <link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
	<link href="a1style.css" rel="stylesheet" type="text/css">
	
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
		.main-content {
			flex: 1;
			display: flex;
			flex-direction: column; /* allows footer to be at bottom */
		}

		
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
html, body {
    height: 100%;
    margin: 0;
}

.page-container {
    display: flex;
    min-height: 100vh; /* full viewport height */
}

.sidebar-menu {
    width: 220px;
    flex: 0 0 220px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.main-content {
    flex: 1;
    display: flex;
    flex-direction: column; /* allow footer to be pushed down */
    min-height: 100vh;
}

.content-area {
    flex: 1; /* takes all remaining space above footer */
    padding: 20px;
    box-sizing: border-box;
}

footer.main {
    margin-top: auto; /* pushes footer to bottom */
    background: #6c8397;
    color: #fff;
    text-align: center;
    padding: 15px 0;
    width: 100%;
    box-sizing: border-box;
}


    </style>
</head>

    <body class="page-body  page-fade" onload="collapseSidebar()">

    	<div class="page-container sidebar-collapsed" id="navbarcollapse">	
	
		<div class="sidebar-menu">
	
			<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="#">
					<img src="msc_logo_Blanc-1.png" alt="" width="192" height="80" />
				</a>
			</div>
			
					<!-- logo collapse icon -->
					<div class="sidebar-collapse" onclick="collapseSidebar()">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>
							
			
		
			</header>
    		<?php include('nav.php'); ?>
    	</div>

    		<div class="main-content">
		
				<div class="row">
					
					<!-- Profile Info and Notifications -->
					<div class="col-md-6 col-sm-8 clearfix">	
							
					</div>
					
					
					<!-- Raw Links -->
					<div class="col-md-6 col-sm-4 clearfix hidden-xs">
						
                <ul class="list-inline links-list pull-right">
                    <li style="font-size: 14px; font-weight: bold;">Welcome <?php echo $_SESSION['full_name']; ?></li>
                    <li><a href="logout.php" style="font-size: 14px; font-weight: bold;color:red">Log Out <i class="entypo-logout right"></i></a></li>
                </ul>
					
					</div>
					
				</div>

		<h3>Member Detail</h3>

		<hr />
		
		<div class="table-responsive">
    <table class="modern-table" border="1">
        <thead>
            <tr>
                <th>Sl.No</th>
                <th>Membership Expiry</th>
                <th>Member ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>E-Mail</th>
                <th>Gender</th>
                <th>Joining Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query  = "select * from users ORDER BY joining_date";
                $result = mysqli_query($con, $query);
                $sno    = 1;

                if (mysqli_affected_rows($con) != 0) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $uid   = $row['userid'];
                        $query1  = "select * from enrolls_to WHERE uid='$uid' AND renewal='yes'";
                        $result1 = mysqli_query($con, $query1);
                        if (mysqli_affected_rows($con) == 1) {
                            while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                                echo "<tr><td>".$sno."</td>";
                                echo "<td>" . $row1['expire'] . "</td>";
                                echo "<td>" . $row['userid'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['mobile'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['gender'] . "</td>";
                                echo "<td>" . $row['joining_date'] ."</td>";
                                $sno++;
                            }
                        }
                    }
                }
            ?>
        </tbody>
    </table>
</div>
<script>
	
	function ConfirmDelete(name){
	
    var r = confirm("Are you sure! You want to Delete this User?");
    if (r == true) {
       return true;
    } else {
        return false;
    }
}

</script>
		
			<?php include('footer.php'); ?>
    	</div>

    </body>
</html>


