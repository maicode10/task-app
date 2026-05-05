<!DOCTYPE html>
<html>
<head>
    <title>Task App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-purple-50 min-h-screen">

<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg border border-purple-200">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-purple-700">Task Manager</h1>
        <form method="POST" action="/logout">
            @csrf
            <button class="bg-purple-600 hover:bg-purple-700 text-white text-sm px-4 py-2 rounded-lg">
                Logout
            </button>
        </form>
    </div>

    <!-- Add Task -->
    <form method="POST" action="/tasks" class="flex gap-2 mb-6">
        @csrf
        <input type="text" name="title"
            class="border border-purple-300 p-2 flex-1 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400"
            placeholder="New Task" required>
        <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 rounded-lg">
            Add
        </button>
    </form>

    <!-- Task List -->
    @foreach($tasks as $task)
    <div class="flex items-center justify-between mb-2 p-3 border border-purple-100 rounded-lg bg-purple-50">
        <form method="POST" action="/tasks/{{ $task->id }}">
            @csrf
            @method('PATCH')
            <button class="mr-2 text-purple-600 font-bold">
                {{ $task->is_done ? '✔' : '○' }}
            </button>
        </form>
        <span class="{{ $task->is_done ? 'line-through text-gray-400' : 'text-gray-700' }} flex-1">
            {{ $task->title }}
        </span>
        <form method="POST" action="/tasks/{{ $task->id }}">
            @csrf
            @method('DELETE')
            <button class="text-red-400 hover:text-red-600 text-sm">Delete</button>
        </form>
    </div>
    @endforeach

</div>
</body>
</html>