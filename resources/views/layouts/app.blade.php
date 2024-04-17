<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Task')</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <link rel="stylesheet" href="{{ asset('css/app.css') }}">
     <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <p class="navbar-brand" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">NAVBAR</p>
        <div class="container">
            <a class="navbar-brand" style="background-color:#d8cae8; padding:3px; border-radius:5px;" href="#"><b>LOGO</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('companies.index') }}">Companies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     @stack('scripts')
</body>
</html>
