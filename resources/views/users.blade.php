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
                                    <td>
    @if ($user->payment_verified)
  <span style = "color : rgb(4, 209, 8);" class = " font-bold" >Verified </span>
    @else
    <span style = "color : rgb(240, 43, 22);" class = " font-bold" >  Not Verified</span>

    @endif
</td>
                                    <td>{{ $user->balance }}</td>
                                    <td>
    @if ($user->last_active_at && $user->last_active_at->gt(now()->subMinutes(5)))
        <span style = "color : rgb(4, 209, 8);" class="text-green-800 font-bold">Online</span>
    @elseif ($user->last_active_at)
        <span class="text-gray-500">{{ $user->last_active_at->diffForHumans() }}</span>
    @else
        <span style = "color : rgb(240, 43, 22);" class="text-gray-500">Never Active</span>
    @endif
</td>
                                    <td> <a href="{{ route('each_user_view', $user->id) }}"><i class="fas fa-eye"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
