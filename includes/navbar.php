<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<header>
	<div class="header-bottom">
		<div class="header-main-bar">
			<div class="header-logo">
				<a href="/vision_exim/index.php" class="logo-wrapper">
					<img src="images/certificates/vision logo color (1).png" alt="Vision Exim Logo" style="height: 45px; width: auto;">
				</a>
			</div>
			<nav class="header-navbar">
				<div class="navbar-toggle-close navbar-toggle">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<ul>
					<li class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
						<a href="/vision_exim/index.php">Home</a>
					</li>
					<li class="<?php echo ($current_page == 'about-us.php') ? 'active' : ''; ?>">
						<a href="/vision_exim/about-us.php">About Us</a>
					</li>
					<li class='dropdown <?php echo ($current_page == 'our-products.php') ? 'active' : ''; ?>'>
						<a href="/vision_exim/our-products.php">Our Products
							<svg width="8" height="6" viewBox="0 0 8 6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 1.5L4 4.5L7 1.5" stroke="currentColor" stroke-width="1.4"
									stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</a>
						<span class="sub-menu-toggle"></span>
						<ul class="sub-menu">
							<li><a href="/vision_exim/pure-ground-spices.php">Spices (Whole & Blended)</a></li>
							<li><a href="/vision_exim/pure-ground-spices.php">Pulses</a></li>
							<li><a href="/vision_exim/pure-ground-spices.php">Grains</a></li>
						</ul>
					</li>
					<li class="<?php echo ($current_page == 'harvest-chart.php') ? 'active' : ''; ?>">
						<a href="/vision_exim/harvest-chart.php">Harvest Chart</a>
					</li>


				</ul>
			</nav>

			<div class="contact_wrp d-flex align-items-center">

				<a href="/vision_exim/contact-us.php" class="btn">Contact Us</a>
			</div>

			<div class="navbar-toggle">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<div class="header-menu-overlay"></div>
</header>