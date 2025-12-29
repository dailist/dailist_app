<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">Admin Dashboard</h2>
                <p class="text-sm text-gray-600 mt-1">Monitor users, subscriptions, and revenue</p>
            </div>

            <span class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-4 py-2 rounded-lg font-semibold text-sm">
                👑 Admin Panel
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Statistics Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

                {{-- Total Users --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-blue-100 rounded-xl p-3">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-500">Total</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</p>
                    <p class="text-sm text-gray-600 mt-1">Registered Users</p>
                </div>

                {{-- Free Users --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-gray-100 rounded-xl p-3">
                            <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-500">Free</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['free_users']) }}</p>
                    <p class="text-sm text-gray-600 mt-1">Free Plan Users</p>
                </div>

                {{-- Premium Users --}}
                <div class="rounded-2xl shadow-xl p-6 text-white" style="background: linear-gradient(to bottom right, #fbbf24, #eab308, #f59e0b);">
                    <div class="flex items-center justify-between mb-4">
                        <div class="rounded-xl p-3" style="background-color: rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px);">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium" style="color: rgba(255, 255, 255, 0.9);">Premium</span>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ number_format($stats['premium_users']) }}</p>
                    <p class="text-sm mt-1" style="color: rgba(255, 255, 255, 0.9);">Premium Subscribers</p>
                </div>

                {{-- Total Tasks --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-purple-100 rounded-xl p-3">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-500">Tasks</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_tasks']) }}</p>
                    <p class="text-sm text-gray-600 mt-1">Total Tasks Created</p>
                </div>

                {{-- Total Revenue --}}
                <div class="rounded-2xl shadow-xl p-6 text-white" style="background: linear-gradient(to bottom right, #4ade80, #10b981);">
                    <div class="flex items-center justify-between mb-4">
                        <div class="rounded-xl p-3" style="background-color: rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px);">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium" style="color: rgba(255, 255, 255, 0.9);">All Time</span>
                    </div>
                    <p class="text-3xl font-bold text-white">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                    <p class="text-sm mt-1" style="color: rgba(255, 255, 255, 0.9);">Total Revenue</p>
                </div>

                {{-- Monthly Revenue --}}
                <div class="rounded-2xl shadow-xl p-6 text-white" style="background: linear-gradient(to bottom right, #6366f1, #9333ea);">
                    <div class="flex items-center justify-between mb-4">
                        <div class="rounded-xl p-3" style="background-color: rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px);">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium" style="color: rgba(255, 255, 255, 0.9);">This Month</span>
                    </div>
                    <p class="text-3xl font-bold text-white">Rp {{ number_format($stats['monthly_revenue'], 0, ',', '.') }}</p>
                    <p class="text-sm mt-1" style="color: rgba(255, 255, 255, 0.9);">Monthly Revenue</p>
                </div>

            </div>

            {{-- Visitor Chart (moved below statistics) --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-lg text-gray-900">Website Visitors (last 14 days)</h3>
                </div>
                <canvas id="visitorChart" height="120"></canvas>
            </div>

            {{-- Quick Links --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('admin.users') }}" class="group bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg hover:border-indigo-300 transition-all duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-indigo-100 group-hover:bg-indigo-200 rounded-xl p-3 transition-colors duration-200">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">Manage Users</h3>
                            <p class="text-sm text-gray-600">View & filter all users</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.transactions') }}" class="group bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg hover:border-green-300 transition-all duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-100 group-hover:bg-green-200 rounded-xl p-3 transition-colors duration-200">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 group-hover:text-green-600 transition-colors duration-200">Transactions</h3>
                            <p class="text-sm text-gray-600">View payment history</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('dashboard') }}" class="group bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg hover:border-purple-300 transition-all duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-purple-100 group-hover:bg-purple-200 rounded-xl p-3 transition-colors duration-200">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 group-hover:text-purple-600 transition-colors duration-200">User Dashboard</h3>
                            <p class="text-sm text-gray-600">Back to user view</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Recent Transactions --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="font-bold text-lg text-gray-900">Recent Transactions</h3>
                </div>
                <div class="overflow-x-auto w-full">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentTransactions as $transaction)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $transaction->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $transaction->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $transaction->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $transaction->status === 'success' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $transaction->status === 'failed' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $transaction->created_at->format('M d, Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        No transactions yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- All Users Table --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-lg text-gray-900">All Users</h3>
                        <a href="{{ route('admin.users') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                            View All →
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto w-full">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/5">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tasks</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                                <span class="text-indigo-600 font-semibold">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->subscription)
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->subscription->plan_type === 'premium' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($user->subscription->plan_type) }}
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->tasks->count() }} tasks
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function () {
            const ctx = document.getElementById('visitorChart');
            if (!ctx) return;

            const labels = @json($labels ?? []);
            const data = @json($data ?? []);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Visitors',
                        data: data,
                        fill: true,
                        backgroundColor: 'rgba(99,102,241,0.08)',
                        borderColor: 'rgba(99,102,241,1)',
                        tension: 0.25,
                        pointRadius: 3,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        })();
    </script>
@endpush
