<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Dashboard Container */
        .container {
            margin-top: 50px;
        }

        /* Card Style */
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
        }

        /* Card Header */
        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            text-align: center;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        /* Card Body */
        .card-body {
            padding: 30px;
            background-color: #f9f9f9;
        }

        /* Alert Box */
        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        /* Success Alert */
        .alert-success {
            background-color: #28a745;
            color: white;
            border: none;
        }

        /* Button Style */
        .btn {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            color: white;
            padding: 10px 20px;
            text-transform: uppercase;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Text Customization */
        .card-body p {
            font-size: 1.1rem;
            color: #333;
        }
    </style>
</head>
<body>

<!-- Content Section -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Helloo') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Kamu telah berhasil login!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional if you need interactive components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
