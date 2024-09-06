<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
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
            background-size: cover;
            background-position: center;
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
        .upload-btn {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }
        .upload-btn input[type="file"] {
            display: none;
        }
        .upload-btn label {
            padding: 10px 20px;
            background-color: #4a6572;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .upload-btn label:hover {
            background-color: #344955;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <div id="profilePic" class="profile-pic"></div>
                <h1 class="profile-title">{{ Auth::user()->name }}</h1>
            </div>
            <div class="tabs">
                <div class="tab-button active" onclick="showTab('view')">Lihat Profil</div>
                <div class="tab-button" onclick="showTab('edit')">Edit Profil</div>
            </div>
            <div id="view" class="profile-body">
                <div class="profile-info">
                    <input type="text" id="viewName" disabled>
                    <input type="text" id="viewNip" disabled>
                </div>
                <input type="text" id="viewGuru" class="full-width" disabled>
                <input type="text" id="viewEmail" class="full-width" disabled>
                <input type="text" id="viewTelepon" class="full-width" disabled>
                <div class="upload-btn">
                    <input type="file" id="fileInput" accept="image/*" onchange="uploadPhoto()">
                    <label for="fileInput">Ubah Foto Profil</label>
                </div>
            </div>
            <div id="edit" class="profile-body hidden">
                <form id="editForm">
                    <div class="profile-info">
                        <input type="text" id="editName" placeholder="Nama">
                        <input type="text" id="editNip" placeholder="Nip">
                    </div>
                    <input type="text" id="editGuru" placeholder="Guru" class="full-width">
                    <input type="text" id="editEmail" placeholder="Email" class="full-width">
                    <input type="text" id="editTelepon" placeholder="Telepon" class="full-width">
                    <button type="button" class="save-button" onclick="saveProfile()">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            document.getElementById('view').classList.add('hidden');
            document.getElementById('edit').classList.add('hidden');
            document.querySelectorAll('.tab-button').forEach(button => button.classList.remove('active'));

            document.getElementById(tabId).classList.remove('hidden');
            document.querySelector(`.tab-button[onclick="showTab('${tabId}')"]`).classList.add('active');
        }

        function saveProfile() {
            const name = document.getElementById('editName').value;
            const nip = document.getElementById('editNip').value;
            const guru = document.getElementById('editGuru').value;
            const email = document.getElementById('editEmail').value;
            const telepon = document.getElementById('editTelepon').value;

            localStorage.setItem('profileName', name);
            localStorage.setItem('profileNip', nip);
            localStorage.setItem('profileGuru', guru);
            localStorage.setItem('profileEmail', email);
            localStorage.setItem('profileTelepon', telepon);

            showTab('view');
            updateProfileView();
        }

        function updateProfileView() {
            document.getElementById('viewName').value = localStorage.getItem('profileName') || '';
            document.getElementById('viewNip').value = localStorage.getItem('profileNip') || '';
            document.getElementById('viewGuru').value = localStorage.getItem('profileGuru') || '';
            document.getElementById('viewEmail').value = localStorage.getItem('profileEmail') || '';
            document.getElementById('viewTelepon').value = localStorage.getItem('profileTelepon') || '';

            const profilePic = localStorage.getItem('profilePic');
            if (profilePic) {
                document.getElementById('profilePic').style.backgroundImage = `url(${profilePic})`;
            } else {
                document.getElementById('profilePic').style.backgroundImage = 'none';
            }
        }

        function uploadPhoto() {
            const fileInput = document.getElementById('fileInput');
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onloadend = function() {
                    const dataUrl = reader.result;
                    localStorage.setItem('profilePic', dataUrl);
                    document.getElementById('profilePic').style.backgroundImage = `url(${dataUrl})`;
                }
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateProfileView();
        });
    </script>
</body>
</html>
