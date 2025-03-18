<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title>Dashboard</title>

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
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">






	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258" crossorigin="anonymous"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag("js", new Date());

		gtag("config", "G-GBZ3SGGX85");
	</script>
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				"gtm.start": new Date().getTime(),
				event: "gtm.js"
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != "dataLayer" ? "&l=" + l : "";
			j.async = true;
			j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
	</script>
	<!-- End Google Tag Manager -->
</head>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo">
				<img src="/1.jpg" alt="" />
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
			<div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>

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
								<a class="dropdown-item" href="/about us/about us.html"><i class="dw dw-help"></i> About us</a>
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
				<img src="/Mini.png" alt="" class="dark-logo" />
				<img src="/Mini.png" alt="" class="light-logo" />
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">

					<li>
						<a href="index.html" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-calendar4-week"></span><span class="mtext">Home</span>
						</a>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-joystick"></span>

							<span class="mtext">Play Area</span>
						</a>
						<ul class="submenu">
							<li><a href="/the-memory-games/dist/index.html">Games</a></li>
							<li><a href="/jigsaw-puzzle/dist/index.html">Puzzles</a></li>
							<li><a href="/hangman-game/dist/index.html">Riddles</a></li>
							
							<li><a href="/quiz/dist/index.html">Quizes</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-table"></span><span class="mtext">_____ of the day</span>
						</a>
						<ul class="submenu">
							<li><a href="/random-thought-generator/dist/index.html">Thought</a></li>
							
							<li><a href="/random-facts-generator/dist/index.html">Fact</a></li>
							<li><a href="/random-joke-generator/dist/index.html">Joke</a></li>
						</ul>
					</li>
					<li>
						<a href="/evo-calendar-master/index.html" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-calendar4-week"></span><span class="mtext">Calendar</span>
						</a>
					</li>
					<li>
						<a href="/image-dropzone.php" class="dropdown-toggle no-arrow">
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
						<a href="/source code or html files/index.html" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-stars"></span>
							<span class="mtext">Indian Festivals</span>
						</a>
					</li>
					<li>
						<a href="solar-system/dist/index.html" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-binoculars-fill"></span>


							<span class="mtext">Solar-system</span>
						</a>
					</li>
					<li>
						<a href="/Weather/index.html" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-cloud-sun-fill"></span>
							<span class="mtext">Seasonal Themes</span>
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

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Introduction</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="index.php">Home</a>
									</li>

									<li class="breadcrumb-item active" aria-current="page">
										Introduction
									</li>
								</ol>
							</nav>
						</div>

					</div>
				</div>
				<div class="pd-20 card-box mb-30">
					<h4 class="h4 text-blue mb-10">Welcome TinyThinker!</h4>
					<p>
						TinyThinkers is a magical place filled with adventures and learning for children. Our website is designed especially for kids, offering a world of fun and education.
					</p>
					<p>
						At TinyThinkers, we bring smiles to young faces and ignite their imagination with interactive games, captivating stories, and exciting puzzles. Our website is designed to be child-friendly and safe, providing hours of entertainment and knowledge.
					</p>
				</div>
				<div class="pd-20 card-box mb-30">
					<h4 class="h4 text-blue mb-10">Explore and Learn</h4>
					<p>
						Dive into our world of creativity and exploration! Kids can explore a variety of content, from educational games to fascinating stories.
					</p>
					<p>
						Parents, you can trust us to provide a safe and enriching online environment for your little ones. TinyThinkers is committed to creating a positive online experience for children.
					</p>
					<p>
						Join us on this exciting journey, and watch your child's imagination soar!
					</p>
				</div>

				<div class="pd-20 card-box mb-30">
					<h4 class="h4 text-blue mb-10">Get Help and Share Ideas</h4>
					<p>
						Welcome to our Support Center! Kids, we're here to help you explore and have fun on our website.
					</p>
					<p>
						If you have any questions about our games, stories, or anything else, feel free to ask. We love hearing from you!
					</p>
					<p>
						Also, if you have cool ideas for new games or features, share them with us. We're always excited to make your experience even better.
					</p>
					<p>
						And remember, if you find any glitches or have suggestions to make KidzFun World more awesome, feel free to
						<a href="mailto:support@kidzfunworld.com" class="text-primary">contact us</a>.
					</p>
				</div>

				<h4 class="h4 text-blue mb-10">Note</h4>
				<div class="pd-20 card-box mb-30" data-bgcolor="#ff4747" data-color="#fdfdfd">
					<ul>
						<li class="d-flex pb-20">
							<i class="dw dw-edit-file font-20 mr-2"></i> We always prioritize the safety and privacy of your children. Our website is designed with their best interests in mind.
						</li>
						<li class="d-flex pb-20">
							<i class="dw dw-edit-file font-20 mr-2"></i> Any use of names, brands, or logos on our site is solely for educational and entertainment purposes. No personal information is collected.
						</li>
						<li class="d-flex pb-20">
							<i class="dw dw-edit-file font-20 mr-2"></i> Rest assured that we do not utilize any third-party tools or plugins that may compromise your child's online safety.
						</li>
						</li>
						<li class="d-flex pb-20">
							<i class="dw dw-edit-file font-20 mr-2"></i>Respect the age recommendations for each section of our website to ensure age-appropriate content.

						</li>
						<li class="d-flex pb-20">
							<i class="dw dw-edit-file font-20 mr-2"></i>Please read and adhere to our usage guidelines to ensure a safe and enjoyable experience for your child.

						</li>
					</ul>
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
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard3.js"></script>

</body>

</html>