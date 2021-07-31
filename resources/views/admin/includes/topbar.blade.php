<header class="topbar">
	<nav class="navbar top-navbar navbar-expand-md navbar-light">
		<!-- ============================================================== -->
		<!-- Logo -->
		<!-- ============================================================== -->
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ url('/company') }}">
				<b>
					<!-- Dark Logo icon >
					<img src="{{ asset('public/assets/admin/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
					 Light Logo icon -->
					<img src="{{ asset('public/assets/admin/images/logo-light-text.png') }}" alt="homepage" class="light-logo" style="width: 190px;" />
				</b>
				<!--End Logo icon -->
				<!-- Logo text -->
				<span>
					<!-- dark Logo text -->
					<img src="{{ asset('public/assets/admin/images/logo_new.png') }}" alt="homepage" class="dark-logo" style="width: 190px;" />
					<!-- Light Logo text -->
					<img src="{{ asset('public/assets/admin/images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
				</span>
			</a>
		</div>
		<!-- ============================================================== -->
		<!-- End Logo -->
		<!-- ============================================================== -->
		<div class="navbar-collapse">
			<!-- ============================================================== -->
			<!-- toggle and nav items -->
			<!-- ============================================================== -->
			<ul class="navbar-nav mr-auto mt-md-0">
				<!-- This is  -->

				<!-- ============================================================== -->
				<!-- End Messages -->
				<!-- ============================================================== -->
			</ul>
			<!-- ============================================================== -->
			<!-- User profile and search -->
			<!-- ============================================================== -->
			<ul class="navbar-nav my-lg-0">
				<!-- ============================================================== -->
				<!-- Search -->
				<!-- ============================================================== -->

				<!-- ============================================================== -->
				<!-- Language -->
				<!-- ============================================================== -->
				<li class="nav-item dropdown">
					<!--a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
						<i class="flag-icon flag-icon-us"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right scale-up"> 
						<a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a>
						<a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a>
						<a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> 
						<a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> 
					</div-->
				</li>
				<!-- ============================================================== -->
				<!-- Profile -->
				<!-- ============================================================== -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="{{ asset('public/assets/admin/images/users/profile-photo.jpg') }}" alt="user" class="profile-pic" />
					</a>
					<div class="dropdown-menu dropdown-menu-right scale-up">
						<ul class="dropdown-user">
							<li>
								<div class="dw-user-box">
									<div class="u-img"><img src="{{ asset('public/assets/admin/images/users/profile-photo.jpg') }}" alt="user"></div>
									<div class="u-text">
										<h4>{{ Auth::user()->name  }}</h4>
										<p class="text-muted">{{ Auth::user()->email  }}</p><a href="{{ url('company/profile') }}" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
									</div>
								</div>
							</li>
							<li role="separator" class="divider"></li>
							<li role="separator" class="divider"></li>
							
							<li role="separator" class="divider"></li>
							<li>
								<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
									<i class="fa fa-power-off"></i> Logout
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>

							</li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</nav>
</header>