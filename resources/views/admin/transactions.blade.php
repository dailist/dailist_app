<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">Transaction History</h2>
                <p class="text-sm text-gray-600 mt-1">Monitor all payment transactions</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">
                ← Back to Admin Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Revenue Summary --}}
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl shadow-xl p-8 mb-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm mb-2">Total Revenue (Success)</p>
                        <p class="text-4xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Filter --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 mb-6">
                <form method="GET" action="{{ route('admin.transactions') }}" class="flex flex-col md:flex-row gap-4">

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All Status</option>
                            <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>Success</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-semibold">
                            Filter
                        </button>
                        <a href="{{ route('admin.transactions') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-semibold">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            {{-- Transactions Table --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="font-bold text-lg text-gray-900">
                        All Transactions ({{ $transactions->total() }})
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($transactions as $transaction)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">#{{ $transaction->id }}</div>
                                        @if($transaction->midtrans_transaction_id)
                                            <div class="text-xs text-gray-500">{{ Str::limit($transaction->midtrans_transaction_id, 20) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                                <span class="text-indigo-600 font-semibold text-xs">{{ substr($transaction->user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $transaction->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $transaction->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-700">{{ $transaction->payment_type ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $transaction->status === 'success' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $transaction->status === 'failed' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $transaction->status === 'expired' ? 'bg-gray-100 text-gray-800' : '' }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $transaction->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $transaction->created_at->format('H:i') }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                        No transactions found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $transactions->appends(request()->query())->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
