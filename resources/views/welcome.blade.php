<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Portal Siswa SMKN 1 Kawali</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Appland
  * Template URL: https://bootstrapmade.com/free-bootstrap-app-landing-page-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Portal Siswa</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#beranda" class="active">Beranda</a></li>
          <li><a href="#jurusan">Jurusan</a></li>
          <li><a href="#tentang">Tentang</a></li>
          <li><a href="#tim">Tim</a></li>
          <li><a href="#kontak">Kontak</a></li>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{route('login')}}">Masuk</a>
    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="beranda" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
          <div class="col-lg-6  d-flex flex-column justify-content-center text-center text-md-start" data-aos="fade-in">
            <h2>Selamat Datang Di Portal Siswa </h2>
            <p>Tempat Terbaik Untuk Mengelola Dan Memantau Perjalanan Akademik Siswa/i SMK Negri 1 Kawali</p>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

        <!-- Gallery Section -->
        <section id="jurusan" class="gallery section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Jurusan</h2>
              <p>Berikut Jurusan Di SMK Negeri 1 Kawali</p>
            </div><!-- End Section Title -->
      
            <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
      
              <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                  {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                      "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "centeredSlides": true,
                    "pagination": {
                      "el": ".swiper-pagination",
                      "type": "bullets",
                      "clickable": true
                    },
                    "breakpoints": {
                      "320": {
                        "slidesPerView": 1,
                        "spaceBetween": 0
                      },
                      "768": {
                        "slidesPerView": 3,
                        "spaceBetween": 30
                      },
                      "992": {
                        "slidesPerView": 5,
                        "spaceBetween": 30
                      },
                      "1200": {
                        "slidesPerView": 7,
                        "spaceBetween": 30
                      }
                    }
                  }
                </script>
                <div class="swiper-wrapper align-items-center">
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/tkr.jpg"><img src="landingJurusan/tkr.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/tkj.jpg"><img src="landingJurusan/tkj.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/rpl.jpg"><img src="landingJurusan/rpl.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/mp.jpg"><img src="landingJurusan/mp.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/ak.jpg"><img src="landingJurusan/ak.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/dpib.jpg"><img src="landingJurusan/dpib.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/sk.jpg"><img src="landingJurusan/sk.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/tkr.jpg"><img src="landingJurusan/tkr.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/tkj.jpg"><img src="landingJurusan/tkj.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/rpl.jpg"><img src="landingJurusan/rpl.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/mp.jpg"><img src="landingJurusan/mp.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/ak.jpg"><img src="landingJurusan/ak.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/dpib.jpg"><img src="landingJurusan/dpib.jpg" class="img-fluid" alt=""></a></div>
                  <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery-full" href="landingJurusan/sk.jpg"><img src="landingJurusan/sk.jpg" class="img-fluid" alt=""></a></div>

                </div>
                <div class="swiper-pagination"></div>
              </div>
      
            </div>
      
          </section><!-- /Gallery Section -->
      

    <!-- About Section -->
    <section id="tentang" class="about section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h1>Tentang</h1>
        <p style="font-size: 17px;">VISI DAN MISI SMKN 1 KAWALI</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <h3>VISI</h3>
            <ul>
              <p class="visi">Terwujudnya lulusan yang berakhlak mulia, unggul, profesional mandiri dan berdaya saing global pada tahun 2026.</p>
            </ul>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <h3>MISI</h3>
            <li>
              Membentuk insan yang beriman dan bertaqwa kepada Tuhan Yang Maha Esa, berkarakter pancasila dan berbudaya industri
            </li>
            <li>
              Meningkatkan kualitas tata kelola kelembagaan sekolah, sumber daya manusia, dan akuntabilitas.
            </li>
            <li>
              Meningkatkan layanan pendidikan melalui pembelajaran berbasis industri dan teknologi informasi
            </li>
            <li>
              Meningkatkan kerjasama kemitraan, penyerapan lulusan dengan IDUKA, Perguruan Tinggi dan Lembaga Pemerintahan serta membangun jiwa wirausaha yang tangguh dan mandiri.
            </li>
            <li>
              Meningkatkan kualitas SDM, menyediakan sarana dan prasarana yang berkualitas,dan menyajikan proses pembelajaran bermutu, menuju link and match dengan IDUKA
            </li>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <section id="tim" class="about section py-5" style="background-color: #ffffff;">
      <div class="container">
        <div class="row text-center mb-4">
          <div class="col">
            <h2 class="mb-3" style="font-weight: bold; color: #333;">Tim Kami</h2>
            <p class="lead" style="color: #666;">Kenali tim kami yang berdedikasi dan profesional</p>
          </div>
        </div>
        <div class="row gy-3 justify-content-center">
          <!-- Anggota Tim 1 -->
          <div class="col-lg-2 col-md-3 col-sm-4 d-flex align-items-stretch">
            <div class="card border-0 shadow-sm w-100" style="border-radius: 10px;">
              <img src="assets/img/nay.jpg" class="card-img-top rounded-top" alt="Nayaka Abi Akhlannaimi">
              <div class="card-body text-center d-flex flex-column">
                <h6 class="card-title mb-1">Nayaka Abi Akhlannaimi</h6>
                <p class="card-text text-muted small">Leader</p>
                <div class="mt-auto">
                  <!-- Optional: Additional content or social links -->
                </div>
              </div>
            </div>
          </div>
          <!-- Anggota Tim 2 -->
          <div class="col-lg-2 col-md-3 col-sm-4 d-flex align-items-stretch">
            <div class="card border-0 shadow-sm w-100" style="border-radius: 10px;">
              <img src="assets/img/alif2.jpeg" class="card-img-top rounded-top" alt="Alif Miftah Fauzan">
              <div class="card-body text-center d-flex flex-column">
                <h6 class="card-title mb-1">Alif Miftah Fauzan</h6>
                <p class="card-text text-muted small">Project Manager</p>
                <div class="mt-auto">
                  <!-- Optional: Additional content or social links -->
                </div>
              </div>
            </div>
          </div>
          <!-- Anggota Tim 5 -->
          <div class="col-lg-2 col-md-3 col-sm-4 d-flex align-items-stretch">
            <div class="card border-0 shadow-sm w-100" style="border-radius: 10px;">
              <img src="assets/img/lukman2.jpg" class="card-img-top rounded-top" alt="Lukman Nulhakim">
              <div class="card-body text-center d-flex flex-column">
                <h6 class="card-title mb-1">Lukman Nulhakim</h6>
                <p class="card-text text-muted small">Anggota</p>
                <div class="mt-auto">
                  <!-- Optional: Additional content or social links -->
                </div>
              </div>
            </div>
          </div>
          <!-- Anggota Tim 3 -->
          <div class="col-lg-2 col-md-3 col-sm-4 d-flex align-items-stretch">
            <div class="card border-0 shadow-sm w-100" style="border-radius: 10px;">
              <img src="assets/img/fiyan.jpg" class="card-img-top rounded-top" alt="Kafiyan Nurhidayah">
              <div class="card-body text-center d-flex flex-column">
                <h6 class="card-title mb-1">Kafiyan Nurhidayah</h6>
                <p class="card-text text-muted small">Anggota</p>
                <div class="mt-auto">
                  <!-- Optional: Additional content or social links -->
                </div>
              </div>
            </div>
          </div>
          <!-- Anggota Tim 4 -->
          <div class="col-lg-2 col-md-3 col-sm-4 d-flex align-items-stretch">
            <div class="card border-0 shadow-sm w-100" style="border-radius: 10px;">
              <img src="assets/img/aan2.jpg" class="card-img-top rounded-top" alt="Aan Padilah">
              <div class="card-body text-center d-flex flex-column">
                <h6 class="card-title mb-1">Aan Padilah</h6>
                <p class="card-text text-muted small">Anggota</p>
                <div class="mt-auto">
                  <!-- Optional: Additional content or social links -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    

    <!-- Contact Section -->
    <section id="kontak" class="about section light-background">

      <!-- Section Title -->
      <div class="container section-title text-center" data-aos="fade-up">
        <h2>Kontak</h2>
        <p></p>
      </div><!-- End Section Title -->
    
      <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 justify-content-center">
          <div class="col-lg-6">
            <div class="row gy-4 justify-content-center">
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="200">
                  <a href="https://maps.app.goo.gl/VQMDqhpocUPqYM8C8"><i class="bi bi-geo-alt"></i></a>
                  <h3>Alamat</h3>
                  <p>{{ $socialLinks->alamat }}</p>
                </div>
              </div><!-- End Info Item -->
    
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Telepon</h3>
                  <p>{{ $socialLinks->telepon }}</p>
                </div>
              </div><!-- End Info Item -->
    
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email</h3>
                  <p>{{ $socialLinks->email }}</p>
                </div>
              </div><!-- End Info Item -->
    
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="500">
                  <i class="bi bi-clock"></i>
                  <h3>Jam Buka</h3>
                  <p>Senin - Jum'at</p>
                  <p>{{ $socialLinks->jam_buka }}</p>
                </div>
              </div><!-- End Info Item -->
            </div>
          </div>
        </div>
      </div>
    
    </section>
    

  </main>

  <footer id="footer" class="footer">
    <div class="container footer-top">
      <div class="row gy-4 justify-content-center">
        <div class="col-lg-4 col-md-12 text-center">
          <h4>Ikuti Kami</h4>
          <p></p>
          <div class="social-links d-flex justify-content-center">
            <a href="{{ $socialLinks->twitter }}"><i class="bi bi-twitter-x"></i></a>
            <a href="{{ $socialLinks->facebook }}"><i class="bi bi-facebook"></i></a>
            <a href="{{ $socialLinks->instagram }}"><i class="bi bi-instagram"></i></a>
            <a href="{{ $socialLinks->youtube }}"><i class="bi bi-youtube"></i></a>
          </div>
        </div>
      </div>
    </div>
    

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Kawali</strong> <span>2024 - 2025</span></p>
      <div class="credits">
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>