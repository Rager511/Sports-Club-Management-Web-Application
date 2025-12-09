<?php
if(session_status() == PHP_SESSION_NONE) session_start();
require '../../include/db_conn.php';
page_protect(); 
?>
<!DOCTYPE html>
<html lang="en">
<head> 

    
    <title>SPORTS CLUB  | Dashboard </title>

    <link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
	<style>
/* Sidebar container */
.page-container .sidebar-menu {
    background-color: #6c8397;
    width: 220px;
    min-height: 100vh;
    font-family: 'Roboto', sans-serif;
    display: flex;
    flex-direction: column; /* sidebar items stacked vertically */
}

/* Sidebar header: logo + collapse button wrapper */
.logo-env {
    display: flex;
    align-items: center;
    justify-content: space-between; /* logo left, button right */
    padding: 10px 15px;
    background-color: #6c8397;
    flex-shrink: 0;
}

/* Logo */
.logo img {
    max-height: 50px;       /* limit height */
    max-width: 140px;       /* limit width */
    display: block;
    object-fit: contain;    /* maintain aspect ratio */
}

/* Collapse button */
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

/* Main menu links */
#main-menu li a {
    color: #ffffff !important;
}

/* Icons in menu */
#main-menu li a i {
    margin-right: 10px;
    font-size: 18px;
}

/* Hover and active states */
#main-menu li a:hover {
    background-color: #5a7182;
    color: #ffffff;
}

#main-menu li.active > a,
#main-menu li ul li.active > a {
    background-color: #455a66;
    color: #ffffff;
}


footer {
    background: #6c8397;
    color: #fff;
    text-align: center;
    padding: 15px 0;
}

	</style>

</head>
    <body class="page-body  page-fade" onload="collapseSidebar()">

    	<div class="page-container sidebar-collapsed" id="navbarcollapse">	
	
		<div class="sidebar-menu">
	
		<header class="logo-env">
			<!-- Logo -->
			<div class="logo">
				<a href="#">
					<img src="msc_logo_Blanc-1.png" alt="Logo" />
				</a>
			</div>

			<!-- Collapse button -->
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon with-animation" onclick="collapseSidebar()">
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
			<style>
			.tile-stats {
				display: flex;
				flex-direction: column;
				justify-content: center; 
				align-items: center;     
				padding: 40px 20px;
				color: #fff;
				min-height: 200px;      
				font-size: 22px;
				border-radius: 8px;
				box-shadow: 0 4px 8px rgba(0,0,0,0.1);
				transition: transform 0.2s;
			}

			.tile-stats:hover {
				transform: translateY(-5px);
			}

			.tile-stats .icon {
				font-size: 50px;
				margin-bottom: 15px;
			}

			.tile-stats .num {
				font-size: 28px;
				font-weight: bold;
				margin-bottom: 10px;
				text-align: center;
			}

			.tile-stats .tile-title {
				font-size: 18px;
				text-align: center;
			}
			</style>
			<h2 class="text-center mb-1" style="color: #333;font-size=10px">SPORTS CLUB Dashboard</h2>
    <hr>

    <div class="row justify-content-center">
        <!-- Tile 1: Paid Income This Month -->
        <div class="col-md-6 mb-4">
            <a href="revenue_month.php">
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num">
                        <?php
                            date_default_timezone_set("Asia/Calcutta"); 
                            $date  = date('Y-m');
                            $query = "SELECT * FROM enrolls_to WHERE paid_date LIKE '$date%'";
                            $result  = mysqli_query($con, $query);
                            $revenue = 0;
                            if (mysqli_affected_rows($con) != 0) {
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $query1="SELECT * FROM plan WHERE pid='".$row['pid']."'";
                                    $result1=mysqli_query($con,$query1);
                                    if($result1){
                                        $value=mysqli_fetch_row($result1);
                                        $revenue += $value[4];
                                    }
                                }
                            }
                            echo "₹".$revenue;
                        ?>
                    </div>
                    <div class="tile-title">Paid Income This Month</div>
                </div>
            </a>
        </div>

        <!-- Tile 2: Total Members -->
        <div class="col-md-6 mb-4">
            <a href="table_view.php">
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <div class="num">
                        <?php
                            $query = "SELECT COUNT(*) AS count FROM users";
                            $result = mysqli_query($con, $query);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count'];
                        ?>
                    </div>
                    <div class="tile-title">Total Members</div>
                </div>
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <!-- Tile 3: Joined This Month -->
        <div class="col-md-6 mb-4">
            <a href="over_members_month.php">
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-mail"></i></div>
                    <div class="num">
                        <?php
                            $query = "SELECT COUNT(*) AS count FROM users WHERE joining_date LIKE '$date%'";
                            $result = mysqli_query($con, $query);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count'];
                        ?>
                    </div>
                    <div class="tile-title">Joined This Month</div>
                </div>
            </a>
        </div>

        <!-- Tile 4: Total Plan Available -->
        <div class="col-md-6 mb-4">
            <a href="view_plan.php">
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-rss"></i></div>
                    <div class="num">
                        <?php
                            $query = "SELECT COUNT(*) AS count FROM plan WHERE active='yes'";
                            $result = mysqli_query($con, $query);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['count'];
                        ?>
                    </div>
                    <div class="tile-title">Total Plan Available</div>
                </div>
            </a>
        </div>
    </div>
			
<marquee direction="right"><img src="fball.gif" width="88" height="70" alt="Tutorials " border="0"></marquee>

			
   
    	<?php include('footer.php'); ?>
</div>

  
    </body>
</html>
