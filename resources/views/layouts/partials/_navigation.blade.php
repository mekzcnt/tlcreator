<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <strong><a class="navbar-brand" href="/">Timeline Creator</a></strong>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <!-- <form class="navbar-form navbar-right">
        <div class="form-group">
          <input type="text" placeholder="Email" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" placeholder="Password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Sign in</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/about') }}">About</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
        @else
            <li><a href="{{ route('auth.timeline.create') }}"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Create Timeline</button></a></li>
            <li><a href="{{ url('/feed') }}">Timeline Feed</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('/', Auth::user()->username) }}"><i class="fa fa-user fa-fw"></i> My Timeline</a></li>
                    <li><a href="{{ url('/profile/edit/') }}"><i class="fa fa-gear fa-fw"></i> Edit Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                </ul>
            </li>
        @endif
      </ul>
    </div><!--/.navbar-collapse -->
  </div>
</nav>
