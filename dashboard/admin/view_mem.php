<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>SPORTS CLUB  | Member View</title>
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

        /* Footer placed inside .main-content and pushed down */
        footer.main {
            margin-top: auto; /* pushes footer to bottom */
            background: #6c8397;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            width: 100%;
            box-sizing: border-box;
            z-index: 10;
        }

        /* ---------- Form styles (kept from your modernized version) ---------- */
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

        .form-card label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        .form-card input, .form-card select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: all 0.15s;
            background: #fff;
        }

        .form-card input:focus, .form-card select:focus {
            outline: none;
            border-color: #6c8397;
            box-shadow: 0 0 6px rgba(108,131,151,0.25);
        }

        .form-card .btn {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s;
        }

        .form-card .btn-submit {
            background-color: #6c8397;
            color: #fff;
            margin-right: 10px;
        }

        .form-card .btn-reset {
            background-color: #ccc;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 700px) {
            .form-grid { grid-template-columns: 1fr; }
        }

        #plandetls { margin-top: 10px; }
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
                        <li style="font-size: 16px; font-weight: bold;">
                            Welcome <?php echo $_SESSION['full_name']; ?>
                        </li>
                        <li>
                            <a href="logout.php" style="font-size: 16px; font-weight: bold;color:red">
                                Log Out <i class="entypo-logout right"></i>
                            </a>
                        </li>
                    </ul>
						
					</div>
					
				</div>

		<h3>Edit Member</h3>

		<hr />
		
<style>
    .styled-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        font-family: 'Roboto', sans-serif;
    }

    .styled-table thead {
        background: #6c8397;
        color: #fff;
        text-align: left;
    }

    .styled-table th, .styled-table td {
        padding: 12px 15px;
        font-size: 14px;
        border-bottom: 1px solid #e0e0e0;
    }

    .styled-table th {
        font-size: 15px;
        font-weight: bold;
        letter-spacing: 0.5px;
    }

    .styled-table tbody tr:nth-child(even) {
        background: #f9f9f9;
    }

    .styled-table tbody tr:hover {
        background: #f1f5f9;
    }

    /* Action buttons */
    .action-btn {
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
        margin: 2px;
        color: #fff;
    }

    .btn-view { background: #4cafef; }
    .btn-edit { background: #4caf50; }
    .btn-delete { background: #e74c3c; }

    .btn-view:hover { background: #3498db; }
    .btn-edit:hover { background: #43a047; }
    .btn-delete:hover { background: #c0392b; }
</style>


<table class="styled-table">
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
            <th>Action</th>
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
                            echo "<tr>";
                            echo "<td>".$sno."</td>";
                            echo "<td>".$row1['expire']."</td>";
                            echo "<td>".$row['userid']."</td>";
                            echo "<td>".$row['username']."</td>";
                            echo "<td>".$row['mobile']."</td>";
                            echo "<td>".$row['email']."</td>";
                            echo "<td>".$row['gender']."</td>";
                            echo "<td>".$row['joining_date']."</td>";
                            echo "<td>
                                    <form action='read_member.php' method='post' style='display:inline;'>
                                        <input type='hidden' name='name' value='".$uid."'/>
                                        <input type='submit' class='action-btn btn-view' value='View'/>
                                    </form>
                                    <form action='edit_member.php' method='post' style='display:inline;'>
                                        <input type='hidden' name='name' value='".$uid."'/>
                                        <input type='submit' class='action-btn btn-edit' value='Edit'/>
                                    </form>
                                    <form action='del_member.php' method='post' onsubmit='return ConfirmDelete()' style='display:inline;'>
                                        <input type='hidden' name='name' value='".$uid."'/>
                                        <input type='submit' class='action-btn btn-delete' value='Delete'/>
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





