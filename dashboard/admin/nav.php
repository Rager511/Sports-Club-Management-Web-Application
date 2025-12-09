
<style>
/* Sidebar container */
.sidebar {
    background-color: #6c8397; /* same bluish-gray */
    min-height: 100vh; /* full height */
    width: 220px; /* adjust as needed */
    padding: 0;
    margin: 0;
}


/* Main menu list */
#main-menu {
    list-style: none;
    padding: 0;
    margin: 0;
	background-color:transparent
}

/* Top-level menu items */
#main-menu > li {
    border-bottom: 1px solid rgba(0,0,0,0.2);
    position: relative;
}

/* Top-level links */
#main-menu li a {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    color: #f5f5f5;
    text-decoration: none;
    transition: background 0.3s, color 0.3s;
}

#main-menu li a i {
    margin-right: 10px;
    font-size: 18px;
}

/* Hover effect for top-level links */
#main-menu li a:hover {
    background-color: #5a7182; /* slightly darker */
    color: #ffffff;
}

/* Submenu container */
#main-menu li ul {
    display: none; /* hidden by default */
    list-style: none;
    padding: 0;
    margin: 0;
    background-color: #567083; /* submenu background slightly darker */
}

/* Submenu items */
#main-menu li ul li {
    border-bottom: 1px solid rgba(0,0,0,0.2);
}

/* Submenu links */
#main-menu li ul li a {
    padding: 10px 30px; /* indented */
    color: #f5f5f5;
    font-size: 14px;
}

/* Hover effect for submenu links */
#main-menu li ul li a:hover {
    background-color: #4b6170; /* darker for hover */
    color: #ffffff;
}

/* Active state */
#main-menu li.active > a,
#main-menu li ul li.active > a {
    background-color: #455a66;
    color: #ffffff;
}
</style>
<div>
<ul id="main-menu" class="" >
			
    <li id="dash"><a href="index.php"><i class="entypo-gauge"></i><span>Dashboard</span></a></li>
                
	<li id="regis"><a href="new_entry.php"><i class="entypo-user-add"></i><span>New Registration</span></a>                
				
	<li id="paymnt"><a href="payments.php"><i class="entypo-star"></i><span>Payments</span></a></li>

	<li class="" id="hassubopen"><a href="#" onclick="memberExpand(1)"><i class="entypo-users"></i><span>Members</span></a>
		<ul id="memExpand">
			<li class="active">
				<a href="view_mem.php"><span>Edit Members</span></a></li>

			<li><a href="table_view.php"><span>View Memeber</span></a></li>
		</ul>
	</li>

	<li id="health_status"><a href="new_health_status.php"><i class="entypo-user-add"></i><span>Health Status</span></a> 	

		<li class="" id="planhassubopen"><a href="#" onclick="memberExpand(2)"><i class="entypo-quote"></i><span>Sports Plan</span></a>

		<ul id="planExpand">
			<li class="active">
				<a href="new_plan.php"><span>New Sports Plan</span></a></li>

			<li><a href="view_plan.php"><span>Edit Subsciption Details</span></a></li>
		</ul>

	<li class="" id="overviewhassubopen"><a href="#" onclick="memberExpand(3)"><i class="entypo-box"></i><span>Overview</span></a>

		<ul id="overviewExpand">
			<li class="active">
				<a href="over_members_month.php"><span>Members per Month</span></a>
			</li>

			<li>
				<a href="over_members_year.php"><span>Members per Year</span></a>
			</li>

			<li>
				<a href="revenue_month.php"><span>Income per Month</span></a>
			</li>			

		</ul>

	<li class="" id="routinehassubopen"><a href="#" onclick="memberExpand(4)"><i class="entypo-alert"></i><span>Sports Routine</span></a>

		<ul id="routineExpand">
			<li class="active">
				<a href="addroutine.php"><span>Add Sports Routine</span></a>
			</li>

			<li>
				<a href="editroutine.php"><span>Edit Sports Routine</span></a>
			</li>

			<li>
				<a href="viewroutine.php"><span>View Sports Routine</span></a>
			</li>

		</ul>

	</li>

	<li id="adminprofile"><a href="more-userprofile.php"><i class="entypo-folder"></i><span>Profile</span></a></li>

	<li><a href="logout.php"><i class="entypo-logout"></i><span>Logout</span></a></li>

</ul>	
</div>