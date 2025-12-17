<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pricing Plans') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Pilih Paket yang Sesuai untuk Anda</h1>
                <p class="text-lg text-gray-600">Upgrade ke Premium untuk fitur unlimited dan lebih banyak kemudahan</p>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg">
                    {{ session('info') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Pricing Cards -->
            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">

                <!-- Free Plan -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-gray-200 hover:shadow-xl transition-shadow duration-200">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Free Plan</h3>
                        <div class="flex items-baseline justify-center">
                            <span class="text-5xl font-extrabold text-gray-900">Rp 0</span>
                            <span class="text-gray-500 ml-2">/bulan</span>
                        </div>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Maksimal <strong>10 tasks</strong></span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Fitur dasar task management</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Prioritas & due date</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span class="text-gray-400">Unlimited tasks</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span class="text-gray-400">Priority support</span>
                        </li>
                    </ul>

                    @if(!auth()->user()->isPremium())
                        <div class="bg-gray-100 text-gray-600 py-3 px-4 rounded-lg text-center font-semibold">
                            Paket Aktif Saat Ini
                        </div>
                    @else
                        <button disabled class="w-full bg-gray-300 text-gray-500 py-3 px-4 rounded-lg font-semibold cursor-not-allowed">
                            Paket Free
                        </button>
                    @endif
                </div>

                <!-- Premium Plan -->
                <div class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-2xl p-8 border-2 border-indigo-400 hover:shadow-3xl transition-shadow duration-200 relative overflow-hidden">

                    <!-- Popular Badge -->
                    <div class="absolute top-4 right-4 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-bold">
                        🔥 POPULAR
                    </div>

                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-white mb-2">Premium Plan</h3>
                        <div class="flex items-baseline justify-center">
                            <span class="text-5xl font-extrabold text-white">Rp 50.000</span>
                            <span class="text-indigo-100 ml-2">/bulan</span>
                        </div>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white font-semibold">✨ Unlimited tasks</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white">Semua fitur Free Plan</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white">Priority support 24/7</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white">Advanced analytics (Coming Soon)</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white">Team collaboration (Coming Soon)</span>
                        </li>
                    </ul>

                    @if(auth()->user()->isPremium())
                        <div class="bg-white/20 backdrop-blur-sm text-white py-3 px-4 rounded-lg text-center font-semibold border border-white/30">
                            ✅ Paket Aktif Saat Ini
                        </div>
                        <form action="{{ route('subscription.cancel') }}" method="POST" class="mt-3" onsubmit="return confirm('Yakin ingin membatalkan langganan Premium?')">
                            @csrf
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg font-semibold transition-colors duration-200">
                                Batalkan Langganan
                            </button>
                        </form>
                    @else
                        <a href="{{ route('subscription.upgrade') }}" class="block w-full bg-white text-indigo-600 py-3 px-4 rounded-lg text-center font-bold hover:bg-indigo-50 transition-colors duration-200 shadow-lg">
                            🚀 Upgrade ke Premium
                        </a>
                    @endif
                </div>

            </div>

            <!-- FAQ Section -->
            <div class="mt-16 max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Pertanyaan Umum</h2>

                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">💳 Bagaimana cara pembayaran?</h3>
                        <p class="text-gray-600">Kami menerima pembayaran melalui Midtrans dengan berbagai metode: Transfer Bank, E-wallet (GoPay, OVO), dan Kartu Kredit.</p>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">🔄 Bisakah saya downgrade ke Free?</h3>
                        <p class="text-gray-600">Ya, Anda bisa membatalkan langganan kapan saja. Setelah periode berakhir, akun otomatis kembali ke Free Plan.</p>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">📅 Apakah ada kontrak jangka panjang?</h3>
                        <p class="text-gray-600">Tidak ada kontrak! Langganan bersifat bulanan dan bisa dibatalkan kapan saja tanpa penalti.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
