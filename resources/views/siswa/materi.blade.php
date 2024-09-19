<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f7f8fc, #e0e7ff);
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;
            box-sizing: border-box;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 50px;
            color: #2c3e50;
            margin-top: 130px; /* Menambahkan jarak dari bagian atas halaman */
        }

        .subject-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1200px;
        }

        .subject-box {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 30px 20px;
            text-align: center;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .subject-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .subject-box img {
            width: 50px;
            height: 50px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .subject-box:hover img {
            transform: scale(1.1);
        }

        .subject-box h2 {
            font-size: 1.6rem;
            margin-bottom: 10px;
            color: #2980b9;
        }

        .subject-box p {
            font-size: 1rem;
            color: #7f8c8d;
        }

        .new-assignment {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #e74c3c;
            color: #fff;
            border-radius: 50%;
            padding: 8px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        @media (max-width: 1000px) {
            h1 {
                font-size: 2rem;
            }
        }

        /* Delay untuk setiap box */
        .subject-box:nth-child(1) {
            animation-delay: 0.1s;
        }

        .subject-box:nth-child(2) {
            animation-delay: 0.2s;
        }

        .subject-box:nth-child(3) {
            animation-delay: 0.3s;
        }

        .subject-box:nth-child(4) {
            animation-delay: 0.4s;
        }

        .subject-box:nth-child(5) {
            animation-delay: 0.5s;
        }

        .subject-box:nth-child(6) {
            animation-delay: 0.6s;
        }

        .subject-box:nth-child(7) {
            animation-delay: 0.7s;
        }
    </style>
</head>
<body>
    @include('layouts.app')
    <h1>Materi Pelajaran</h1>
    <div class="subject-container">
        <div class="subject-box" onclick="window.location">
        <a href="{{route('lihat.materi')}}">
            <img src="{{asset('assets/img/mtk.png')}}" alt="">
            <h2>Matematika</h2></a>
        </div>
        <div class="subject-box" onclick="window.location">
        <a href="{{route('lihat.materi')}}">
            <img src="{{asset('assets/img/pkn2.png')}}" alt="">
            <h2>Pendidikan Kewarganegaraan</h2></a>
        </div>
        <div class="subject-box" onclick="window.location">
        <a href="{{route('lihat.materi')}}">
            <img src="{{asset('assets/img/indo2.png')}}" alt="">
            <h2>Bahasa Indonesia</h2></a>
        </div>
        <div class="subject-box" onclick="window.location">
        <a href="{{route('lihat.materi')}}">
            <img src="{{asset('assets/img/sejarah2.png')}}">
            <h2>Bahasa Sunda</h2></a>
        </div>
        <div class="subject-box" onclick="window.location">
        <a href="{{route('lihat.materi')}}">
            <img src="{{asset('assets/img/aceng.png')}}" alt="">
            <h2>Pendidikan Kewirausahaan</h2></a>
        </div>
        <div class="subject-box" onclick="window.location">
            <a href="{{route('lihat.materi')}}">
            <img src="{{asset('assets/img/inggris2.png')}}" alt="">
            <h2>Bahasa Inggris</h2></a>
        </div>
    </div>
</body>
</html>