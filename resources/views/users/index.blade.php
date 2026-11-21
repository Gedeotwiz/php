<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>
    <style>
        body { font: 16px system-ui, sans-serif; max-width: 860px; margin: 48px auto; padding: 0 20px; color: #172033; }
        table { width: 100%; border-collapse: collapse; margin-top: 24px; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #ddd; }
        button { padding: 8px 12px; cursor: pointer; }
        header { display: flex; justify-content: space-between; align-items: center; }
    </style>
</head>
<body>
    <header>
        <h1>Users</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Log out</button>
        </form>
    </header>
    <p>Welcome, {{ auth()->user()->name }}. Here are the registered users.</p>
    @if ($users->isEmpty())
        <p>No users have registered yet.</p>
    @else
        <table>
            <thead><tr><th>Name</th><th>Email</th><th>Phone</th></tr></thead>
            <tbody>
                @foreach ($users as $user)
                    <tr><td>{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->phone }}</td></tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
