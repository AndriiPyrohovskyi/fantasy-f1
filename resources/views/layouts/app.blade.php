<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Fantasy F1' }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        nav { background: #e10600; padding: 10px; margin-bottom: 20px; }
        nav a { color: white; text-decoration: none; margin-right: 15px; }
        .card { border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .driver { background: #f8f9fa; }
        .team { background: #e3f2fd; }
    </style>
</head>
<body>
    <nav>
        <a href="/">Home</a>
        <a href="/dashboard?mode=debug">Dashboard</a>
        <a href="/drivers?mode=debug">Drivers</a>
        <a href="/teams?mode=debug">Teams</a>
        <a href="/leaderboard?mode=debug">Leaderboard</a>
    </nav>

    <h1>{{ $title ?? 'Fantasy F1' }}</h1>

    @yield('content')
</body>
</html>
