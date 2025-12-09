<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPORTS CLUB | New User</title>
    <link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" type="text/css" rel="stylesheet">

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

<body class="page-body page-fade" onload="collapseSidebar()">
<div class="page-container sidebar-collapsed" id="navbarcollapse">

    <!-- SIDEBAR -->
    <div class="sidebar-menu">
        <header class="logo-env">
            <div class="logo">
                <a href="#"><img src="msc_logo_Blanc-1.png" alt="Logo" width="192" height="80" /></a>
            </div>
            <div class="sidebar-collapse" onclick="collapseSidebar()">
                <a href="#" class="sidebar-collapse-icon with-animation"><i class="entypo-menu"></i></a>
            </div>
        </header>

        <?php include('nav.php'); ?>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- SCROLLABLE AREA -->
        <div class="content-area">

            <div class="row">
                <div class="col-md-6 col-sm-8 clearfix"></div>
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

            <h3>New Registration</h3>
            <hr />

            <div class="form-card">
                <h6>NEW ENTRY</h6>
                <form id="form1" name="form1" method="post" action="new_submit.php">
                    <div class="form-grid">
                        <div>
                            <label>Membership ID</label>
                            <input type="text" name="m_id" value="<?php echo time(); ?>" readonly required>
                        </div>
                        <div>
                            <label>Name</label>
                            <input type="text" name="u_name" required>
                        </div>
                        <div>
                            <label>Street Name</label>
                            <input type="text" name="street_name" required>
                        </div>
                        <div>
                            <label>City</label>
                            <input type="text" name="city" required>
                        </div>
                        <div>
                            <label>Zipcode</label>
                            <input type="number" name="zipcode" maxlength="6" required>
                        </div>
                        <div>
                            <label>State</label>
                            <input type="text" name="state" required>
                        </div>
                        <div>
                            <label>Gender</label>
                            <select name="gender" required>
                                <option value="">--Please Select--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div>
                            <label>Date of Birth</label>
                            <input type="date" name="dob" required>
                        </div>
                        <div>
                            <label>Phone No</label>
                            <input type="number" name="mobile" maxlength="10" required>
                        </div>
                        <div>
                            <label>Email ID</label>
                            <input type="email" name="email" required>
                        </div>
                        <div>
                            <label>Joining Date</label>
                            <input type="date" name="jdate" required>
                        </div>
                        <div>
                            <label>Sports Plan</label>
                            <select name="plan" required onchange="myplandetail(this.value)">
                                <option value="">--Please Select--</option>
                                <?php
                                $query="select * from plan where active='yes'";
                                $result=mysqli_query($con,$query);
                                if(mysqli_affected_rows($con)!=0){
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value=".$row[0].">".$row[1]."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div id="plandetls"></div>

                    <div style="text-align:center; margin-top: 20px;">
                        <button type="submit" class="btn btn-submit">Register</button>
                        <button type="reset" class="btn btn-reset">Reset</button>
                    </div>
                </form>
            </div>

            <script>
                function myplandetail(str){
                    if(str==""){
                        document.getElementById("plandetls").innerHTML = "";
                        return;
                    }
                    let xmlhttp;
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("plandetls").innerHTML=this.responseText;
                        }
                    };
                    xmlhttp.open("GET","plandetail.php?q="+str,true);
                    xmlhttp.send();
                }
            </script>

        </div> 

        <?php include('footer.php'); ?>

    </div>

</div> 

</body>
</html>
