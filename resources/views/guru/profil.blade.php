<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .profile-header {
            background-color: #4a6670;
            padding: 20px;
            color: white;
            text-align: center;
            position: relative;
        }
        .profile-header img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            background-color: white;
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
        }
        .profile-header h2 {
            margin-top: 80px;
        }
        .profile-body {
            padding: 20px;
        }
        .profile-body input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .tabs {
            display: flex;
            justify-content: space-around;
            background-color: #f1f1f1;
            padding: 10px 0;
        }
        .tabs a {
            text-decoration: none;
            padding: 10px 20px;
            color: #333;
            border-bottom: 2px solid transparent;
        }
        .tabs a.active {
            border-bottom: 2px solid #4a6670;
            color: #4a6670;
        }
    </style>
</head>
<body>
@include('layouts.app')
<div class="profile-container">
    <div class="profile-header">
        <img src="#" alt="Profile Picture">
        <h2>Profil</h2>
    </div>
    <div class="tabs">
        <a href="#" class="active">Lihat Profil</a>
        <a href="#">Edit Profil</a>
    </div>
    <div class="profile-body">
        <input type="text" value="Aan Padilah">
        <input type="text" value="87654321">
        <input type="text" value="Guru">
        <input type="text" value="87654321">
        <input type="text" value="Aan Padilah">
    </div>
</div>

</body>
</html>
