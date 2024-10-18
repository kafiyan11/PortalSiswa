<head>
    <title> Mata Pelajaran | Portal Siswa</title>
</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Mata Pelajaran</h1>

    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: white;
            color: #333;
            display: top;
            flex-direction: column;
            align-items: center;
            margin: 0;
            box-sizing: border-box;
        }

        .subject-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            margin-top: 20px;
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
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }

        /* Animation */
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
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .subject-box img {
            width: 65px;
            height: 65px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .subject-box:hover img {
            transform: scale(1.2);
        }

        .subject-box h2 {
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: #000000; /* Bootstrap Primary Color */
        }

        /* Delay for each box */
        @for ($i = 1; $i <= 7; $i++)
            .subject-box:nth-child({{ $i }}) {
                animation-delay: {{ 0.1 * $i }}s;
            }
        @endfor
    </style>

    <div class="subject-container">
        @if($materi && $materi->isNotEmpty())
            @foreach($materi as $item)
                <div class="subject-box" onclick="window.location.href='{{ route('siswa.lihatmateri', ['id_mapel' => $item->id_mapel]) }}'">
                    <img src="{{ asset('storage/' . $item->icon) }}" alt="Icon for {{ $item->nama_mapel }}" onerror="this.onerror=null; this.src='{{ asset('path_to_default_image.jpg') }}';">
                    <h2>{{ $item->nama_mapel }}</h2>
                </div>
            @endforeach
        @else
            <p class="text-center">Tidak ada materi tersedia.</p> <!-- Pesan jika tidak ada materi -->
        @endif
    </div>
</div>
@endsection
