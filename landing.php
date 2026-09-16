<?php
// Taruh ini paling atas
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Pengecekan APAR</title>

    <style>
        .jelajahi:hover {
            background-color: rgba(132, 129, 7, 1);
            box-shadow: 0 0 20px #895e08ff, 0 0 40px #846f05ff, 0 0 60px #a78b04ff;
            transform: scale(0.95);
        }

        /* Animations for landing page */
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        header {
            animation: slideDown 1s ease-out;
        }

        section.relative {
            animation: fadeInUp 1.2s ease-out;
        }

        footer {
            animation: fadeIn 1s ease-out 0.5s both;
        }

        .grid.grid-cols-1.md\\:grid-cols-3.gap-8 > div {
            opacity: 0;
            animation: fadeIn 0.8s ease-out both;
        }

        .grid.grid-cols-1.md\\:grid-cols-3.gap-8 > div:nth-child(1) { animation-delay: 0.2s; }
        .grid.grid-cols-1.md\\:grid-cols-3.gap-8 > div:nth-child(2) { animation-delay: 0.4s; }
        .grid.grid-cols-1.md\\:grid-cols-3.gap-8 > div:nth-child(3) { animation-delay: 0.6s; }
        .grid.grid-cols-1.md\\:grid-cols-3.gap-8 > div:nth-child(4) { animation-delay: 0.8s; }
        .grid.grid-cols-1.md\\:grid-cols-3.gap-8 > div:nth-child(5) { animation-delay: 1s; }
        .grid.grid-cols-1.md\\:grid-cols-3.gap-8 > div:nth-child(6) { animation-delay: 1.2s; }
    </style>
</head>

<body class="bg-gray-50 font-sans" style="background-image: url(assets/img/Landing/dot-grid.webp);" x-data="{ openModal: null }">

    <!-- HEADER -->
<header class="fixed top-0 left-0 w-full bg-white shadow-md z-50 animate-slide-down">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- LOGO -->
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <img src="assets/img/logologinAH.png" alt="Logo" class="w-12 h-12">
            <span class="text-lg md:text-xl font-bold text-gray-800">
                Pengecekan APAR & HYDRANT
            </span>
        </a>



       <!-- NAVIGATION -->
<div class="flex items-center gap-3 md:gap-4">
    <!-- Login Bogor -->
    <a href="login.php"
        class="hidden md:inline-block px-4 py-2 text-sm font-semibold bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
        Login Bogor
    </a>
    <!-- Login Maja -->
    <a href="https://www.storage-cloud.my.id/Cek_AparHydrantMaja/login.php"
        class="hidden md:inline-block px-4 py-2 text-sm font-semibold bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
        Login Maja
    </a>
    <!-- Guest -->
    <a  onclick="openModal()" 
        class="hidden md:inline-block px-4 py-2 text-sm font-semibold border border-gray-700 text-gray-700 rounded-lg shadow hover:bg-gray-700 hover:text-white transition">
        Masuk Tamu
    </a>

    <!-- Hamburger Menu (mobile only) -->
    <button id="menu-btn" class="md:hidden p-2 rounded-lg border border-gray-300 hover:bg-gray-100">
        <!-- Ikon Hamburger 3 garis -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>




<!-- Dropdown menu mobile -->
<div id="mobile-menu" class="hidden flex-col gap-2 mt-3 md:hidden bg-white shadow rounded-lg p-4">
    <a href="login.php"
        class="block px-4 py-2 text-sm font-semibold bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        Login Bogor
    </a>
    <a href="https://www.storage-cloud.my.id/Cek_AparHydrantMaja/login.php"
        class="block px-4 py-2 text-sm font-semibold bg-green-600 text-white rounded-lg hover:bg-green-700">
        Login Maja
    </a>
    <a  onclick="openModal()" 
        class="block px-4 py-2 text-sm font-semibold border border-gray-700 text-gray-700 rounded-lg hover:bg-gray-700 hover:text-white">
        Masuk Tamu
    </a>
