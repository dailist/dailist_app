<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upgrade to Premium') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-lg p-8">

                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Upgrade ke Premium</h1>
                    <p class="text-gray-600">Dapatkan akses unlimited tasks dan fitur eksklusif lainnya!</p>
                </div>

                <!-- Order Summary -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl p-6 mb-8">
                    <h3 class="font-bold text-lg text-gray-900 mb-4">Detail Pembayaran</h3>

                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Paket</span>
                            <span class="font-semibold text-gray-900">Premium Plan</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Durasi</span>
                            <span class="font-semibold text-gray-900">1 Bulan</span>
                        </div>
                        <div class="border-t border-gray-300 pt-3 flex justify-between">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-extrabold text-indigo-600">Rp 50.000</span>
                        </div>
                    </div>
                </div>

                <!-- Benefits Reminder -->
                <div class="mb-8">
                    <h3 class="font-bold text-lg text-gray-900 mb-4">✨ Yang Anda Dapatkan:</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700"><strong>Unlimited tasks</strong> - Buat task sebanyak yang Anda mau</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700"><strong>Priority support</strong> - Bantuan cepat 24/7</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700"><strong>Akses fitur baru</strong> - Early access ke fitur terbaru</span>
                        </li>
                    </ul>
                </div>

                <!-- Payment Button (akan integrate dengan Midtrans) -->
                <button type="button" id="pay-button" class="w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:from-indigo-600 hover:via-purple-600 hover:to-pink-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200">
                    💳 Bayar Sekarang - Rp 50.000
                </button>

                <p class="text-center text-sm text-gray-500 mt-4">
                    🔒 Pembayaran aman dan terenkripsi melalui Midtrans
                </p>

                <div class="mt-6 text-center">
                    <a href="{{ route('pricing') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                        ← Kembali ke Pricing
                    </a>
                </div>

            </div>

            <!-- Payment Methods Info -->
            <div class="mt-8 bg-white rounded-xl shadow-md p-6">
                <h3 class="font-bold text-lg text-gray-900 mb-4 text-center">Metode Pembayaran yang Tersedia</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-semibold text-gray-700">Transfer Bank</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-semibold text-gray-700">GoPay</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-semibold text-gray-700">OVO</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-semibold text-gray-700">Kartu Kredit</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.getElementById('pay-button');

        payButton.addEventListener('click', async function() {
            payButton.disabled = true;
            payButton.innerHTML = '⏳ Processing...';

            try {
                // Request snap token from backend
                const response = await fetch('{{ route('subscription.payment') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();

                if (data.snap_token) {
                    // Open Midtrans Snap popup
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            // Redirect to finish URL to verify and update status
                            window.location.href = '/subscription/finish/' + data.transaction_id;
                        },
                        onPending: function(result) {
                            alert('Pembayaran pending. Silakan selesaikan pembayaran Anda.');
                            window.location.href = '{{ route('pricing') }}';
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal. Silakan coba lagi.');
                            payButton.disabled = false;
                            payButton.innerHTML = '💳 Bayar Sekarang - Rp 50.000';
                        },
                        onClose: function() {
                            payButton.disabled = false;
                            payButton.innerHTML = '💳 Bayar Sekarang - Rp 50.000';
                        }
                    });
                } else {
                    alert('Error: ' + (data.error || 'Gagal membuat transaksi'));
                    payButton.disabled = false;
                    payButton.innerHTML = '💳 Bayar Sekarang - Rp 50.000';
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
                payButton.disabled = false;
                payButton.innerHTML = '💳 Bayar Sekarang - Rp 50.000';
            }
        });
    </script>
</x-app-layout>
