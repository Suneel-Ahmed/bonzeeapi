<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[50rem] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Task List</h1>
                    <a href="{{ route('create_task') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create New Task</a>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action Name</th>
                                <th>Description</th>
                                <th>Link</th>
                                <th>Reward Coins</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->action_name }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->link }}</td>
                                <td>{{ $task->reward_coins }}</td>
                                <td class="px-5 flex justify-center py-3 ">
                    <form action="{{ route('update_view_task', $task->id) }}" method="GET" class="inline mx-5">
                        <button type="submit" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </button>
                    </form>
                    <form action="{{ route('delete_task', $task->id) }}"  method="POST" class="inline mx-5" onsubmit="return confirm('Are you sure you want to delete this mission?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>