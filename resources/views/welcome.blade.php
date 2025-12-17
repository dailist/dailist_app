<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DaiList Pro - Task Management Made Simple</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-gray-50 to-indigo-50 min-h-screen">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-md shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo.png') }}" alt="DaiList Pro" class="h-10 w-10">
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        DaiList Pro
                    </h1>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition-all duration-200">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-5xl md:text-6xl font-bold mb-6">
                <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Manage Your Tasks
                </span>
                <br>
                <span class="text-gray-800">Effortlessly</span>
            </h2>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Tingkatkan produktivitas Anda dengan DaiList Pro. Kelola tugas harian dengan mudah, upgrade ke Premium untuk fitur unlimited!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-xl transition-all duration-200">
                    Mulai Gratis
                </a>
                <a href="#pricing" class="bg-white text-indigo-600 px-8 py-4 rounded-lg text-lg font-semibold border-2 border-indigo-600 hover:bg-indigo-50 transition-all duration-200">
                    Lihat Harga
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <h3 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">
                Fitur Unggulan
            </h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-6 rounded-2xl bg-gradient-to-br from-indigo-50 to-purple-50 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Task Management</h4>
                    <p class="text-gray-600">Buat, edit, dan hapus task dengan mudah. Kelola semua aktivitas harian Anda dalam satu tempat.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 rounded-2xl bg-gradient-to-br from-indigo-50 to-purple-50 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Premium Features</h4>
                    <p class="text-gray-600">Upgrade ke Premium untuk unlimited tasks dan fitur-fitur eksklusif lainnya.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 rounded-2xl bg-gradient-to-br from-indigo-50 to-purple-50 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Admin Dashboard</h4>
                    <p class="text-gray-600">Dashboard admin lengkap untuk monitoring user dan transaksi subscription.</p>
                </div>

                <!-- Feature 4 -->
                <div class="p-6 rounded-2xl bg-gradient-to-br from-indigo-50 to-purple-50 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Deadline Tracking</h4>
                    <p class="text-gray-600">Set deadline untuk setiap task dan jangan lewatkan tugas penting Anda.</p>
                </div>

                <!-- Feature 5 -->
                <div class="p-6 rounded-2xl bg-gradient-to-br from-indigo-50 to-purple-50 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Secure Payment</h4>
                    <p class="text-gray-600">Integrasi dengan Midtrans untuk pembayaran yang aman dan terpercaya.</p>
                </div>

                <!-- Feature 6 -->
                <div class="p-6 rounded-2xl bg-gradient-to-br from-indigo-50 to-purple-50 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Responsive Design</h4>
                    <p class="text-gray-600">Akses dari device apapun - desktop, tablet, atau smartphone.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 px-4 bg-gradient-to-br from-gray-50 to-indigo-50">
        <div class="max-w-7xl mx-auto">
            <h3 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">
                Cara Kerjanya
            </h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">
                        1
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Daftar Gratis</h4>
                    <p class="text-gray-600">Buat akun dan mulai dengan paket Free - maksimal 10 tasks.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">
                        2
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Kelola Tasks</h4>
                    <p class="text-gray-600">Tambahkan tasks, set deadline, dan pantau progress Anda.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">
                        3
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Upgrade Premium</h4>
                    <p class="text-gray-600">Butuh lebih? Upgrade ke Premium hanya Rp 50.000/bulan!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <h3 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">
                Pilih Paket Anda
            </h3>
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Free Plan -->
                <div class="p-8 rounded-2xl border-2 border-gray-200 hover:border-indigo-300 transition-all duration-200">
                    <h4 class="text-2xl font-bold mb-2 text-gray-800">Free</h4>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-800">Rp 0</span>
                        <span class="text-gray-600">/bulan</span>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Maksimal 10 tasks
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Fitur dasar task management
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Deadline tracking
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full text-center bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-all duration-200">
                        Mulai Gratis
                    </a>
                </div>

                <!-- Premium Plan -->
                <div class="p-8 rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 text-white relative hover:shadow-2xl transition-all duration-200">
                    <div class="absolute top-0 right-0 bg-yellow-400 text-gray-800 px-4 py-1 rounded-bl-lg rounded-tr-lg text-sm font-bold">
                        Popular
                    </div>
                    <h4 class="text-2xl font-bold mb-2">Premium</h4>
                    <div class="mb-6">
                        <span class="text-4xl font-bold">Rp 50.000</span>
                        <span class="text-indigo-100">/bulan</span>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Unlimited tasks
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Semua fitur task management
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Priority support
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Fitur eksklusif mendatang
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full text-center bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition-all duration-200">
                        Upgrade Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 bg-gradient-to-r from-indigo-600 to-purple-600">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h3 class="text-3xl md:text-4xl font-bold mb-6">
                Siap meningkatkan produktivitas Anda?
            </h3>
            <p class="text-xl mb-8 text-indigo-100">
                Bergabunglah dengan ribuan pengguna yang sudah merasakan manfaatnya!
            </p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-indigo-50 transition-all duration-200">
                Daftar Sekarang - Gratis!
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h5 class="text-white font-bold text-lg mb-4">DaiList Pro</h5>
                    <p class="text-sm">Task management solution untuk produktivitas maksimal.</p>
                </div>
                <div>
                    <h6 class="text-white font-semibold mb-4">Product</h6>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Features</a></li>
                        <li><a href="#pricing" class="hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="text-white font-semibold mb-4">Company</h6>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="text-white font-semibold mb-4">Legal</h6>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Privacy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Security</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} DaiList Pro. Made with ❤️ for productivity.</p>
            </div>
        </div>
    </footer>

</body>
</html>
