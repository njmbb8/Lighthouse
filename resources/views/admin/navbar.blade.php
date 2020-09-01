<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
	<div class="container">
		<a class="navbar-brand" href="#">
			<img src="/images/logo.png" style="width:60px;">Lighthouse of Learning
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		</button>
	    <div class="collapse navbar-collapse" id="navbarResponsive">
	      <ul class="navbar-nav ml-auto">
	        <li class="nav-item active">
	          <a class="nav-link" href="/">Dashboard
	                <span class="sr-only">(current)</span>
	              </a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link {{Route::is('events') ? 'active' : ''}}" href="/events">Events</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link {{Route::is('userss') ? 'active' : ''}}" href="/users">Users</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link {{Route::is('announcements') ? 'active' : ''}}" href="/announcements">Announcements</a>
	        </li>
	        <li class="nav-item">
	        	<a class="nav-link {{Route::is('videos') ? 'active' : ''}}" href="/videos">Videos</a>
	        </li>
	        <li class="nav-item">
	        	<a class="nav-link {{Route::is('forms') ? 'active' : ''}}" href="/forms">Forms</a>
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
						<p>Hello, {{Auth::user()->fname}} </p>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/logout">Log Out</a>
				</li>
			@endif
	      </ul>
	    </div>
	</div>
</nav>