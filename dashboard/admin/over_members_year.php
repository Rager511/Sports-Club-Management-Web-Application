<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>SPORTS CLUB  | Member per Year</title>
     <link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
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
    <body class="page-body  page-fade" onload="collapseSidebar();showMember();">

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

		<h2>Member Per Year</h2>

		<hr />

<div class="form-card">
    <form id="yearForm">
        <?php
        // set start and end year range
        $yearArray = range(2000, date('Y'));
        ?>
        <div class="form-grid">
            <div>
                <label for="syear">Year</label>
                <select name="year" id="syear">
                    <option value="0">Select Year</option>
                    <?php
                    foreach ($yearArray as $year) {
                        $selected = ($year == date('Y')) ? 'selected' : '';
                        echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div style="text-align:center; margin-top: 20px;">
            <input type="button" class="btn btn-submit" name="search" onclick="showMember();" value="Search">
        </div>
    </form>
		<table id="meyear" style="width:100%; border-collapse: collapse; margin-top:20px;" border="1">
		</table>
</div>


<script>

  function showMember(){
  	var year=document.getElementById("syear");
  	var iyear=year.selectedIndex;
  	var ynumber=year.options[iyear].value;
  	if(ynumber=="0"){
      document.getElementById("meyear").innerHTML="";
      return;
  	}
  	else{
  		if(window.XMLHttpRequest){
  			xmlhttp=new XMLHttpRequest();
  		}
  		xmlhttp.onreadystatechange=function(){
  			if(this.readyState==4 && this.status ==200){
  				document.getElementById("meyear").innerHTML=this.responseText;
  			}
  		};
  		xmlhttp.open("GET","over_month.php?mm=0&flag=1&yy="+ynumber,true);
  		xmlhttp.send();
  	}

  }

</script>

<?php include('footer.php'); ?>

   	</div>

    </body>
</html>
