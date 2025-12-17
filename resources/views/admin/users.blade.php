<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">User Management Test</h2>
                <p class="text-sm text-gray-600 mt-1">View and filter all registered users</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">
                ← Back to Admin Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Filters --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 mb-6">
                <form method="GET" action="{{ route('admin.users') }}" class="flex flex-col md:flex-row gap-4">

                    {{-- Search --}}
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Name or email..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    {{-- Plan Filter --}}
                    <div class="w-full md:w-48">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Plan Type</label>
                        <select name="plan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="all" {{ request('plan') === 'all' ? 'selected' : '' }}>All Plans</option>
                            <option value="free" {{ request('plan') === 'free' ? 'selected' : '' }}>Free</option>
                            <option value="premium" {{ request('plan') === 'premium' ? 'selected' : '' }}>Premium</option>
                        </select>
                    </div>

                    {{-- Submit --}}
                    <div class="flex items-end gap-2">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-semibold">
                            Filter
                        </button>
                        <a href="{{ route('admin.users') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-semibold">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            {{-- Users Table --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="font-bold text-lg text-gray-900">
                        All Users ({{ $users->total() }})
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tasks</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $user->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                                <span class="text-indigo-600 font-semibold text-sm">{{ substr($user->name, 0, 1) }}</span>
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
                                            <span class="text-sm text-gray-500">No plan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->subscription && $user->subscription->plan_type === 'premium')
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->subscription->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($user->subscription->status) }}
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->tasks->count() }} tasks</div>
                                        @if($user->subscription && $user->subscription->plan_type === 'free')
                                            <div class="text-xs text-gray-500">{{ $user->tasks->count() }}/10</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>{{ $user->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                        No users found
                                    </td>
                                </tr>
                            @endforelse
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
