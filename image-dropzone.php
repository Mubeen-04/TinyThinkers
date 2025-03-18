<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title>Dropzone</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css" />
	<link rel="stylesheet" type="text/css" href="src/plugins/dropzone/src/dropzone.css" />
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
	<style>
		.form-group {
			margin-bottom: 20px;
		}

		.form-group label {
			display: inline-block;
			width: 100px;
			/* Adjust as needed */
			font-weight: bold;
		}

		.form-group input[type="email"] {
			width: 420px;
			/* Adjust as needed */
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 5px;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
			transition: border-color 0.3s ease;
		}

		.form-group input[type="email"]:focus {
			border-color: #5b9bd5;
			/* Change border color on focus */
			outline: none;
			/* Remove default focus outline */
		}

		#uploadButton {
			display: block;
			margin: 20px auto;
			/* Center the button and add margin */
			padding: 10px 20px;
			/* Add padding */
		}
	</style>






</head>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo">
				<img src="/C-removebg-preview.png" alt="" />
			</div>
			<div class="loader-progress" id="progress_div">
				<div class="bar" id="bar1"></div>
			</div>
			<div class="percent" id="percent1">0%</div>
			<div class="loading-text">Loading...</div>
		</div>
	</div>

	<div class="header">
		<div class="header-left">
			<div class="menu-icon bi bi-list"></div>


		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>

			<div class="user-info-dropdown">
				<style>
					.dropdown2 {
						position: relative;
						display: inline-block;
					}

					.dropdown-toggle {
						margin-top: 10px;
						/* Add margin to the top to lower the button */
					}

					.dropdown-menu {
						display: none;
						position: absolute;
						right: 0;
						background-color: #fff;
						min-width: 160px;
						box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
						z-index: 1;
					}

					.dropdown:hover .dropdown-menu {
						display: block;
					}

					.dropdown-item {
						padding: 10px;
						text-decoration: none;
						color: #333;
						display: block;
					}

					.dropdown-item:hover {
						background-color: #f2f2f2;
					}

					.user-name {
						font-weight: bold;
						margin-top: 2px;
						display: block;
						text-align: right;
						/* Align the text to the right */
						/* padding-top: 10px; */
						/* Add some padding to create space between the text and the right corner */
					}
				</style>

				<div class="dropdown2">
					<?php
					include 'database.php';
					session_start(); // Start the session if not already started

					// Assuming you have a session variable storing the user's email after login
					if (isset($_SESSION['email'])) {
						$userEmail = $_SESSION['email'];

						// Fetch user data based on the user's email
						$sel = "SELECT * FROM users WHERE email = '$userEmail'";
						$query = mysqli_query($conn, $sel);
						$user = mysqli_fetch_assoc($query);

						if ($user) {
					?>
							<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								<span class="user-name"><?php echo $user['full_name']; ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href=""><i class="dw dw-user1"></i> Profile</a>
								<a class="dropdown-item" href=""><i class="dw dw-help"></i> Help</a>
								<a class="dropdown-item" href="/contactus/contact.php"><i class="bi bi-envelope"></i> Contact us</a>
								<a class="dropdown-item" href="/logout.php"><i class="dw dw-logout"></i> Log Out</a>
							</div>
					<?php
						}
					}
					?>
				</div>

			</div>
		</div>

	</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="" />
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2" />
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3" />
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="" />
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2" />
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3" />
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="" />
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5" />
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6" />
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">
						Reset Settings
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.html">
				<img src="/C-removebg-preview.png" alt="" class="dark-logo" />
				<img src="/C-removebg-preview.png" alt="" class="light-logo" />
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">

					<li>
						<a href="index.php" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-calendar4-week"></span><span class="mtext">Home</span>
						</a>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle ">
							<span class="micon bi bi-joystick"></span>

							<span class="mtext">Play Area</span>
						</a>
						<ul class="submenu">
							<li><a href="">Games</a></li>
							<li><a href="">Puzzles</a></li>
							<li><a href="">Riddles</a></li>
							<li><a href="">Quests</a></li>
							<li><a href="">Quizes</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle ">
							<span class="micon bi bi-table"></span><span class="mtext">_____ of the day</span>
						</a>
						<ul class="submenu">
							<li><a href="">Thought</a></li>
							<li><a href="">Fact</a></li>
							<li><a href="">Riddle</a></li>
							<li><a href="">Joke</a></li>
						</ul>
					</li>
					<li>
						<a href="calendar.html" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-calendar4-week"></span><span class="mtext">Calendar</span>
						</a>
					</li>
					<li>
						<a href="image-dropzone.html" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-calendar4-week"></span><span class="mtext">Dropzone</span>
						</a>
					</li>
					<li>
						<a href="" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-volume-up"></span>
							<span class="mtext">Music</span>
						</a>
					</li>
					<li>
						<a href="" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-camera-reels"></span>
							<span class="mtext">Cartoon</span>
						</a>
					</li>
					<li>
						<a href="solar-system/dist/index.html" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-binoculars-fill"></span>


							<span class="mtext">Solar-system</span>
						</a>
					</li>
					<li>
						<a href="" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-cloud-sun-fill"></span>
							<span class="mtext">Seasonal Themes</span>
						</a>
					</li>
					<li>
						<a href="" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-cup-straw"></span>

							<span class="mtext">Fireless Cooking</span>
						</a>
					</li>
					<li>
						<a href="" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-people-fill"></span>

							<span class="mtext">Parent's Corner</span>
						</a>
					</li>
					<li>
						<a href="" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-globe"></span>

							<span class="mtext">Global Discoveries</span>
						</a>
					</li>




					<li>
						<a href="sitemap.html" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-diagram-3"></span><span class="mtext">Sitemap</span>
						</a>
					</li>

				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Image Dropzone</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="index.html">Home</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">
										Image Dropzone
									</li>
								</ol>
							</nav>
						</div>

					</div>
				</div>



				<div class="pd-20 card-box mb-30">
					<div class="clearfix mb-20">
						<div class="pull-left">
							<h4 class="text-blue h4">Dropzone</h4>
						</div>
					</div>
					<form action="upload.php" method="post" enctype="multipart/form-data">
						<!-- Input field for user's email -->
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" name="email" id="email" required>
						</div>

						<div class="form-group">
							Select image to upload:
							<input type="file" name="image" id="image">
						</div>

						<button type="submit" id="uploadButton" class="btn btn-primary">Upload Files</button>
					</form>
				</div>

			</div>





		</div>

		<div class="footer-wrap pd-20 mb-20 card-box">
			&copy;All Rights Reserved

		</div>

	</div>
	</div>



	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/dropzone/src/dropzone.js"></script>



</body>

</html>