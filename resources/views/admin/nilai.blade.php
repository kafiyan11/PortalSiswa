<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Nilai</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            position: relative;
            padding: 20px;
            width: 100%;
            max-width: 800px;
        }

        .header {
            background-color: #808080;
            color: white;
            padding: 15px;
            font-size: 1.5em;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 15px 15px 0 0;
        }

        .navbar-toggler-icon {
            width: 30px;
            height: 30px;
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"%3E%3Cpath stroke="white" stroke-width="3" d="M5 7h20M5 15h20M5 23h20" /%3E%3C/svg%3E');
            background-size: 30px 30px;
            background-repeat: no-repeat;
            border: none;
            background-color: transparent;
            cursor: pointer;
        }

        .table-container {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: center;
            padding: 15px;
            
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        th {
            background-color: #e0e0e0;
            font-weight: bold;
            font-size: 1.2em;
            border-top: 2px solid #ccc;
            border-bottom: 2px solid #ccc;
        }

        td {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            cursor: pointer;
        }

        td:hover {
            transform: scale(1.1);
        }

        .highlighted {
            background-color: #d0d0d0 !important;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                font-size: 1.2em;
            }

            .navbar-toggler {
                margin-bottom: 10px;
            }

            .table-container {
                padding: 10px;
            }

            table {
                border-spacing: 5px;
            }

            th, td {
                font-size: 0.9em;
                padding: 10px;
            }
        }

        @media (max-width: 576px) {
            .header {
                font-size: 1em;
            }

            .table-container {
                padding: 5px;
            }

            table {
                border-spacing: 2px;
            }

            th, td {
                font-size: 0.8em;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.app')

    <a href="{{ route('scores.create') }}" class="btn btn-primary">Tambah User</a>


    <div class="container">
        <div class="header">
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="title">Nilai</span>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>PR</th>
                        <th>UH</th>
                        <th>UTS</th>
                        <th>UAS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>80</td>
                        <td>85</td>
                        <td>90</td>
                        <td>85</td>
                    </tr>
                    <tr>
                        <td>75</td>
                        <td>80</td>
                        <td>85</td>
                        <td>80</td>
                    </tr>
                    <tr>
                        <td>88</td>
                        <td>90</td>
                        <td>92</td>
                        <td>90</td>
                    </tr>
                    <tr>
                        <td>95</td>
                        <td>94</td>
                        <td>96</td>
                        <td>90</td>
                    </tr>
                    <tr>
                        <td>70</td>
                        <td>75</td>
                        <td>78</td>
                        <td>80</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.querySelectorAll('td').forEach(function(cell) {
            cell.addEventListener('click', function() {
                document.querySelectorAll('td').forEach(function(cell) {
                    cell.classList.remove('highlighted');
                });

                cell.classList.add('highlighted');
            });
        });
    </script>

</body>
</html>
