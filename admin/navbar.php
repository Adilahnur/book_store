
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		/*background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important*/
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark' >
	
		<div class="sidebar-list">
			<center><img src="bb.png"  style="width:110px"></center>
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span> Dashboard</a>
				<a href="index.php?page=orders" class="nav-item nav-orders"><span class='icon-field'><i class="fa fa-clipboard-list"></i></span> Orders</a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<div class="mx-2 text-white">Master List</div>
				<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-list-alt "></i></span> Categories</a>
				<a href="index.php?page=books" class="nav-item nav-books"><span class='icon-field'><i class="fa fa-book "></i></span> Books</a>
				<a href="index.php?page=stationery_edit" class="nav-item nav-books"><span class='icon-field'><i class="fa fa-pen "></i></span> Stationery</a>
				<?php endif; ?>
				<div class="mx-2 text-white">Report</div>
				<a href="index.php?page=sales_report" class="nav-item nav-sales_report"><span class='icon-field'><i class="fa fa-th-list"></i></span> Sales Report</a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<div class="mx-2 text-white">Systems</div>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users "></i></span> Users</a>
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs"></i>
				</span> System Settings</a>
				<a href="" class="nav-item nav-"><span class='icon-field'><i class="fa fa-circle"></i>
				</span> Live</a>
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
