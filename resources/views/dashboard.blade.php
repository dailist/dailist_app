<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-gray-800">Dashboard</h2>
            <p class="text-sm text-gray-600 mt-1">Welcome back! Here's your overview</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Welcome Banner --}}
            <div class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-3xl shadow-2xl p-8 mb-8 overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold text-white mb-2">
                        Hello, {{ auth()->user()->name }}! 👋
                    </h3>
                    <p class="text-indigo-100 text-lg">Ready to boost your productivity with DaiList Pro?</p>
                </div>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Total Tasks --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-blue-100 rounded-xl p-3">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-500">Total</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ auth()->user()->tasks->count() }}</p>
                    <p class="text-sm text-gray-600 mt-1">All tasks</p>
                </div>

                {{-- Completed Tasks --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-green-100 rounded-xl p-3">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-500">Done</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ auth()->user()->tasks->where('status', 'completed')->count() }}</p>
                    <p class="text-sm text-gray-600 mt-1">Completed tasks</p>
                </div>

                {{-- Subscription Plan --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="{{ auth()->user()->isPremium() ? 'bg-yellow-100' : 'bg-gray-100' }} rounded-xl p-3">
                            <svg class="w-7 h-7 {{ auth()->user()->isPremium() ? 'text-yellow-600' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-500">Plan</span>
                    </div>
                    <p class="text-3xl font-bold {{ auth()->user()->isPremium() ? 'text-yellow-600' : 'text-gray-900' }}">
                        {{ auth()->user()->isPremium() ? 'Premium' : 'Free' }}
                    </p>
                    <p class="text-sm text-gray-600 mt-1">Current subscription</p>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Create Task Card --}}
                <a href="{{ route('tasks.create') }}" class="group bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-xl hover:border-indigo-300 transition-all duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-indigo-100 group-hover:bg-indigo-200 rounded-xl p-4 transition-colors duration-200">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors duration-200">Create New Task</h3>
                            <p class="text-sm text-gray-600">Add a new task to your list</p>
                        </div>
                    </div>
                </a>

                {{-- View Tasks Card --}}
                <a href="{{ route('tasks.index') }}" class="group bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-xl hover:border-purple-300 transition-all duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-purple-100 group-hover:bg-purple-200 rounded-xl p-4 transition-colors duration-200">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-purple-600 transition-colors duration-200">View All Tasks</h3>
                            <p class="text-sm text-gray-600">Manage and organize your tasks</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Pending Payment Alert --}}
            @php
                $pendingTransaction = auth()->user()->transactions()->where('status', 'pending')->latest()->first();
            @endphp
            @if($pendingTransaction)
                <div class="mb-8 bg-yellow-50 border-l-4 border-yellow-400 rounded-lg p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <h3 class="text-lg font-semibold text-yellow-800">Pending Payment</h3>
                            <p class="mt-1 text-sm text-yellow-700">
                                You have a pending payment for Premium subscription ({{ $pendingTransaction->amount }}).
                                Please complete your payment or it will be automatically cancelled.
                            </p>
                            <div class="mt-4 flex gap-3">
                                <form action="{{ route('subscription.continue', $pendingTransaction->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        Continue Payment
                                    </button>
                                </form>
                                <form action="{{ route('subscription.cancel-transaction', $pendingTransaction->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this payment?')">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                                        Cancel
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Upgrade Banner (for Free users) --}}
            @if(!auth()->user()->isPremium())
                <div class="mt-8 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl shadow-xl p-8">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="text-white">
                            <h3 class="text-2xl font-bold mb-2">Upgrade to Premium</h3>
                            <p class="text-purple-100 mb-4">Unlock unlimited tasks and premium features for just Rp 50.000/month</p>
                            <ul class="space-y-2 text-sm text-purple-100">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Unlimited tasks
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Priority support
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Advanced features
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('pricing') }}" class="inline-flex items-center px-8 py-4 bg-white text-purple-600 rounded-xl hover:bg-gray-50 transition-all duration-200 shadow-lg hover:shadow-xl font-bold text-lg whitespace-nowrap">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Upgrade Now
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
