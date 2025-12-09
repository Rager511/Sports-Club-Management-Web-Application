<?php
require '../../include/db_conn.php';
page_protect();

if (isset($_POST['name'])) {
    $memid = $_POST['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>SPORTS CLUB | Edit Member</title>
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

		.form-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-family: 'Roboto', sans-serif;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    border-radius: 12px;
    overflow: hidden;
}

.form-table td {
    padding: 12px 15px;
    vertical-align: middle;
}

.form-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.form-table tr:hover {
    background-color: #e2e8f0;
    transition: 0.2s;
}

.form-table td:first-child {
    font-weight: 600;
    background-color: #f0f0f0;
    width: 35%;
}

.form-table input[type="text"],
.form-table input[type="email"],
.form-table input[type="number"],
.form-table input[type="date"],
.form-table select,
.form-table textarea {
    width: 95%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    transition: all 0.2s;
}

.form-table input[type="text"]:focus,
.form-table input[type="email"]:focus,
.form-table input[type="number"]:focus,
.form-table input[type="date"]:focus,
.form-table select:focus,
.form-table textarea:focus {
    outline: none;
    border-color: #6c8397;
    box-shadow: 0 0 6px rgba(108,131,151,0.25);
}

.form-table textarea {
    resize: none;
    height: 60px;
}

.form-table .action-buttons input {
    padding: 10px 20px;
    border-radius: 6px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.form-table .action-buttons input[type="submit"] {
    background-color: #6c8397;
    color: #fff;
    margin-right: 10px;
}

.form-table .action-buttons input[type="reset"] {
    background-color: #ccc;
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
			<h3>Edit Member Details</h3>
			<hr/>
			<?php
	    
				    $query  = "SELECT * FROM users u 
				    		   INNER JOIN address a ON u.userid=a.id
				    		   INNER JOIN  health_status h ON u.userid=h.uid
				    		   WHERE userid='$memid'";
				    //echo $query;
				    $result = mysqli_query($con, $query);
				    $sno    = 1;
				    
				    $name="";
				    $gender="";

				    if (mysqli_affected_rows($con) == 1) {
				        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				    
				            $name    = $row['username'];
				            $gender =$row['gender'];
				            $mobile = $row['mobile'];
				            $email   = $row['email'];
				            $dob	 = $row['dob'];         
				            $jdate    = $row['joining_date'];
				          	$streetname=$row['streetName'];
				          	$state=$row['state'];
				          	$city=$row['city'];  
				          	$zipcode=$row['zipcode'];
				            $calorie=$row['calorie'];
				            $height=$row['height'];
				            $weight=$row['weight'];
				            $fat=$row['fat'];
				            $remarks=$row['remarks'];				            
				        }
				    }
				    else{
				    	 echo "<html><head><script>alert('Change Unsuccessful');</script></head></html>";
				    	 echo mysqli_error($con);
				    }


				?>

<div class="content-area" style="display:flex; justify-content:center; align-items:flex-start; padding-top:20px;">
    <div class="form-card">
        <h6>EDIT MEMBER PROFILE</h6>
        <form id="form1" name="form1" method="post" action="edit_mem_submit.php">
        <div class="form-grid">
            <div>
                <label>User ID</label>
                <input type="text" name="uid" readonly required value="<?php echo $memid ?>">
            </div>
            <div>
                <label>Name</label>
                <input type="text" name="uname" value="<?php echo $name ?>" required>
            </div>
            <div>
                <label>Gender</label>
                <select name="gender" required>
                    <option value="">--Please Select--</option>
                    <option value="Male" <?php if($gender=="Male") echo "selected";?>>Male</option>
                    <option value="Female" <?php if($gender=="Female") echo "selected";?>>Female</option>
                </select>
            </div>
            <div>
                <label>Mobile</label>
                <input type="number" name="phone" maxlength="10" value="<?php echo $mobile ?>" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email ?>" required>
            </div>
            <div>
                <label>Date of Birth</label>
                <input type="date" name="dob" value="<?php echo $dob ?>" required>
            </div>
            <div>
                <label>Joining Date</label>
                <input type="date" name="jdate" value="<?php echo $jdate ?>" required>
            </div>
            <div>
                <label>Street Name</label>
                <input type="text" name="stname" value="<?php echo $streetname ?>" required>
            </div>
            <div>
                <label>State</label>
                <input type="text" name="state" value="<?php echo $state ?>" required>
            </div>
            <div>
                <label>City</label>
                <input type="text" name="city" value="<?php echo $city ?>" required>
            </div>
            <div>
                <label>Zipcode</label>
                <input type="text" name="zipcode" value="<?php echo $zipcode ?>" required>
            </div>
            <div>
                <label>Calorie</label>
                <input type="text" name="calorie" value="<?php echo $calorie ?>">
            </div>
            <div>
                <label>Height</label>
                <input type="text" name="height" value="<?php echo $height ?>">
            </div>
            <div>
                <label>Weight</label>
                <input type="text" name="weight" value="<?php echo $weight ?>">
            </div>
            <div>
                <label>Fat</label>
                <input type="text" name="fat" value="<?php echo $fat ?>">
            </div>
            <div style="grid-column: 1 / -1;">
                <label>Remarks</label>
                <textarea name="remarks"><?php echo $remarks ?></textarea>
            </div>
        </div>

        <div style="text-align:center; margin-top: 20px;">
            <button type="submit" class="btn btn-submit">Update</button>
            <button type="reset" class="btn btn-reset">Reset</button>
        </div>
    </form>
</div>
</div>   			

			<?php include('footer.php'); ?>
    	</div>

  
</body>
</html>	

<?php
} else {
    
}
?>
