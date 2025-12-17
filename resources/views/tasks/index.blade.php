<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">My Tasks</h2>
                <p class="text-sm text-gray-600 mt-1">Manage your daily tasks efficiently</p>
            </div>
            @if(auth()->user()->canCreateTask())
                <a href="{{ route('tasks.create') }}"
                   class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Task
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Subscription Status Card --}}
            <div class="mb-6">
                @if(auth()->user()->isPremium())
                    <div class="bg-gradient-to-r from-amber-400 via-yellow-500 to-amber-600 rounded-2xl shadow-xl p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                                <div class="text-white">
                                    <p class="font-bold text-lg">Premium Member</p>
                                    <p class="text-sm text-white/90">Unlimited tasks • Expires {{ auth()->user()->subscription->expired_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="hidden sm:block">
                                <span class="bg-white/30 backdrop-blur-sm px-4 py-2 rounded-full text-white font-semibold text-sm">
                                    ✨ Active
                                </span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-semibold">FREE PLAN</span>
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 max-w-xs">
                                        <div class="bg-indigo-600 h-2 rounded-full transition-all duration-300" style="width: {{ ($taskCount / 10) * 100 }}%"></div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600">
                                    <span class="font-bold text-gray-900">{{ $taskCount }} of 10</span> tasks used
                                </p>
                                @if($taskCount >= 10)
                                    <p class="text-sm text-red-600 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        Task limit reached! Upgrade to continue.
                                    </p>
                                @endif
                            </div>
                            <a href="{{ route('pricing') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg font-semibold text-sm whitespace-nowrap">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Upgrade Now
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Messages --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-green-800 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-red-800 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            {{-- Tasks List --}}
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                @if($tasks->isEmpty())
                    <div class="text-center py-16 px-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No tasks yet</h3>
                        <p class="text-gray-600 mb-6 max-w-sm mx-auto">Get started by creating your first task and stay organized!</p>
                        @if(auth()->user()->canCreateTask())
                            <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg font-semibold">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create Your First Task
                            </a>
                        @endif
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($tasks as $task)
                            <div class="p-5 hover:bg-gray-50 transition-colors duration-150 group">
                                <div class="flex items-start gap-4">
                                    {{-- Checkbox --}}
                                    <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="flex-shrink-0 mt-1">
                                        @csrf
                                        <button type="submit" class="focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-full">
                                            @if($task->isCompleted())
                                                <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center transition-all duration-200 hover:bg-green-600">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="w-6 h-6 border-2 border-gray-300 rounded-full hover:border-indigo-500 transition-colors duration-200"></div>
                                            @endif
                                        </button>
                                    </form>

                                    {{-- Task Content --}}
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-base font-semibold {{ $task->isCompleted() ? 'line-through text-gray-400' : 'text-gray-900' }} mb-1">
                                            {{ $task->title }}
                                        </h3>
                                        @if($task->description)
                                            <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ $task->description }}</p>
                                        @endif
                                        <div class="flex items-center gap-3 text-xs">
                                            @if($task->due_date)
                                                <span class="inline-flex items-center {{ $task->isOverdue() ? 'text-red-600 font-semibold' : 'text-gray-500' }}">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ $task->due_date->format('M d, Y') }}
                                                    @if($task->isOverdue())
                                                        <span class="ml-1">(Overdue)</span>
                                                    @endif
                                                </span>
                                            @endif
                                            <span class="inline-flex items-center px-2 py-1 rounded-full {{ $task->isCompleted() ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                {{ $task->isCompleted() ? 'Completed' : 'Pending' }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <a href="{{ route('tasks.edit', $task) }}"
                                           class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200"
                                           title="Edit task">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200"
                                                    title="Delete task">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
