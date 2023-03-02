<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
            <div class="min-w-0 flex-1">
                <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mt-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" value="{{ old('name') ?? $task->name }}" class="@error('name')border-red-300 @enderror block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="What is the name of your task?">
                            @error('name')
                            <p class="mt-2 text-sm text-red-600" id="name-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1">
                            <textarea name="description" id="description" rows="8" class="@error('description')border-red-300 @enderror block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="What is the description of your task?">{{ old('description') ?? $task->description }}</textarea>
                            @error('description')
                            <p class="mt-2 text-sm text-red-600" id="description-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                        <div class="mt-1">
                            <input type="datetime-local" name="due_date" id="due_date" min="{{ now()->format('Y-m-d\TH:i') }}" value="{{ old('due_date') ?? $task->due_date }}" class="@error('due_date')border-red-300 @enderror block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="What is the name of your task?">
                            @error('due_date')
                            <p class="mt-2 text-sm text-red-600" id="due-date-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                        <select id="priority" name="priority" class="@error('priority')border-red-300 @enderror mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            @foreach ($priorities as $key => $priority)
                                <option value="{{ $key }}"
                                @if ($key == old('priority', $task->priority))
                                    selected="selected"
                                @endif
                                >{{ $priority }}</option>
                            @endforeach
                        </select>
                        @error('priority')
                            <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-6 flex items-center justify-end space-x-4">
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Update Task</button>
                        <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                            class="inline-flex items-center justify-center rounded-md border border border-gray-300 bg-white px-4 py-2 text-sm font-medium shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-white-500 focus:ring-offset-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
