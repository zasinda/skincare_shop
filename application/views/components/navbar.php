<body>
	<div class="search-form" id="search-form">
		<form action="">
			<input type="search" class="form-control" placeholder="What are you looking for?">
			<button class="button">
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
					<path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
				</svg>
			</button>
			<button class="button">
				<div class="close-search">
					<span class="icofont-close js-close-search"></span>
				</div>
			</button>

		</form>
	</div>

	<div class="site-mobile-menu">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>



	<nav class="site-nav mb-5">
    <div class="sticky-nav js-sticky-header">
        <div class="container position-relative">
            <div class="site-navigation text-center dark">
                <a href="index.html" class="logo menu-absolute m-0"><img src="<?php echo base_url('uploads/logo.PNG'); ?>" width="30" height="40" viewbox="0 0 24 24"> Reine Haut<span class="text-primary">.</span></a>

                <ul class="js-clone-nav pl-0 d-none d-lg-inline-block site-menu">
                    <li class="active"><a href="<?php echo base_url('/landingpage') ?>">Home</a></li>
                    <li><a href="shop.html">About</a></li>
                    <li class="has-children">
                        <a href="<?php echo base_url('/store') ?>">Shop</a>
                        <ul class="dropdown">
                            <li><a href="<?php echo base_url('/store') ?>">All products</a></li>
                            <li><a href="<?php echo base_url('kategori/sunscreen') ?>">Sunscreen</a></li>
                            <li><a href="<?php echo base_url('kategori/mask') ?>">Mask</a></li>
                            <li><a href="<?php echo base_url('kategori/moisturizer') ?>">Moisturizer</a></li>
                            <li><a href="<?php echo base_url('kategori/facewash') ?>">Facewash</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url('/articles') ?>">Blog</a></li>
					<li><a href="<?php echo base_url('/chatbot') ?>">ChatBot</a></li>
                </ul>

				<script>
					document.addEventListener('DOMContentLoaded', function() {
						var currentUrl = window.location.href;
						var menuItems = document.querySelectorAll('.js-clone-nav li a');

						menuItems.forEach(function(item) {
							if (item.href === currentUrl) {
								item.parentElement.classList.add('active');
							} else {
								item.parentElement.classList.remove('active');
							}
						});
					});
				</script>

                <div class="menu-icons" style="position: absolute; top: 0; right: 0; display: flex; align-items: center;">
					<a href="#" class="btn-custom-search" id="btn-search" style="margin-right: 20px; color: #000000; font-size: 16px;">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
							<path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
						</svg>
					</a>

					<?php if ($this->session->userdata('user_logged_in')) : ?>
						<div class="dropdown" style="margin-right: 20px;">
							<a href="#" class="user-profile dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: flex; align-items: center; margin-right: -5px;">
								<img src="<?php echo base_url('uploads/tom.webp'); ?>" alt="User Image" class="rounded-circle" width="40" height="40">
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="<?php echo site_url('account/settings'); ?>">Settings</a>
								<a class="dropdown-item" href="<?php echo site_url('auth/logout'); ?>">Logout</a>
							</div>
						</div>
					<?php else : ?>
						<a href="<?php echo site_url('auth/login'); ?>" class="user-profile" style="margin-right: 20px; display: flex; align-items: center;">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
							</svg>
						</a>
					<?php endif; ?>

					<?php
					$cart = $this->session->userdata('cart');
						$total_items = 0;
						if (!empty($cart)) {
							foreach ($cart as $item) {
								$total_items += $item['qty'];
							}
						}
						?>
						<a href="<?php echo site_url('store/detail_cart') ?>" class="cart" style="color: #000000; font-size: 20px; position: relative;">
							<span class="item-in-cart" style="position: absolute; top: -8px; right: -8px; background-color: #000; color: #fff; width: 18px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 10px; line-height: 1;"><?php echo $total_items; ?></span>
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
							</svg>
						</a>
				</div>


                <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
                    <span></span>
                </a>

            </div>
        </div>
    </div>
</nav>