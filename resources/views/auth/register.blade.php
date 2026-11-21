<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <style>
        body { font: 16px system-ui, sans-serif; max-width: 520px; margin: 48px auto; padding: 0 20px; color: #172033; }
        label { display: block; margin-top: 16px; }
        input { box-sizing: border-box; width: 100%; padding: 10px; margin-top: 5px; }
        button { margin-top: 20px; padding: 10px 16px; cursor: pointer; }
        .error { color: #b42318; }
    </style>
</head>
<body>
    <h1>Create an account</h1>
    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    @endif
    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <label>Name <input name="name" value="{{ old('name') }}" required></label>
        <label>Email <input type="email" name="email" value="{{ old('email') }}" required></label>
        <label>Phone <input name="phone" value="{{ old('phone') }}" required></label>
        <label>Password <input type="password" name="password" required></label>
        <label>Confirm password <input type="password" name="password_confirmation" required></label>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="{{ route('login') }}">Log in</a></p>
</body>
</html>
