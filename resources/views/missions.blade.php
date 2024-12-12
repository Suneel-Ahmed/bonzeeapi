<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Offical') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Offical List</h1>
                    <a href="{{ route('create_mission') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create New Offical</a>
                    <table class=" table-auto w-full ">
                        <thead>
                            <tr class = "text-left " >
                                <th class ="px-5" >ID</th>
                                <th class ="px-5" >Name</th>
                                <th class ="px-5" >link</th>
                                <th class ="px-5" >code</th>
                                <th class ="px-5" >image</th>
                                <th class ="px-5" >Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mission as $mission)
                                <tr class ="text-left " >
                                    <td class ="px-5" >{{ $mission->id }}</td>
                                    <td class ="px-5" >{{ $mission->name }}</td>
                                    <td class ="px-5" >{{ $mission->link }}</td>
                                    <td class ="px-5" >{{ $mission->code }}</td>
                                    <td class ="px-5" > <img src="{{ $mission->image }}" alt="image" style = "width : 30px; height : auto"> </td>
                                    <td class ="px-5 flex justify-between" > 
                                    <form action="{{ route('view_update_mission', $mission->id) }}" method="GET" class="inline">
                        <button type="submit" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i> 
                        </button>
                    </form>
                    <form action="{{ route('delete_mission', $mission->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this mission?');">
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
