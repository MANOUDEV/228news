@include('includes.off_canvas')
<!-- =======================Header START -->
<header class="navbar-light navbar-sticky header-static bg-light">
	<nav class="navbar navbar-expand-xl">
		<div class="container-fluid">
			<div class="w-100  d-flex">
				<!-- Logo START -->
				<a class="navbar-brand" href="/">
					<img class="navbar-brand-item light-mode-item" src="/assets/images/logo.svg" alt="logo">			
					<img class="navbar-brand-item dark-mode-item" src="/assets/images/logo-light.svg" alt="logo">			
				</a>
				<!-- Logo END -->

				<!-- Responsive navbar toggler -->
				<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="text-body h6 d-none d-sm-inline-block">Menu</span>
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Main navbar START -->
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<!-- Nav Search START -->
					<div class="nav mt-3 mt-lg-0 px-4 flex-nowrap align-items-center">
						<div class="nav-item w-100">
							<form class="rounded position-relative" action="/search-posts" method="GET">
								<input class="form-control pe-5 bg-light" name="query" type="search" placeholder="Recherche...." aria-label="Search">
								<button class="btn bg-transparent border-0 px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="bi bi-search fs-5"> </i></button>
							</form>
						</div>
					</div>
					<!-- Nav Search END -->
					<ul class="navbar-nav navbar-nav-scroll ms-auto">
						
						<li class="nav-item dropdown dropdown-fullwidth">
							<a class="nav-link dropdown-toggle" href="#" style="font-size: 13px" id="pagesMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Politique</a>
							<ul class="dropdown-menu" aria-labelledby="pagesMenu">
								<politique-header></politique-header>
							</ul>
						</li>

						<li class="nav-item dropdown dropdown-fullwidth">
							<a class="nav-link dropdown-toggle" href="#" style="font-size: 13px" id="pagesMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Afrique</a>
							<ul class="dropdown-menu" aria-labelledby="pagesMenu">
								<afrique-header></afrique-header>
							</ul>
						</li>
						<li class="nav-item dropdown dropdown-fullwidth">
                            <a class="nav-link  dropdown-toggle" href="#" style="font-size: 13px" id="megaMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Société</a>
                            <div class="dropdown-menu" aria-labelledby="megaMenu">
                                <societe-header></societe-header> 
                            </div>
                        </li>
						<li class="nav-item dropdown dropdown-fullwidth">
                            <a class="nav-link  dropdown-toggle" href="#" style="font-size: 13px" id="megaMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sports</a>
                            <div class="dropdown-menu" aria-labelledby="megaMenu">
                                <sports-header></sports-header> 
                            </div>
                        </li>
						<!-- Nav item 3 Post -->
                        <li class="nav-item dropdown dropdown-fullwidth">
                            <a class="nav-link  dropdown-toggle" href="#" style="font-size: 13px" id="megaMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chroniques</a>
                            <div class="dropdown-menu" aria-labelledby="megaMenu">
                                <div>
                                    <chroniques-header></chroniques-header>
                                </div>
                            </div>
                        </li>

						<!-- Nav item 3 Post -->
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" style="font-size: 13px" href="#"  id="megaMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rubriques+</a>
                           
							<ul class="dropdown-menu" aria-labelledby="homeMenu">
								
								<rubriques-header></rubriques-header>
							</ul> 
                        </li>
					</ul>
				</div>
				<div class="nav ms-sm-3 flex-nowrap align-items-center">
					<!-- Dark mode switch -->
					<div class="nav-item">
						<div class="modeswitch" id="darkModeSwitch">
							<div class="switch"></div>
						</div>
					</div>
					<div class="nav-item ms-2 ms-md-3 dropdown">
						<!-- Notification button -->
						<in-second-menu></in-second-menu>
					</div>
					 <!-- Offcanvas menu toggler -->
                    <div class="nav-item">
                        <a style="font-size: 12px" class="nav-link  pe-0" data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                            <i class="bi bi-text-right rtl-flip fs-2" data-bs-target="#offcanvasMenu"> </i>
                        </a>
                    </div>
				</div>
				
			</div>
		</div>
	</nav>
</header>