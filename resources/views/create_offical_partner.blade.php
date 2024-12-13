<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Offical Partner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Create New Offical Partner</h1>
                    <form action="{{ route('store_offical') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="mb-4">
                            <label for="partner_name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input type="text" name="partner_name" id="partner_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
        <label for="partner_img" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
        <input type="file" name="partner_img" id="partner_img" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Offical Partner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>