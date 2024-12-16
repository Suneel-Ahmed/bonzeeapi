<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">User List</h1>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Chat ID</th>
                                <th>Username</th>
                                <th>Payout</th>
                                <th>Balance Coins</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class = "text-center">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->telegram_id }}</td>
                                    <td>{{ $user->first_name }}{{ $user->last_name }}</td>
                                    <td>Verify | Not Verify</td>
                                    <td>{{ $user->balance }}</td>
                                    <td>
    @if ($user->last_active_at && $user->last_active_at->gt(now()->subMinutes(5)))
        <span class="text-green-500 font-bold">Online</span>
    @elseif ($user->last_active_at)
        <span class="text-gray-500">{{ $user->last_active_at->diffForHumans() }}</span>
    @else
        <span class="text-gray-500">Never Active</span>
    @endif
</td>
                                    <td>View</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
