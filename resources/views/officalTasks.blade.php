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
                    <a href="{{ route('view_create_offical_tasks') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create New Offical</a>
                    <table class=" table-auto w-full ">
                        <thead>
                            <tr class = "text-center " >
                                <th class ="px-5" >ID</th>
                                <th class ="px-5" >Name</th>
                                <th class ="px-5" >link</th>
                                <th class ="px-5" >code</th>
                                <th class ="px-5" >image</th>
                                <th class ="px-5" >Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offical as $offical)
                                <tr class ="text-left " >
                                    <td class ="px-5" >{{ $offical->id }}</td>
                                    <td class ="px-5" >{{ $offical->name }}</td>
                                    <td class ="px-5" >{{ $offical->link }}</td>
                                    <td class ="px-5" >{{ $offical->code }}</td>
                                    <td class ="px-5" >
                                    <div style= "width : 100%; display: flex ; justify-content: center;" >

                                        <img src="{{ $offical->image }}" alt="image" style = "width : 30px; height : auto">
                                    </div>    
                                        </td>
                                    <td class="px-5 flex justify-center py-3 ">
                    <form  action="{{ route('view_offical_tasks', $offical->id) }}" method="GET" class="inline mx-5">
                        <button type="submit" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </button>
                    </form>
                    <form  action="{{ route('delete_offical_tasks', $offical->id) }}"   method="POST" class="inline mx-5" onsubmit="return confirm('Are you sure you want to delete this mission?');">
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
