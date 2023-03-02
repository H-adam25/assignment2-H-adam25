<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ $task->name }}</h1>
            <div class="inline-flex space-x-2 items-center">
                @if (is_null($task->completed_at))
                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-white-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                    <span class="text-sm font-medium hidden md:block">Edit</span>
                </a>

                <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="completed" value="1">
                    <button type="submit" class="inline-flex items-center justify-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 h-5 w-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium text-white hidden md:block">Complete</span>
                    </button>
                </form>
                @endif

                <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 h-5 w-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        <span class="text-sm font-medium text-white hidden md:block">Delete</span>
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
            <div class="md:flex md:items-center md:justify-between md:space-x-4 xl:border-b xl:pb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $task->name}}</h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Created by <a href="#" class="font-medium text-gray-900">{{ $task->user->name }}</a>
                    </p>
                </div>
            </div>
            <aside class="mt-8 mb-8">
                <div class="space-y-5">
                    {{-- <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 001.28.53l3.58-3.579a.78.78 0 01.527-.224 41.202 41.202 0 005.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0010 2zm0 7a1 1 0 100-2 1 1 0 000 2zM8 8a1 1 0 11-2 0 1 1 0 012 0zm5 1a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium text-gray-900">4 comments</span>
                    </div> --}}
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Created: <time class="text-gray-500" datetime="{{ $task->created_at }}">{{ $task->created_at->diffForHumans() }}</time></span>
                    </div>
                    @if ($task->completed_at)
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Completed on: <time class="text-gray-500" datetime="{{ $task->completed_at }}">{{ $task->completed_at->format('l, jS F Y \\a\\t h:i:s A') }}</time></span>
                    </div>
                    @endif
                    <div>
                        <h2 class="text-sm font-medium text-gray-500 inline">Priority</h2>
                        <a href="#" class="relative inline-flex items-center rounded-full border border-gray-300 px-3 py-0.5">
                            <div class="absolute flex flex-shrink-0 items-center justify-center">
                                @php
                                    $priority = [
                                        'low' => 'bg-green-500',
                                        'medium' => 'bg-yellow-500',
                                        'high' => 'bg-red-500',
                                    ];

                                @endphp
                                <span class="h-1.5 w-1.5 rounded-full {{ $priority[$task->priority] }}" aria-hidden="true"></span>
                            </div>
                            <div class="ml-3.5 text-sm font-medium text-gray-900">{{ Str::ucfirst($task->priority) }}</div>
                        </a>
                    </div>
                </div>
            </aside>
            <div class="border-t py-3 xl:pt-6 xl:pb-0">
                <h2 class="sr-only">Description</h2>
                <div class="prose max-w-none">
                    {{ $task->description }}
                </div>
            </div>
            {{-- <section aria-labelledby="activity-title" class="mt-8 xl:mt-10">
                <div>
                    <div class="divide-y divide-gray-200">
                        <div class="pb-4">
                            <h2 id="activity-title" class="text-lg font-medium text-gray-900">Activity</h2>
                        </div>
                        <div class="pt-6">
                            <!-- Activity feed-->
                            <div class="flow-root">
                                <ul role="list" class="-mb-8">
                                    <li>
                                        <div class="relative pb-8">
                                            <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200"
                                                aria-hidden="true"></span>
                                            <div class="relative flex items-start space-x-3">
                                                <div class="relative">
                                                    <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white"
                                                        src="https://images.unsplash.com/photo-1520785643438-5bf77931f493?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80"
                                                        alt="">

                                                    <span
                                                        class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px">
                                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 001.28.53l3.58-3.579a.78.78 0 01.527-.224 41.202 41.202 0 005.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0010 2zm0 7a1 1 0 100-2 1 1 0 000 2zM8 8a1 1 0 11-2 0 1 1 0 012 0zm5 1a1 1 0 100-2 1 1 0 000 2z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div>
                                                        <div class="text-sm">
                                                            <a href="#" class="font-medium text-gray-900">Eduardo
                                                                Benz</a>
                                                        </div>
                                                        <p class="mt-0.5 text-sm text-gray-500">Commented 6d ago</p>
                                                    </div>
                                                    <div class="mt-2 text-sm text-gray-700">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Tincidunt nunc ipsum tempor purus vitae id. Morbi in
                                                            vestibulum nec varius. Et diam cursus quis sed purus
                                                            nam.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="relative pb-8">
                                            <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200"
                                                aria-hidden="true"></span>
                                            <div class="relative flex items-start space-x-3">
                                                <div>
                                                    <div class="relative px-1">
                                                        <div
                                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white">
                                                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                                                                fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="min-w-0 flex-1 py-1.5">
                                                    <div class="text-sm text-gray-500">
                                                        <a href="#" class="font-medium text-gray-900">Hilary
                                                            Mahy</a>
                                                        assigned
                                                        <a href="#" class="font-medium text-gray-900">Kristin
                                                            Watson</a>
                                                        <span class="whitespace-nowrap">2d ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="relative pb-8">
                                            <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200"
                                                aria-hidden="true"></span>
                                            <div class="relative flex items-start space-x-3">
                                                <div>
                                                    <div class="relative px-1">
                                                        <div
                                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white">
                                                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                                                                fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                    d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="min-w-0 flex-1 py-0">
                                                    <div class="text-sm leading-8 text-gray-500">
                                                        <span class="mr-0.5">
                                                            <a href="#" class="font-medium text-gray-900">Hilary
                                                                Mahy</a>
                                                            added tags
                                                        </span>
                                                        <span class="mr-0.5">
                                                            <a href="#"
                                                                class="relative inline-flex items-center rounded-full border border-gray-300 px-3 py-0.5 text-sm">
                                                                <span
                                                                    class="absolute flex flex-shrink-0 items-center justify-center">
                                                                    <span
                                                                        class="h-1.5 w-1.5 rounded-full bg-rose-500"
                                                                        aria-hidden="true"></span>
                                                                </span>
                                                                <span
                                                                    class="ml-3.5 font-medium text-gray-900">Bug</span>
                                                            </a>
                                                            <a href="#"
                                                                class="relative inline-flex items-center rounded-full border border-gray-300 px-3 py-0.5 text-sm">
                                                                <span
                                                                    class="absolute flex flex-shrink-0 items-center justify-center">
                                                                    <span
                                                                        class="h-1.5 w-1.5 rounded-full bg-indigo-500"
                                                                        aria-hidden="true"></span>
                                                                </span>
                                                                <span
                                                                    class="ml-3.5 font-medium text-gray-900">Accessibility</span>
                                                            </a>
                                                        </span>
                                                        <span class="whitespace-nowrap">6h ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="relative pb-8">
                                            <div class="relative flex items-start space-x-3">
                                                <div class="relative">
                                                    <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white"
                                                        src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80"
                                                        alt="">

                                                    <span
                                                        class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px">
                                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 001.28.53l3.58-3.579a.78.78 0 01.527-.224 41.202 41.202 0 005.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0010 2zm0 7a1 1 0 100-2 1 1 0 000 2zM8 8a1 1 0 11-2 0 1 1 0 012 0zm5 1a1 1 0 100-2 1 1 0 000 2z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div>
                                                        <div class="text-sm">
                                                            <a href="#" class="font-medium text-gray-900">Jason
                                                                Meyers</a>
                                                        </div>
                                                        <p class="mt-0.5 text-sm text-gray-500">Commented 2h ago</p>
                                                    </div>
                                                    <div class="mt-2 text-sm text-gray-700">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Tincidunt nunc ipsum tempor purus vitae id. Morbi in
                                                            vestibulum nec varius. Et diam cursus quis sed purus
                                                            nam. Scelerisque amet elit non sit ut tincidunt
                                                            condimentum. Nisl ultrices eu venenatis diam.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-6">
                                <div class="flex space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="relative">
                                            <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white"
                                                src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80"
                                                alt="">

                                            <span
                                                class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px">
                                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 001.28.53l3.58-3.579a.78.78 0 01.527-.224 41.202 41.202 0 005.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0010 2zm0 7a1 1 0 100-2 1 1 0 000 2zM8 8a1 1 0 11-2 0 1 1 0 012 0zm5 1a1 1 0 100-2 1 1 0 000 2z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <form action="#">
                                            <div>
                                                <label for="comment" class="sr-only">Comment</label>
                                                <textarea id="comment" name="comment" rows="3"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 sm:text-sm"
                                                    placeholder="Leave a comment"></textarea>
                                            </div>
                                            <div class="mt-6 flex items-center justify-end space-x-4">
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-gray-900 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-black focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">Comment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
        </div>
    </div>
</x-app-layout>
