<?php
include 'koneksi.php';
session_start();

$data1 = mysqli_query($koneksi, "SELECT * FROM buku");
$total_buku = mysqli_num_rows($data1);

$data1 = mysqli_query($koneksi, "SELECT * FROM pengguna");
$total_pengguna = mysqli_num_rows($data1);

$data1 = mysqli_query($koneksi, "SELECT * FROM kategori");
$total_kategori = mysqli_num_rows($data1);

$data1 = mysqli_query($koneksi, "SELECT * FROM komentar");
$total_komentar = mysqli_num_rows($data1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home - FlexiLibrary</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon/log.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart
  * Updated: Mar 13 2024 with Bootstrap v5.3.3
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <?php include 'header.php' ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero"  class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Welcome to FlexiLibrary!</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">a digital library that provides free access to thousands of eBooks from various genres and well-known authors.</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="pengguna/" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Started</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>WHO WE ARE</h3>
              <h2>Welcome to FlexiLibrary,</h2>
              <p>
              your ultimate destination for free digital ebook downloads. At Flexi Library, we believe that knowledge should be accessible to everyone, regardless of location or financial status. Our mission is to provide a large collection of high-quality ebooks from various genres and fields, which are available for free download by our users.
              </p>
              <div class="text-center text-lg-start">
                <a href="about.php" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/tentang.jpeg" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- ======= Tempat Buku Populer ======= -->
    <section id="tempat-buku-populer" class="testimonials">
        <div class="container" data-aos="fade-up">
          <header class="section-header">
            <h2>Populer Ebook</h2>
            <p>Top ebooks across various genres</p>
          </header>
          <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper">
              <?php
              $query = "SELECT * FROM buku WHERE jumlah_unduhan > 5 ORDER BY jumlah_unduhan DESC LIMIT 5";
              $result = mysqli_query($koneksi, $query);

              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $rating = floatval($row['rating']);
                  $fullStars = floor($rating);
                  $halfStars = ($rating - $fullStars) >= 0.5 ? 1 : 0;
                  $emptyStars = 5 - $fullStars - $halfStars;

                  echo '<div class="swiper-slide">
                          <div class="testimonial-item">
                            <img src="assets/img/ebook/' . $row["gambar_sampul"] . '" alt="' . $row["judul"] . '" style="max-width: 200px; display: block; margin: 0 auto;">
                            <hr>
                            <p>' . $row["judul"] . '</p>
                            <div class="rating">';
                  
                  for ($i = 0; $i < $fullStars; $i++) {
                    echo '<i class="bi bi-star-fill" style="color: #f7c600;"></i>';
                  }

                  if ($halfStars) {
                    echo '<i class="bi bi-star-half" style="color: #f7c600;"></i>';
                  }

                  for ($i = 0; $i < $emptyStars; $i++) {
                    echo '<i class="bi-star-fill" style="color: black;"></i>';
                  }

                  echo '</div>
                          </div>
                        </div><!-- End testimonial item -->';
                }
              } else {
                echo "Tidak ada buku populer dengan jumlah unduhan lebih dari 5.";
              }
              ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
    </section><!-- End Tempat Buku Populer -->


    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-people"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_pengguna; ?>" data-purecounter-duration="1" class="purecounter"></span>
                <p>Users</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-book"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_buku; ?>" data-purecounter-duration="1" class="purecounter"></span>
                <p>Ebooks</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-tags"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_kategori; ?>" data-purecounter-duration="1" class="purecounter"></span>
                <p>Categories</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-chat-dots"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_komentar; ?>" data-purecounter-duration="1" class="purecounter"></span>
                <p>Comments</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Daftar Buku Section ======= -->
    <section id="daftar-buku" class="portfolio" style="overflow-y: auto;">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h2>ebook collection</h2>
          <p>Explore our comprehensive ebook collection here</p>
        </header>
        <style>
          .portfolio-item .portfolio-wrap img {
            height: 500px;
            object-fit: cover;
          }

          /* Optional: Center the animation effect when scrolling */
          .portfolio-item {
            display: flex;
            justify-content: center;
            align-items: center;
          }
        </style>
        <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
          <?php
          // Lakukan query untuk mengambil data buku
          $query_buku = "SELECT * FROM buku";
          $result_buku = mysqli_query($koneksi, $query_buku);

          // Periksa apakah query berhasil dieksekusi
          if (mysqli_num_rows($result_buku) > 0) {
            // Variabel untuk menghitung jumlah buku yang ditampilkan
            $counter = 0;

            while ($row_buku = mysqli_fetch_assoc($result_buku)) {
              // Tentukan jumlah bintang penuh, setengah dan kosong
              $rating = $row_buku["rating"];
              $fullStars = floor($rating);  // Bintang penuh
              $halfStars = ($rating - $fullStars >= 0.5) ? 1 : 0;  // Bintang setengah
              $emptyStars = 5 - $fullStars - $halfStars;  // Bintang kosong
            
              echo '<div class="col-lg-4 col-md-6 portfolio-item filter-app" data-aos="fade-up" data-aos-delay="' . (100 * $counter) . '">
                <div class="portfolio-wrap">
                  <img src="assets/img/ebook/' . $row_buku["gambar_sampul"] . '" class="img-fluid" alt="' . $row_buku["judul"] . '">
                  <div class="portfolio-info">
                    <div class="rating" style="position: absolute; top: 10px; left: 10px; color: #000000; padding: 5px 10px; border-radius: 5px; font-weight: bold;">
                      ';
            
              for ($i = 0; $i < $fullStars; $i++) {
                echo '<i class="bi bi-star-fill" style="color: #f7c600;"></i>';
              }
            
              if ($halfStars) {
                echo '<i class="bi bi-star-half" style="color: #f7c600;"></i>';
              }
            
              for ($i = 0; $i < $emptyStars; $i++) {
                echo '<i class="bi-star-fill" style="color: black;"></i>';
              }         
              echo '</div>
                    <div class="portfolio-links">
                      <a href="detail_buku.php?id_buku=' . $row_buku["id_buku"] . '" title="More Details"><i class="bi bi-eye"></i></a>
                    </div>
                  </div>
                </div>
              </div>';
            
              $counter++;
           
              if ($counter >= 5) {
                break;
              }
            }
            
            if ($counter >= 5) {
              echo '<div class="col-lg-4 col-md-6 portfolio-item filter-app" data-aos="fade-up" data-aos-delay="' . (100 * $counter) . '">
                <div class="portfolio-wrap">
                  <img src="assets/img/ebook/book.png" class="img-fluid" alt="Lihat Semua Buku">
                  <div class="portfolio-info">
                    <h4>View All Ebooks</h4>
                    <p>Click here to view all ebooks</p>
                    <div class="portfolio-links">
                      <a href="semuah_buku.php" title="Lihat Semua Buku"><i class="bi bi-three-dots"></i></a>
                    </div>
                  </div>
                </div>
              </div>';
            }
          } else {
            echo "No ebook data available.";
          }
          ?>
        </div>
      </div>
    </section><!-- End Daftar Buku Section -->


    <!-- ======= Team Section ======= -->
    <!-- <section id="pembuat" class="testimonials">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h2>Pembuat</h2>
          <p>Pembuat web Flekxi Library</p>
        </header>
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
          <div class="swiper-wrapper">
            
            <div class="swiper-slide">
              <div class="testimonial-item member">
                <div class="member-img">
                  <img src="Team/male.jpeg" class="img-fluid" alt="">
                  <div class="social">
                    <a href="https://www.facebook.com/share/JQnTnzM7KwM3noK2/?mibextid=qi2Omg"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/frameszans?igsh=bnJuZ2plcGlkYnBk"><i class="bi bi-instagram"></i></a>
                    <a href="//wa.me/6285315632509?text=Halo%20saya%20ingin%20berbicara%20dengan%20Anda"><i class="bi bi-whatsapp"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Male</h4>
                  <span>UI / UX</span>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item member">
                <div class="member-img">
                  <img src="Team/male.jpeg" class="img-fluid" alt="">
                  <div class="social">
                    <a href="https://www.facebook.com/share/JQnTnzM7KwM3noK2/?mibextid=qi2Omg"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/frameszans?igsh=bnJuZ2plcGlkYnBk"><i class="bi bi-instagram"></i></a>
                    <a href="//wa.me/6285315632509?text=Halo%20saya%20ingin%20berbicara%20dengan%20Anda"><i class="bi bi-whatsapp"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Male</h4>
                  <span>Backend</span>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item member">
                <div class="member-img">
                  <img src="Team/male.jpeg" class="img-fluid" alt="">
                  <div class="social">
                    <a href="https://www.facebook.com/share/JQnTnzM7KwM3noK2/?mibextid=qi2Omg"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/frameszans?igsh=bnJuZ2plcGlkYnBk"><i class="bi bi-instagram"></i></a>
                    <a href="//wa.me/6285315632509?text=Halo%20saya%20ingin%20berbicara%20dengan%20Anda"><i class="bi bi-whatsapp"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Male</h4>
                  <span>UI / UX</span>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item member">
                <div class="member-img">
                  <img src="Team/male.jpeg" class="img-fluid" alt="">
                  <div class="social">
                    <a href="https://www.facebook.com/share/JQnTnzM7KwM3noK2/?mibextid=qi2Omg"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/frameszans?igsh=bnJuZ2plcGlkYnBk"><i class="bi bi-instagram"></i></a>
                    <a href="//wa.me/6285315632509?text=Halo%20saya%20ingin%20berbicara%20dengan%20Anda"><i class="bi bi-whatsapp"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Male</h4>
                  <span>Frontend</span>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item member">
                <div class="member-img">
                  <img src="Team/female.jpg" class="img-fluid" alt="">
                  <div class="social">
                    <a href="https://www.facebook.com/share/JQnTnzM7KwM3noK2/?mibextid=qi2Omg"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/frameszans?igsh=bnJuZ2plcGlkYnBk"><i class="bi bi-instagram"></i></a>
                    <a href="//wa.me/6285315632509?text=Halo%20saya%20ingin%20berbicara%20dengan%20Anda"><i class="bi bi-whatsapp"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Female</h4>
                  <span>Microsoft Office</span>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item member">
                <div class="member-img">
                  <img src="Team/female.jpg" class="img-fluid" alt="">
                  <div class="social">
                    <a href="https://www.facebook.com/share/JQnTnzM7KwM3noK2/?mibextid=qi2Omg"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/frameszans?igsh=bnJuZ2plcGlkYnBk"><i class="bi bi-instagram"></i></a>
                    <a href="//wa.me/6285315632509?text=Halo%20saya%20ingin%20berbicara%20dengan%20Anda"><i class="bi bi-whatsapp"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Female</h4>
                  <span>Microsoft Office</span>
                </div>
              </div>
            </div>

          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section> -->
    <!-- ===== End Team Section ===== -->

    <!-- ======= Contact Section ======= -->
    <section id="kontak" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Contact us</h2>
          <p>Contact and Support</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>flexilibrary@gmail.com</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-instagram"></i>
                  <h3>Instagram</h3>
                  <p>Flexilibrary</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-telegram"></i>
                  <h3>Telegram</h3>
                  <p>@flexilibrary</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-whatsapp"></i>
                  <h3>WhatsApp</h3>
                  <p>+62 853-1563-2509</p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form id="contact-form" action="https://formspree.io/f/xwkganbp" method="post" class="php-email-form">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" id="name" class="form-control" name="name" placeholder="Your Name" required>
                </div>

                <div class="col-md-6">
                  <input type="email" id="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>

                <div class="col-md-12">
                  <input type="text" id="subject" class="form-control" name="subject" placeholder="Subject" required>
                </div>

                <div class="col-md-12">
                  <textarea id="message" class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div id="loading" style="display: none;"><i class="fas fa-spinner fa-spin" style="font-size: 24px;"></i></div>
                  <div id="error-message" style="display: none;"></div>
                  <div id="sent-message" style="display: none;">Terima kasih atas pesan Anda!</div>
                  <div id="thank-you-message" style="display: none; background-color: #4154F1; color: #fff; padding: 10px; border-radius: 5px; margin-top: 10px; position: relative;">Terima kasih atas pesan Anda! <i class="bi bi-x" id="close-thank-you" style="cursor: pointer; position: absolute; top: 5px; right: 5px;"></i></div><br>
                  <button id="submit-button" type="submit">Send Message</button>
                </div>

              </div>
            </form>

          </div>

        </div>

      </div>

    </section><!-- End Contact Section -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('contact-form');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const subjectInput = document.getElementById('subject');
        const messageInput = document.getElementById('message');
        const loadingMessage = document.getElementById('loading');
        const errorMessage = document.getElementById('error-message');
        const sentMessage = document.getElementById('sent-message');
        const thankYouMessage = document.getElementById('thank-you-message');

        // Close Thank You message
        document.getElementById('close-thank-you').addEventListener('click', function() {
          thankYouMessage.style.display = 'none';
        });

        form.addEventListener('submit', function(event) {
          event.preventDefault(); // Menghentikan pengiriman formulir

          // Tampilkan pesan "Loading"
          loadingMessage.style.display = 'block';

          // Kirim data ke Formspree
          fetch(form.getAttribute('action'), {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                name: nameInput.value,
                email: emailInput.value,
                subject: subjectInput.value,
                message: messageInput.value
              })
            })
            .then(response => {
              if (!response.ok) {
                throw new Error('Ada masalah saat mengirim pesan. Silakan coba lagi.');
              }
              loadingMessage.style.display = 'none';
              thankYouMessage.style.display = 'block';
              nameInput.value = '';
              emailInput.value = '';
              subjectInput.value = '';
              messageInput.value = '';
            })
            .catch(error => {
              // Terjadi kesalahan saat mengirim pesan
              // Sembunyikan pesan "Loading"
              loadingMessage.style.display = 'none';
              // Tampilkan pesan error
              errorMessage.innerText = error.message;
              errorMessage.style.display = 'block';
            });
        });
      });
    </script>

  </main><!-- End #main -->

  <?php include 'footer.php' ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>