</div>
</div>
<script>
    const btn = document.getElementById("menu-btn");
    const menu = document.getElementById("mobile-menu");

    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });
</script>

</header>

<!-- Tambahin Alpine.js -->


    </div>
</header>


    <!-- HERO SECTION -->
    <section class="relative pt-32 pb-20 bg-gradient-to-r from-[#E63946] via-[#EF5350] to-[#E63946] text-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

            <!-- TEKS UTAMA -->
            <div class="space-y-6">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    Sistem Manajemen <span class="text-yellow-300">Pengecekan APAR</span>
                </h1>
                <p class="text-lg text-gray-100">
                    Kelola pengecekan dan perawatan alat pemadam api ringan <span style="font-weight: bold; color: #670818ff; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">(APAR) & HYDRANT</span> dengan lebih mudah, cepat, dan
                    terorganisir.
                </p>
                <div class="flex gap-4" >
                    <a href="#" 
   @click.prevent="openModal = 'learn'"
   class="px-6 py-3 bg-yellow-400 text-gray-900 font-semibold rounded-lg shadow hover:bg-yellow-300 transition jelajahi">
   📖 Learn
</a>
                    <!-- <a href="{{ route('login') }}"
                        class="px-6 py-3 border border-white text-white font-semibold rounded-lg hover:bg-white hover:text-[#E63946] transition">
                        Login
                    </a> -->
                </div>
            </div>

            <!-- GAMBAR ILUSTRASI -->
            <div class="flex justify-center md:justify-end">
                <img src="assets/img/Landing/Cegah_Kebakaran,_Selalu_Siap_dengan_APAR!_(1)[1](1).png" alt="Ilustrasi APAR"
                    class="w-80 md:w-96 drop-shadow-lg rounded-lg">
            </div>
        </div>
    </section>

    <!-- FITUR UNGGULAN -->
    <section class="py-16 bg-gray-50" style="background-image: url(assets/img/Landing/dot-grid.webp);">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800">Fitur Unggulan</h2>
            <p class="mt-3 text-gray-600">Semua yang kamu butuhkan untuk mengelola pengecekan APAR lebih mudah.</p>

            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Fitur 1 -->
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <img src="assets/img/Landing/ChatGPT Image Aug 21, 2025, 10_41_56 AM.png" alt="Fitur"
                        class="w-14 mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Pengecekan Rutin</h3>
                    <p class="mt-2 text-gray-600">Pantau jadwal pengecekan APAR secara berkala agar selalu siap pakai.
                    </p>
                </div>

                <!-- Fitur 2 -->
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <img src="assets/img/Landing/ChatGPT Image Aug 21, 2025, 10_43_34 AM.png" alt="Fitur"
                        class="w-14 mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Laporan Digital</h3>
                    <p class="mt-2 text-gray-600">Semua laporan pengecekan tersimpan rapi dan bisa diakses kapan saja.
                    </p>
                </div>

                <!-- Fitur 3 -->
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <img src="assets/img/Landing/ChatGPT Image Aug 21, 2025, 10_44_34 AM.png" alt="Fitur"
                        class="w-14 mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Notifikasi Otomatis</h3>
                    <p class="mt-2 text-gray-600">Dapatkan pengingat otomatis untuk pengecekan dan perawatan APAR.</p>
                </div>

                <!-- Fitur 4 -->
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <img src="assets/img/Landing/f3dc9622-5930-4659-9395-6b72ff2123f3.png" alt="Fitur"
                        class="w-14 mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">QR Code Scanner</h3>
                    <p class="mt-2 text-gray-600">Akses data pengecekan APAR lebih cepat dengan memindai QR Code pada
                        perangkat.</p>
                </div>

                <!-- Fitur 5 -->
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <img src="assets/img/Landing/ChatGPT Image 23 Agu 2025, 23.45.17.png" alt="Fitur"
                        class="w-14 mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Manajemen Pengguna & Admin</h3>
                    <p class="mt-2 text-gray-600">Kelola peran pengguna dan admin dengan akses yang terstruktur dan
                        aman.</p>
                </div>

                <!-- Fitur 6 -->
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <img src="assets/img/Landing/ChatGPT Image 23 Agu 2025, 23.46.07.png" alt="Fitur"
                        class="w-14 mx-auto mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Visualisasi Data</h3>
                    <p class="mt-2 text-gray-600">Pantau hasil pengecekan dengan grafik interaktif untuk analisis yang
                        lebih mudah.</p>
                </div>

            </div>
        </div>
    </section>

 

    <!-- Tambah di atas </body>, setelah FOOTER -->
    <div >
        <!-- FOOTER -->
        <footer class="bg-gray-900 text-gray-300 py-10">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Logo & Deskripsi -->
                <div>
                    <h2 class="text-2xl font-bold text-white">Pengecekan APAR & HYDRANT</h2>
                    <p class="mt-3 text-gray-400 text-sm">
                        Sistem digital untuk memudahkan pengecekan dan pelaporan APAR & HYDRANT
                        secara efisien, cepat, dan terstruktur.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold text-white">Navigasi</h3>
                    <ul class="mt-3 space-y-2 text-sm">

                        <li><a href="#" @click.prevent="openModal = 'about'"
                                class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" @click.prevent="openModal = 'services'"
                                class="hover:text-white transition">Layanan</a></li>
                        <li><a href="#" @click.prevent="openModal = 'privacy'"
                                class="hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#" @click.prevent="openModal = 'help'"
                                class="hover:text-white transition">Bantuan</a></li>
                        <li><a href="#" @click.prevent="openModal = 'contact'"
                                class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>


                <!-- Kontak & Sosial Media -->
                <div>
                    <h3 class="text-lg font-semibold text-white">Kontak</h3>
                    <ul class="mt-3 text-sm space-y-2">
                        <li>Email: <a href="mailto:support@gmail.com" class="hover:text-white">support@gmail.com</a></li>
                        <li>Telp: <a href="https://wa.me/6282125098439" class="hover:text-white">+62 821-2509-8439</a></li>
                        <!-- <li>Alamat: Jl. Industri No. 45, Jakarta</li> -->
                    </ul>

                    <!-- Sosial Media -->
                    <div class="flex gap-4 mt-4">
                        <!-- Facebook -->
                        <a href="#" aria-label="Facebook" class="transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600 hover:text-blue-700"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1 .9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.3l-.4 3h-1.9v7A10 10 0 0 0 22 12Z" />
                            </svg>
                        </a>

                        <!-- Instagram -->
                        <a href="https://www.instagram.com/__dhkprtma/" aria-label="Instagram" class="transition"
                            target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hover:opacity-80"
                                viewBox="0 0 24 24">
                                <defs>
                                    <linearGradient id="igGradient" x1="0" y1="0" x2="1"
                                        y2="1">
                                        <stop offset="0%" stop-color="#f09433" />
                                        <stop offset="25%" stop-color="#e6683c" />
                                        <stop offset="50%" stop-color="#dc2743" />
                                        <stop offset="75%" stop-color="#cc2366" />
                                        <stop offset="100%" stop-color="#bc1888" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#igGradient)"
                                    d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7Zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10Zm-5 3.5A5.5 5.5 0 1 0 17.5 13 5.5 5.5 0 0 0 12 7.5Zm0 2A3.5 3.5 0 1 1 8.5 13 3.5 3.5 0 0 1 12 9.5Zm4.5-3a1 1 0 1 0 1 1 1 1 0 0 0-1-1Z" />
                            </svg>
                        </a>

                        <!-- LinkedIn -->
                        <a href="https://linkedIn.com" aria-label="LinkedIn" class="transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500 hover:text-blue-600"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M4.98 3.5C4.98 4.6 4.1 5.5 3 5.5s-2-.9-2-2 1-2 2-2 2 .9 2 2Zm.02 4H1v14h4V7.5Zm6.5 0h-4v14h4v-7c0-1.7.7-2.5 2-2.5s2 .8 2 2.5v7h4v-7.5c0-3.5-2-5.5-5-5.5s-3 .7-3 1v-1Z" />
                            </svg>
                        </a>

                        <!-- WhatsApp Flat (tanpa outline putih) -->
                        <a href="https://wa.me/6282125098439?text=Halo%20saya%20mau%20tanya" aria-label="WhatsApp"
                            target="_blank" class="transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                class="w-6 h-6 hover:opacity-80">
                                <path fill="#25D366"
                                    d="M16 .5C7.4.5.5 7.4.5 16c0 3 .8 5.8 2.3 8.3L2 32l8.1-2.6c2.1 1.1 4.5 1.7 6.9 1.7 8.6 0 15.5-6.9 15.5-15.5S24.6.5 16 .5z" />
                                <path fill="#fff"
                                    d="M24.2 19.5c-.4-.2-2.2-1.1-2.5-1.2-.3-.1-.5-.2-.7.2-.2.4-.9 1.2-1.1 1.4-.2.2-.4.3-.8.1-2.3-1-3.8-3.4-3.9-3.6-.2-.4 0-.6.2-.8.2-.2.4-.5.6-.7.2-.2.3-.3.5-.6.2-.3.1-.5 0-.7-.1-.2-.7-1.9-1-2.6-.3-.7-.6-.6-.8-.6h-.7c-.2 0-.6.1-.9.4-.3.3-1.1 1-1.1 2.4s1.1 2.7 1.3 2.9c.2.3 2.1 3.2 5.1 4.5.7.3 1.2.5 1.7.7.7.2 1.3.2 1.8.1.6-.1 1.9-.8 2.2-1.5.3-.7.3-1.3.2-1.5-.2-.2-.5-.3-.9-.5z" />
                            </svg>
                        </a>

                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm text-gray-400">
                &copy; 2025 Pengecekan APAR & HYDRANT. All rights reserved. | v1.0.0
            </div>
        </footer>



        <!-- BACKDROP -->
        <template x-if="openModal">
            <div class="fixed inset-0 backdrop-blur-md bg-black/20 flex items-center justify-center z-50"
                x-show="openModal" x-transition.opacity>

                <!-- Modal Box -->
                <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-8 relative transform transition-all duration-300"
                    x-show="openModal" x-transition.scale>

                    <!-- Tombol Close -->
                    <button @click="openModal = null"
                        class="absolute top-3 right-3 bg-gray-200 hover:bg-red-500 hover:text-white text-gray-600 rounded-full w-8 h-8 flex items-center justify-center shadow-md transition">
                        ✕
                    </button>

                    <!-- Tentang Kami -->
                    <div x-show="openModal === 'about'" class="space-y-4">
                        <h2 class="text-2xl font-bold text-gray-800">Tentang Kami</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Aplikasi <b>Pengecekan APAR</b> membantu perusahaan melakukan monitoring dan pengecekan APAR
                            berbasis QR Code agar lebih cepat, efisien, dan terdokumentasi.
                        </p>
                    </div>

                    <!-- Layanan -->
                    <div x-show="openModal === 'services'" class="space-y-4">
                        <h2 class="text-2xl font-bold text-gray-800">Layanan</h2>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Monitoring kondisi APAR</li>
                            <li>Pemeriksaan via QR Code Scanner</li>
                            <li>Laporan otomatis & riwayat pengecekan</li>
                            <li>Notifikasi masa kadaluarsa</li>
                            <li>Manajemen user & admin</li>
                        </ul>
                    </div>

                    <!-- Kebijakan Privasi -->
                    <div x-show="openModal === 'privacy'" class="space-y-4">
                        <h2 class="text-2xl font-bold text-gray-800">Kebijakan Privasi</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Kami menghargai privasi pengguna. Data hanya digunakan untuk kepentingan monitoring APAR
                            dan tidak akan dibagikan kepada pihak ketiga tanpa izin resmi.
                        </p>
                    </div>

                    <!-- Bantuan -->
                    <div x-show="openModal === 'help'" class="space-y-4">
                        <h2 class="text-2xl font-bold text-gray-800">Bantuan</h2>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li><b>Cara scan QR?</b> Arahkan kamera ke QR Code APAR.</li>
                            <li><b>QR tidak terbaca?</b> Pastikan pencahayaan cukup & ulangi.</li>
                            <li><b>Bisa lewat HP?</b> Ya, bisa diakses via browser HP.</li>
                        </ul>
                    </div>

                    <!-- Kontak -->
                    <div x-show="openModal === 'contact'" class="space-y-4">
                        <h2 class="text-2xl font-bold text-gray-800">Kontak</h2>
                        <p class="text-gray-600">
                            📧 <b>Email:</b> <a href="mailto:support@gmail.com" class="hover:text-blue-500">support@gmail.com </a><br>
                            📞 <b>Telp:</b><a href="https://wa.me/6282125098439" target="_blank" class="hover:text-green-500"> +62 821-2509-8439 </a><br>
                            {{-- 📍 <b>Alamat:</b> Jl. Industri No. 45, Jakarta --}}
                        </p>
                    </div>

                    <div x-show="openModal === 'learn'" class="space-y-4">
    <h2 class="text-2xl font-bold text-gray-800">Pengecekan APAR & Hydrant</h2>
    <p class="text-gray-600">
        🔹 <b>APAR (Alat Pemadam Api Ringan):</b> Pastikan APAR dalam kondisi baik, tekanan normal, dan tidak kedaluwarsa.<br>
        🔹 <b>Hydrant Indoor & Outdoor:</b> Periksa selang, nozzle, dan katup agar siap digunakan.<br>
        🔹 <b>Langkah Pengecekan:</b> 
        <ol class="list-decimal ml-5 mt-1">
            <li>Periksa fisik APAR/hydrant.</li>
            <li>Cek tekanan dan tabung/apparatus.</li>
            <li>Pastikan label dan masa berlaku masih aktif.</li>
            <li>Catat hasil pengecekan untuk laporan.</li>
        </ol>
    </p>
