<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lanjutkan Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-2">Detail Transaksi</h3>
                        <p class="text-gray-600">Order ID: <strong>{{ $transaction->midtrans_order_id ?? '-' }}</strong></p>
                        <p class="text-gray-600">Jumlah: <strong>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</strong></p>
                        <p class="text-gray-600">Status:
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </p>
                    </div>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Pembayaran Anda masih menunggu. Klik tombol di bawah untuk melanjutkan proses pembayaran.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <button id="pay-button" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Lanjutkan Pembayaran
                        </button>
                        <form action="{{ route('subscription.cancel-transaction', $transaction->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batalkan Transaksi
                            </button>
                        </form>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap Script -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    window.location.href = '{{ route("subscription.finish", $transaction->id) }}';
                },
                onPending: function(result){
                    window.location.href = '{{ route("subscription.finish", $transaction->id) }}';
                },
                onError: function(result){
                    alert('Pembayaran gagal. Silakan coba lagi.');
                    window.location.href = '{{ route("dashboard") }}';
                },
                onClose: function(){
                    console.log('Popup ditutup');
                }
            });
        };
    </script>
</x-app-layout>
