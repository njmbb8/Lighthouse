<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<div class="container">
		<a class="navbar-brand" href="/">
			<img src="/images/logo.png" style="width:60px;">Lighthouse of Learning
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		</button>
	    <div class="collapse navbar-collapse" id="navbarResponsive">
	      <ul class="navbar-nav ml-auto">
	        <li class="nav-item {{Route::is('home') ? 'active' : ''}}">
	          <a class="nav-link" href="/">Home</a>
	        </li>
	        <li class="nav-item {{Route::is('about') ? 'active' : ''}}">
	          <a class="nav-link" href="#about">About Us</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#staff">Staff</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#contact">Contact Us</a>
	        </li>
	        <li class="nav-item">
	        	<a class="nav-link {{Route::is('events') ? 'active' : ''}}" href="/events">Events</a>
	        </li>
	        <li class="nav-item">
	        	<a class="nav-link" href="forms.html">Forms</a>
	        </li>
			@if(Auth::guest())
				<li class="nav-item">
					<a class="nav-link" href="/login">Log In</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/register">Register<a>
				</li>
			@else
				<li class="nav-item">
					<a class="nav-link" href="/account">Account</a>
				</li>
			@endif
	      </ul>
	    </div>
	</div>
</nav>