</div>


                </div>
            </div>
        </template>

    </div>
    <script type="text/javascript" class="position-absolute bottom-0 end-0 m-10 p-20">
window.$crisp=[];
window.CRISP_WEBSITE_ID="fdecfd29-7a93-46a0-9de3-373f32841ca5";
(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();
</script>
    <script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="7WqBzJUCl-zj_uEEaS0G4";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>

    <!-- Tambahin AlpineJS di layout -->
    <script src="//unpkg.com/alpinejs" defer></script>


<!-- Modal -->
<div id="guestModal" 
     class="fixed inset-0 hidden bg-gradient-to-br from-black/70 via-gray-900/80 to-black/70 backdrop-blur-lg z-50 transition-opacity duration-500 ease-out flex items-center justify-center">
  <div class="bg-white/10 backdrop-blur-2xl rounded-3xl shadow-[0_0_50px_rgba(99,102,241,0.5)] border border-white/20 w-full max-w-md transform transition-all duration-500 scale-95 opacity-0 translate-y-10"
       id="guestModalContent">
       
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 bg-gradient-to-r from-fuchsia-600 via-purple-600 to-indigo-600 rounded-t-3xl shadow-lg">
      <h2 class="text-xl font-bold text-white tracking-wide flex items-center gap-2 drop-shadow-lg">
        <!-- Heroicon: Key -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-fuchsia-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 100-4 2 2 0 000 4zm0 0v10m0 0l-3-3m3 3l3-3"/>
        </svg>
        Masuk sebagai Tamu
      </h2>
      <button onclick="closeModal()" 
              class="text-white/80 hover:text-white text-2xl transition-transform transform hover:rotate-90">✕</button>
    </div>
    
    <!-- Body -->
    <div class="p-8">
      <form action="guest_auth.php" method="POST" class="space-y-8">
        
        <!-- Pilih lokasi -->
        <div class="relative">
          <!-- Heroicon: Map Pin -->
          <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-fuchsia-300 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3zm0 0c-4 0-6 2-6 4v3h12v-3c0-2-2-4-6-4z"/>
          </svg>
          <select id="lokasi" name="lokasi" required
            class="peer w-full rounded-xl border border-white/20 bg-white/10 px-10 pt-5 pb-2 text-white/90 placeholder-transparent shadow-md focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-400/60 focus:shadow-[0_0_15px_rgba(217,70,239,0.5)] transition appearance-none">
            <option value="" disabled selected hidden></option>
            <option class="text-gray-900" value="Bogor">Bogor</option>
            <option class="text-gray-900" value="Majalengka">Majalengka</option>
          </select>
          <label for="lokasi"
            class="absolute left-10 top-2 text-white/70 text-sm transition-all peer-placeholder-shown:top-5 peer-placeholder-shown:text-white/50 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-sm peer-focus:text-fuchsia-300">
            Pilih Lokasi
          </label>
          <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-white/60">▼</div>
        </div>

        <!-- Kode lokasi -->
        <div class="relative">
          <!-- Heroicon: Lock -->
          <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-indigo-300 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7a4 4 0 00-8 0v4m8 0h4v10H8V11h4z"/>
          </svg>
          <input id="kode" type="password" name="kode" placeholder=" " required
            class="peer w-full rounded-xl border border-white/20 bg-white/10 px-10 pt-5 pb-2 text-white/90 shadow-md placeholder-transparent focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/60 focus:shadow-[0_0_15px_rgba(79,70,229,0.5)] transition"/>
          <label for="kode"
            class="absolute left-10 top-2 text-white/70 text-sm transition-all peer-placeholder-shown:top-5 peer-placeholder-shown:text-white/50 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-sm peer-focus:text-indigo-300">
            Masukkan Kode Lokasi
          </label>
        </div>

        <!-- Tombol -->
        <div class="pt-2">
          <button type="submit"
            class="w-full bg-gradient-to-r from-fuchsia-500 via-purple-600 to-indigo-600 text-white font-semibold px-5 py-3 rounded-xl shadow-[0_0_25px_rgba(168,85,247,0.7)] hover:shadow-[0_0_40px_rgba(168,85,247,1)] hover:scale-[1.05] transition-all duration-300 flex items-center justify-center gap-2">
            <!-- Heroicon: Rocket -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3l7 7-4 4-7-7 4-4zM2 21l6-6m0 0l4 4-6 6-4-4z"/>
            </svg>
            Lanjutkan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function openModal() {
    const overlay = document.getElementById('guestModal');
    const content = document.getElementById('guestModalContent');
    overlay.classList.remove('hidden');
    overlay.classList.add('flex');
    
    setTimeout(() => {
      content.classList.remove('opacity-0', 'translate-y-10', 'scale-95');
      content.classList.add('opacity-100', 'translate-y-0', 'scale-100');
    }, 50);
  }

  function closeModal() {
    const overlay = document.getElementById('guestModal');
    const content = document.getElementById('guestModalContent');
    content.classList.add('opacity-0', 'translate-y-10', 'scale-95');
    content.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
    setTimeout(() => {
      overlay.classList.add('hidden');
      overlay.classList.remove('flex');
    }, 300);
  }
</script>



</body>

</html>