<h1>Welcome {{ $user->username }}</h1>

{{ $user->email }}
<br>
<br>
<br>
<a href="{{ route('logout') }}">Logout</a>
