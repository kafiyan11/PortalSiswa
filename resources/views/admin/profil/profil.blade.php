<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body, html {
            font-family: Arial, sans-serif;
            height: 100%;
            background-color: #f0f0f0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            
            padding: 20px;
        }
        .profile-card {
            width: 100%;
            max-width: 800px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .profile-header {
            background-color: #4a6572;
            color: white;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            background-color: #344955;
            border-radius: 50%;
            margin-right: 30px;
            border: 4px solid white;
        }
        .profile-title {
            font-size: 32px;
            margin: 0;
        }
        .tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin: 20px 0;
        }
        .tab-button {
            flex: 1;
            padding: 15px;
            text-align: center;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }
        .tab-button.active {
            background-color: #fff;
            border-bottom: 1px solid white;
        }
        .profile-body {
            padding: 30px;
        }
        .profile-info {
            display: flex;
            margin-bottom: 20px;
        }
        .profile-info input {
            flex: 1;
            padding: 12px;
            margin-right: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .profile-info input:last-child {
            margin-right: 0;
        }
        .full-width {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .edit-button, .save-button {
            float: right;
            padding: 12px 24px;
            background-color: #4a6572;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .edit-button:hover, .save-button:hover {
            background-color: #344955;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    @include('layouts.app')
    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-pic"></div>
                <h1 class="profile-title">Profil</h1>
            </div>
            <div class="tabs">
                <div class="tab-button active" onclick="showTab('view')">Lihat Profil</div>

            </div>
            <div id="view" class="profile-body">
                <div class="profile-info">
                    <input type="text" id="viewName" disabled value="Nama">
                    <input type="text" id="viewNip" disabled>
                </div>
                <input type="text" id="viewGuru" class="full-width" disabled>
                <input type="text" id="viewEmail" class="full-width" disabled>
                <input type="text" id="viewTelepon" class="full-width" disabled>
            </div>
                            <div class="tab-button" onclick="showTab('edit')">Edit Profil</div>
            <div id="edit" class="profile-body hidden">
                <div class="profile-info">
                    <input type="text" id="editName" placeholder="Nama">
                    <input type="text" id="editNip" placeholder="Nip">
                </div>
                <input type="text" id="editGuru" placeholder="Guru" class="full-width">
                <input type="text" id="editEmail" placeholder="Email" class="full-width">
                <input type="text" id="editTelepon" placeholder="Telepon" class="full-width">
                <button type="button" class="save-button" onclick="saveProfile()">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</body>
</html>
