<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistem Perpustakaan</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #435ebe;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
        }
        
        .auth-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 420px;
            width: 100%;
        }
        
        .auth-header {
            background: linear-gradient(135deg, #435ebe, #56ccf2);
            color: #fff;
            padding: 30px;
            text-align: center;
        }
        
        .auth-header h2 {
            margin: 0;
            font-weight: 700;
        }
        
        .auth-header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }
        
        .auth-body {
            padding: 30px;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #eee;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 94, 190, 0.15);
        }
        
        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background: #364fc7;
        }
        
        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #eee;
            border-right: none;
            border-radius: 10px 0 0 10px;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
    </style>
</head>
<body>
    @yield('content')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
