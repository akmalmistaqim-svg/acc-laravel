<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Identifikasi Penyakit - ACC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-green: #4CAF50; 
            --primary-hover: #43a047;
            --light-green: #eaf4ed;
            --bg-light: #f4f9f5;
            --text-dark: #333333;
            --text-muted: #666666;
            --danger-red: #e53e3e;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- NAVBAR --- */
        .navbar {
            background-color: var(--white);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-text h1 {
            font-size: 20px;
            color: var(--primary-green);
            font-weight: 700;
            line-height: 1;
        }

        .logo-text span {
            font-size: 11px;
            color: var(--text-muted);
            letter-spacing: 0.5px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
        }

        .nav-item a {
            text-decoration: none;
            color: var(--text-dark);
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            transition: color 0.3s;
        }

        .nav-item a:hover, .nav-item.active a {
            color: var(--primary-green);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-name {
            font-size: 14px;
            color: var(--text-dark);
        }

        .btn-logout {
            background-color: var(--danger-red);
            color: var(--white);
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-transform: uppercase;
            transition: background 0.3s;
        }

        .btn-logout:hover {
            background-color: #c53030;
        }

        .hamburger {
            display: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
            padding: 5px;
        }

        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: var(--primary-green);
            border-radius: 3px;
            transition: 0.3s;
        }

        /* --- NAVBAR MOBILE DROPDOWN --- */
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
        }

        /* --- CAMERA SECTION --- */
        .content-area {
            flex: 1;
            padding: 100px 5% 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .camera-card {
            background-color: var(--white);
            width: 100%;
            max-width: 600px;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            text-align: center;
            position: relative;
        }

        .camera-card h2 {
            color: var(--primary-green);
            font-size: 24px;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-weight: 800;
        }

        .camera-card p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 25px;
        }

        .video-container {
            width: 100%;
            aspect-ratio: 4/3;
            background-color: #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 25px;
            position: relative !important;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px dashed #cbd5e1;
        }

        #camera-stream, #camera-canvas {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .placeholder-icon {
            font-size: 60px;
            color: #94a3b8;
        }

        /* TOMBOL CLOSE (X) */
        #btnCloseCamera {
            position: absolute !important;
            top: 12px !important;
            right: 12px !important;
            width: 40px !important;
            height: 40px !important;
            border-radius: 50% !important;
            background: #dc2626 !important;
            color: #ffffff !important;
            border: 2px solid #ffffff !important;
            font-size: 20px !important;
            font-weight: 700 !important;
            cursor: pointer !important;
            z-index: 10 !important;
            display: none !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4) !important;
            transition: all 0.3s ease !important;
            padding: 0 !important;
            line-height: 1 !important;
        }

        #btnCloseCamera:hover {
            background: #b91c1c !important;
            transform: scale(1.1) !important;
        }

        #btnCloseCamera i {
            pointer-events: none !important;
            font-size: 22px !important;
        }

        #btnCloseCamera.show {
            display: flex !important;
        }

        .controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-green);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #f1f5f9;
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
        }

        .btn-danger {
            background-color: #dc2626;
            color: var(--white);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
        }

        .btn-danger:hover {
            background-color: #b91c1c;
            transform: translateY(-2px);
        }

        .btn-upload {
            background-color: #2563eb;
            color: var(--white);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-upload:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
        }

        #upload-input {
            display: none;
        }

        #btn-snap, #btn-retake, #btn-send {
            display: none;
        }

        .alert-success {
            margin-top: 15px;
            padding: 12px 16px;
            background-color: var(--light-green);
            border: 1px solid var(--primary-green);
            border-radius: 8px;
            color: var(--primary-green);
            font-size: 14px;
            font-weight: 600;
        }

        .alert-error {
            margin-top: 15px;
            padding: 12px 16px;
            background-color: #fef2f2;
            border: 1px solid #dc2626;
            border-radius: 8px;
            color: #dc2626;
            font-size: 14px;
            font-weight: 600;
            display: none;
        }

        /* --- FOOTER --- */
        footer {
            background-color: var(--white);
            text-align: center;
            padding: 25px;
            font-size: 13px;
            color: var(--text-muted);
            border-top: 1px solid rgba(0,0,0,0.05);
            margin-top: auto;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .hamburger { 
                display: flex; 
                order: 2;
                z-index: 1001;
            }
            
            .user-profile { 
                order: 3; 
            }
            
            .user-name { 
                display: none; 
            }
            
            /* NAVBAR DROPDOWN - MUNCUL DARI ATAS KE BAWAH */
            .nav-menu {
                position: fixed;
                top: -100%;
                left: 0;
                width: 100%;
                flex-direction: column;
                background-color: var(--white);
                text-align: center;
                transition: top 0.4s ease-in-out;
                box-shadow: 0 10px 15px rgba(0,0,0,0.1);
                padding: 20px 0;
                gap: 20px;
                z-index: 999;
                border-bottom: 2px solid var(--primary-green);
            }
            
            .nav-menu.active {
                top: 70px;
            }
            
            .hamburger.active span:nth-child(1) {
                transform: rotate(45deg) translate(5px, 5px);
            }
            .hamburger.active span:nth-child(2) {
                opacity: 0;
            }
            .hamburger.active span:nth-child(3) {
                transform: rotate(-45deg) translate(6px, -6px);
            }

            .camera-card {
                padding: 20px;
            }
            .controls {
                gap: 10px;
            }
            .btn {
                padding: 10px 18px;
                font-size: 12px;
            }
            
            #btnCloseCamera {
                width: 36px !important;
                height: 36px !important;
                font-size: 16px !important;
                top: 8px !important;
                right: 8px !important;
            }
        }

        @media (max-width: 480px) {
            .btn {
                padding: 8px 14px;
                font-size: 11px;
            }
            .controls {
                gap: 8px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo-container">
            <img src="/LogoWeb.png" alt="ACC Logo" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
            <div class="logo-text">
                <h1>ACC</h1>
                <span>Agro Clima Care</span>
            </div>
        </div>

        <ul class="nav-menu" id="navMenu">
            <li class="nav-item"><a href="/dashboard">Beranda</a></li>
            <li class="nav-item active"><a href="/cekpenyakit">Identifikasi Penyakit</a></li>
            <li class="nav-item"><a href="/infopenyakit">Info Penyakit</a></li>
            <li class="nav-item"><a href="/hasildiagnosa">Hasil Diagnosa</a></li>
        </ul>

        <div class="user-profile">
            <span class="user-name">Halo, <strong>{{ $namaUser }}</strong></span>
            <button class="btn-logout" onclick="window.location.href='/logout'">Logout</button>
        </div>

        <div class="hamburger" id="hamburgerBtn">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <div class="content-area">
        <div class="camera-card">
            <h2>Deteksi Penyakit</h2>
            <p>Arahkan kamera ke bagian daun atau tanaman yang terindikasi sakit, lalu jepret foto dengan jelas.</p>

            <div class="video-container" id="videoContainer">
                <i class="fa-solid fa-camera placeholder-icon" id="placeholder-icon"></i>
                <video id="camera-stream" autoplay playsinline></video>
                <canvas id="camera-canvas"></canvas>
                
                <button id="btnCloseCamera" onclick="closeCamera()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Alert Error Kamera -->
            <div class="alert-error" id="cameraError">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span id="cameraErrorMessage">Gagal mengakses kamera. Silakan gunakan tombol Upload Foto.</span>
            </div>

            <div class="controls">
                <button class="btn btn-primary" id="btn-start" onclick="startCamera()">
                    <i class="fa-solid fa-camera"></i> Buka Kamera
                </button>

                <button class="btn btn-upload" id="btn-upload" onclick="document.getElementById('upload-input').click()">
                    <i class="fa-solid fa-upload"></i> Upload Foto
                </button>

                <button class="btn btn-primary" id="btn-snap" onclick="snapPhoto()">
                    <i class="fa-solid fa-circle-dot"></i> Jepret Foto
                </button>

                <button class="btn btn-secondary" id="btn-retake" onclick="retakePhoto()">
                    <i class="fa-solid fa-rotate-right"></i> Ulangi
                </button>

                <button class="btn btn-primary" id="btn-send" onclick="sendToDatabase()">
                    <i class="fa-solid fa-paper-plane"></i> Kirim
                </button>
            </div>

            <form id="upload-form" action="/cekpenyakit/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="upload-input" name="foto" accept="image/*" onchange="previewUpload(event)">
            </form>

            @if(session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Website Agro Clima Care (ACC). Semua Hak Dilindungi.</p>
    </footer>

    <script>
        // ==========================================
        // HAMBURGER MENU - DROPDOWN DARI ATAS
        // ==========================================
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const navMenu = document.getElementById('navMenu');

        hamburgerBtn.addEventListener('click', () => {
            hamburgerBtn.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        document.querySelectorAll('.nav-item a').forEach(link => {
            link.addEventListener('click', () => {
                hamburgerBtn.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });

        // Tutup menu saat scroll
        window.addEventListener('scroll', () => {
            if (navMenu.classList.contains('active')) {
                hamburgerBtn.classList.remove('active');
                navMenu.classList.remove('active');
            }
        });

        // ==========================================
        // LOGIKA KAMERA - DENGAN FALLBACK UNTUK HP
        // ==========================================
        const video = document.getElementById('camera-stream');
        const canvas = document.getElementById('camera-canvas');
        const placeholder = document.getElementById('placeholder-icon');
        const btnCloseCamera = document.getElementById('btnCloseCamera');
        const cameraError = document.getElementById('cameraError');
        const cameraErrorMessage = document.getElementById('cameraErrorMessage');

        const btnStart = document.getElementById('btn-start');
        const btnUpload = document.getElementById('btn-upload');
        const btnSnap = document.getElementById('btn-snap');
        const btnRetake = document.getElementById('btn-retake');
        const btnSend = document.getElementById('btn-send');

        let streamData = null;

        // Cek dukungan kamera di browser
        function isCameraSupported() {
            return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
        }

        function showCloseButton(show) {
            if (show) {
                btnCloseCamera.classList.add('show');
                btnCloseCamera.style.display = 'flex';
            } else {
                btnCloseCamera.classList.remove('show');
                btnCloseCamera.style.display = 'none';
            }
        }

        // ==========================================
        // START CAMERA
        // ==========================================
        async function startCamera() {
            cameraError.style.display = 'none';
            
            // CEK DUKUNGAN KAMERA
            if (!isCameraSupported()) {
                cameraError.style.display = 'block';
                cameraErrorMessage.innerHTML = '❌ Browser Anda tidak mendukung akses kamera. <br> Silakan gunakan tombol <strong>Upload Foto</strong> untuk mengunggah gambar dari galeri.';
                placeholder.style.display = 'block';
                video.style.display = 'none';
                canvas.style.display = 'none';
                showCloseButton(false);
                btnStart.style.display = 'inline-flex';
                btnUpload.style.display = 'inline-flex';
                btnSnap.style.display = 'none';
                btnRetake.style.display = 'none';
                btnSend.style.display = 'none';
                return;
            }

            try {
                const constraints = { 
                    video: { 
                        facingMode: 'environment',
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    } 
                };

                streamData = await navigator.mediaDevices.getUserMedia(constraints);
                video.srcObject = streamData;
                await video.play();

                placeholder.style.display = 'none';
                canvas.style.display = 'none';
                video.style.display = 'block';
                
                showCloseButton(true);

                btnStart.style.display = 'none';
                btnUpload.style.display = 'none';
                btnRetake.style.display = 'none';
                btnSend.style.display = 'none';
                btnSnap.style.display = 'inline-flex';

            } catch (err) {
                console.error("Error Akses Kamera:", err);
                cameraError.style.display = 'block';
                
                if (err.name === 'NotAllowedError' || err.name === 'PermissionDeniedError') {
                    cameraErrorMessage.innerHTML = '❌ Izin kamera ditolak. <br> Silakan izinkan akses kamera di pengaturan browser, atau gunakan tombol <strong>Upload Foto</strong>.';
                } else if (err.name === 'NotFoundError' || err.name === 'DevicesNotFoundError') {
                    cameraErrorMessage.innerHTML = '❌ Tidak ada kamera yang terdeteksi. <br> Silakan gunakan tombol <strong>Upload Foto</strong> untuk mengunggah gambar.';
                } else if (err.name === 'NotReadableError') {
                    cameraErrorMessage.innerHTML = '❌ Kamera sedang digunakan oleh aplikasi lain. <br> Tutup aplikasi lain atau gunakan tombol <strong>Upload Foto</strong>.';
                } else if (err.name === 'OverconstrainedError') {
                    cameraErrorMessage.innerHTML = '❌ Tidak dapat mengakses kamera belakang. <br> Coba gunakan tombol <strong>Upload Foto</strong>.';
                } else {
                    cameraErrorMessage.innerHTML = '❌ Gagal mengakses kamera: ' + err.message + '<br> Silakan gunakan tombol <strong>Upload Foto</strong>.';
                }
                
                placeholder.style.display = 'block';
                video.style.display = 'none';
                canvas.style.display = 'none';
                showCloseButton(false);
                btnStart.style.display = 'inline-flex';
                btnUpload.style.display = 'inline-flex';
                btnSnap.style.display = 'none';
                btnRetake.style.display = 'none';
                btnSend.style.display = 'none';
            }
        }

        // ==========================================
        // CLOSE CAMERA
        // ==========================================
        function closeCamera() {
            if (streamData) {
                streamData.getTracks().forEach(track => track.stop());
                streamData = null;
            }

            video.style.display = 'none';
            video.srcObject = null;
            canvas.style.display = 'none';
            placeholder.style.display = 'block';
            
            showCloseButton(false);

            btnStart.style.display = 'inline-flex';
            btnUpload.style.display = 'inline-flex';
            btnSnap.style.display = 'none';
            btnRetake.style.display = 'none';
            btnSend.style.display = 'none';
            cameraError.style.display = 'none';
        }

        // ==========================================
        // SNAP PHOTO
        // ==========================================
        function snapPhoto() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            video.style.display = 'none';
            canvas.style.display = 'block';

            btnSnap.style.display = 'none';
            btnRetake.style.display = 'inline-flex';
            btnSend.style.display = 'inline-flex';
            
            showCloseButton(true);

            btnSend.onclick = sendToDatabase;
            btnRetake.onclick = retakePhoto;
        }

        // ==========================================
        // RETAKE PHOTO
        // ==========================================
        function retakePhoto() {
            canvas.style.display = 'none';
            video.style.display = 'block';

            btnRetake.style.display = 'none';
            btnSend.style.display = 'none';
            btnSnap.style.display = 'inline-flex';
            
            showCloseButton(true);
        }

        // ==========================================
        // SEND TO DATABASE
        // ==========================================
        function sendToDatabase() {
            canvas.toBlob(function(blob) {
                const formData = new FormData();
                formData.append('foto', blob, 'foto_kamera.jpg');
                
                fetch('/cekpenyakit/upload', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('✅ Foto berhasil dikirim! Tunggu hasil diagnosa dari admin.');
                        closeCamera();
                        window.location.reload();
                    } else {
                        alert('❌ Gagal mengirim foto: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('❌ Terjadi kesalahan: ' + error.message);
                });
            }, 'image/jpeg', 0.9);
        }

        // ==========================================
        // UPLOAD FOTO DARI GALERI
        // ==========================================
        function previewUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            if (file.size > 5 * 1024 * 1024) {
                alert('❌ Ukuran foto terlalu besar! Maksimal 5MB.');
                document.getElementById('upload-input').value = '';
                return;
            }

            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                alert('❌ Format foto harus JPG, JPEG, atau PNG.');
                document.getElementById('upload-input').value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    canvas.width = img.width;
                    canvas.height = img.height;
                    canvas.getContext('2d').drawImage(img, 0, 0);

                    placeholder.style.display = 'none';
                    video.style.display = 'none';
                    canvas.style.display = 'block';
                    showCloseButton(true);

                    btnStart.style.display = 'none';
                    btnUpload.style.display = 'none';
                    btnSnap.style.display = 'none';
                    btnRetake.style.display = 'inline-flex';
                    btnSend.style.display = 'inline-flex';

                    btnSend.onclick = function() {
                        document.getElementById('upload-form').submit();
                    };

                    btnRetake.onclick = function() {
                        canvas.style.display = 'none';
                        placeholder.style.display = 'block';
                        showCloseButton(false);
                        btnRetake.style.display = 'none';
                        btnSend.style.display = 'none';
                        btnStart.style.display = 'inline-flex';
                        btnUpload.style.display = 'inline-flex';
                        document.getElementById('upload-input').value = '';
                    };
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        // ==========================================
        // TUTUP DENGAN TOMBOL ESC
        // ==========================================
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCamera();
            }
        });

        // ==========================================
        // CEK DUKUNGAN KAMERA SAAT HALAMAN DIMUAT
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            if (!isCameraSupported()) {
                cameraError.style.display = 'block';
                cameraErrorMessage.innerHTML = '📱 Browser Anda tidak mendukung akses kamera. <br> Silakan gunakan tombol <strong>Upload Foto</strong> untuk mengunggah gambar dari galeri.';
            }
        });
    </script>
</body>
</html>