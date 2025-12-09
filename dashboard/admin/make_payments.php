<?php
require '../../include/db_conn.php';
page_protect();
if (isset($_POST['userID']) && isset($_POST['planID'])) {
    $uid  = $_POST['userID'];
    $planid=$_POST['planID'];
    $query1 = "select * from users WHERE userid='$uid'";
    
    $result1 = mysqli_query($con, $query1);
    
    if (mysqli_affected_rows($con) == 1) {
        while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
            
            $name = $row1['username'];
            $query2="select * from plan where pid='$planid'";

            $result2=mysqli_query($con,$query2);
            if($result2){
               $planValue=mysqli_fetch_array($result2,MYSQLI_ASSOC);
               $planName=$planValue['planName'];
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPORTS CLUB | Make Payment</title>
    <link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" type="text/css" rel="stylesheet">

    <style>
        /* Use same sidebar + layout rules from your New User page */
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
        .sidebar-menu {
            width: 220px; flex: 0 0 220px;
            background-color: #6c8397;
            min-height: 100vh; font-family: 'Roboto', sans-serif;
            display: flex; flex-direction: column;
        }
        .logo-env { display: flex; align-items: center; justify-content: space-between;
            padding: 10px 15px; background-color: #6c8397; flex-shrink: 0; }
        .logo img { max-height: 50px; max-width: 140px; object-fit: contain; }
        .sidebar-collapse a { display: flex; align-items: center; justify-content: center;
            width: 40px; height: 40px; font-size: 20px; color: #fff;
            background-color: #5a7182; border-radius: 4px; transition: background 0.3s; }
        .sidebar-collapse a:hover { background-color: #455a66; }
        #main-menu li a { color: #fff !important; }
        #main-menu li a:hover { background-color: #5a7182; }

        .main-content { flex: 1; display: flex; flex-direction: column; min-height: 100vh; background: #f8f9fa; }
        .content-area { flex: 1; padding: 20px; overflow: auto; }

        footer.main {
            margin-top: auto; background: #6c8397; color: #fff;
            text-align: center; padding: 15px 0; width: 100%;
        }

        /* Form Card */
        .form-card {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            font-family: 'Roboto', sans-serif;
        }
        .form-card h6 {
            background: #6c8397; color: #fff; padding: 12px;
            border-radius: 10px 10px 0 0;
            text-align: center; margin: -30px -30px 25px -30px;
            font-size: 16px; letter-spacing: 1px;
        }
        .form-card label { font-weight: 600; margin-bottom: 5px; display: block; color: #333; }
        .form-card input, .form-card select {
            width: 100%; padding: 10px 12px; margin-bottom: 18px;
            border: 1px solid #ccc; border-radius: 6px; background: #fff;
        }
        .form-card input:focus, .form-card select:focus {
            outline: none; border-color: #6c8397;
            box-shadow: 0 0 6px rgba(108,131,151,0.25);
        }
        .form-card .btn {
            padding: 10px 20px; border-radius: 6px; border: none;
            font-weight: 600; cursor: pointer; transition: all 0.15s;
        }
        .form-card .btn-submit { background: #6c8397; color: #fff; margin-right: 10px; }
        .form-card .btn-reset { background: #ccc; }
    </style>
</head>

<body class="page-body page-fade" onload="collapseSidebar()">
<div class="page-container sidebar-collapsed" id="navbarcollapse">

    <!-- SIDEBAR -->
    <div class="sidebar-menu">
        <header class="logo-env">
            <div class="logo">
                <a href="#"><img src="msc_logo_Blanc-1.png" alt="Logo" /></a>
            </div>
            <div class="sidebar-collapse" onclick="collapseSidebar()">
                <a href="#" class="sidebar-collapse-icon with-animation"><i class="entypo-menu"></i></a>
            </div>
        </header>
        <?php include('nav.php'); ?>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="content-area">

            <!-- Top-right Welcome + Logout -->
            <div class="row">
                <div class="col-md-6 col-sm-8 clearfix"></div>
                <div class="col-md-6 col-sm-4 clearfix hidden-xs">
                    <ul class="list-inline links-list pull-right">
                        <li style="font-size: 16px; font-weight: bold;">
                            Welcome <?php echo $_SESSION['full_name']; ?>
                        </li>
                        <li>
                            <a href="logout.php" style="font-size: 16px; font-weight: bold;">
                                Log Out <i class="entypo-logout right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <h3>Make Payment</h3>
            <hr />

            <!-- Payment Form -->
            <div class="form-card">
                <h6>PAYMENT DETAILS</h6>
                <form id="form1" name="form1" method="post" action="submit_payments.php">
                    <label>Membership ID</label>
                    <input type="text" name="m_id" value="<?php echo $uid; ?>" readonly>

                    <label>Name</label>
                    <input type="text" name="u_name" value="<?php echo $name; ?>" readonly>

                    <label>Current Plan</label>
                    <input type="text" name="prevPlan" value="<?php echo $planName; ?>" readonly>

                    <label>Select New Plan</label>
                    <select name="plan" required onchange="myplandetail(this.value)">
                        <option value="">-- Please select --</option>
                        <?php
                        $query = "select * from plan where active='yes'";
                        $result = mysqli_query($con, $query);
                        if (mysqli_affected_rows($con) != 0) {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo "<option value=".$row['pid'].">".$row['planName']."</option>";
                            }
                        }
                        ?>
                    </select>

                    <div id="plandetls"></div>

                    <div style="text-align:center; margin-top: 20px;">
                        <button type="submit" class="btn btn-submit">Add Payment</button>
                        <button type="reset" class="btn btn-reset">Reset</button>
                    </div>
                </form>
            </div>

            <script>
                function myplandetail(str){
                    if(str==""){ document.getElementById("plandetls").innerHTML = ""; return; }
                    let xmlhttp = new XMLHttpRequest();
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

 <script>
        	function myplandetail(str){

        		if(str==""){
        			document.getElementById("plandetls").innerHTML = "";
        			return;
        		}else{
        			if (window.XMLHttpRequest) {
           		 // code for IE7+, Firefox, Chrome, Opera, Safari
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
        		
        	}
        </script>

<?php
} else {
    
}
?>
