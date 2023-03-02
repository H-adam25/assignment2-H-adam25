<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tasks') }}</h1>
            <div class="inline-flex space-x-2 items-center">
                <a href="{{ route('tasks.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <svg class="mr-2 h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    <span class="text-sm font-medium text-white hidden md:block">New Task</span>
                </a>

                <a href="{{ route('tasks.index', ['filter' => 'urgent']) }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 h-5 w-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium text-white hidden md:block">Urgent</span>
                </a>

                <a href="{{ route('tasks.index', ['filter' => 'latest']) }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-white-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <span class="text-sm font-medium hidden md:block">Latest</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach($tasks as $task)
                <li class="px-4 py-4 sm:px-0">
                    <a href="{{ route('tasks.show', $task->id) }}" class="relative pb-8">
                        <div class="relative flex space-x-3">
                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                <div>
                                    <p class="">{{ $task->name }}</p>
                                    @if ($task->completed_at)
                                    <p class="text-sm text-gray-500">Completed at: <time datetime="{{ $task->completed_at }}">{{ $task->completed_at->format('jS F Y \\a\\t h:i:s A') }}</time></p>
                                    @else
                                    <p class="text-sm text-gray-500">Due Date: <time datetime="{{ $task->due_date }}">{{ $task->due_date }}</time></p>
                                    @endif
                                </div>
                                <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                    <a href="{{ route('tasks.show', $task->id) }}"
                                        class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-white-500 focus:ring-offset-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('tasks.destroy', ['task' => $task]) }}" class="inline-flex items-center justify-center">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach

                @if ($tasks->count() === 0)
                <li class="px-4 py-4 sm:px-0">
                    <div class="relative flex space-x-3">
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                            <div>
                                <p class="text-sm font-large text-gray-900 truncate">
                                    {!! request()->query("filter") ? 'No tasks created for filter: <u>'. request()->query("filter") .'</u>'  : 'No tasks created.' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
                @endif
            </ul>
            @if (request()->query("filter") && $tasks->count() > 0)
            <p class="text-xs text-slate-500 text-center">
                <a href="{{ route('tasks.index') }}" class="text-slate-500 hover:text-slate-700">View all tasks</a>
            </p>
            @endif
        </div>
    </div>
</x-app-layout>
