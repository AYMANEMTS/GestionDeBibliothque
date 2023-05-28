<!-- Show reset form -->
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div>
        <label for="email">Email Address</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>
    <button type="submit">Send Reset Link</button>
</form>
