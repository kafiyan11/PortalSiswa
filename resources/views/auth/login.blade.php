<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/app.css" rel="stylesheet"> <!-- Update the path if necessary -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @extends('layouts.app')
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            @if(session('error'))
            <script>
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Login gagal !",
                });
            </script>
            @endif
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-lg rounded-lg">
                    <div class="card-header text-center bg-secondary text-white rounded-top">
                        <h3 class="my-3">Login</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="/login"> <!-- Update the action URL if necessary -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- NIS -->
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input id="nis" type="text" class="form-control" name="nis" required autofocus>
                                <!-- Error handling -->
                                {{-- <span class="invalid-feedback d-block" role="alert" style="display: none;">
                                    <strong>Error message here</strong>
                                </span> --}}
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                <!-- Error handling -->
                            </div>
                            <!-- Submit Button -->
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
