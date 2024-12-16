<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Offical Partners') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Offical Partners List</h1>
                    <a href="{{ route('create_offical') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create New Offical Partner</a>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($offical as $offical)
                                <tr class ="text-center " >
                                    <td class ="px-5" >{{ $offical->id }}</td>
                                    <td class ="px-5" >{{ $offical->partner_name }}</td>
                                    <td class ="px-5 " > 
                                        <div class = "w-full flex justify-center" >

                                            <img src="{{$offical->partner_img}}" alt="image" style = "width : 30px; height : auto">
                                        </div> 
                                     </td>
                                    <td class ="px-5 flex justify-center gap-4" > 
                                    <form action="{{ route('update_view_offical', $offical->id) }}" method="GET" class="inline">
                        <button type="submit" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i> 
                        </button>
                    </form>
                    <form action="{{ route('delete_offical', $offical->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this mission?');">
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