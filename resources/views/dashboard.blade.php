@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mb-8">
        <!-- Cards for Summary -->
        <div class="bg-white shadow-md rounded p-4">
            <h2 class="text-lg font-bold">Total Users</h2>
            <p class="text-2xl">{{ $userCount }}</p>
        </div>
        <div class="bg-white shadow-md rounded p-4">
            <h2 class="text-lg font-bold">Total Tasks</h2>
            <p class="text-2xl">{{ $taskCount }}</p>
        </div>
        <div class="bg-white shadow-md rounded p-4">
            <h2 class="text-lg font-bold">Total Daily Tasks</h2>
            <p class="text-2xl">{{ $dailyTaskCount }}</p>
        </div>
        <div class="bg-white shadow-md rounded p-4">
            <h2 class="text-lg font-bold">Total Offical Tasks</h2>
            <p class="text-2xl">{{ $officalTask }}</p>
        </div>
    </div>

    <!-- Graph Section -->
    <div class="bg-white shadow-md rounded p-4">
    <canvas id="dashboardChart"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for the chart
        const data = {
            labels: ['Users', 'Tasks', 'Daily Tasks' , 'Offical Tasks'], // Labels for each category
            datasets: [{
                label: 'Overview',
                data: [{{ $userCount }}, {{ $taskCount }}, {{ $dailyTaskCount }} , {{$officalTask}} ], // Data values
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)', // Blue
                    'rgba(236, 66, 245, 0.6)', // Yellow
                    'rgba(245, 191, 66, 0.6)',  // Green
                    'rgba(30, 55, 110 , 0.6)'  // Green
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(236, 66, 245, 1)',
                    'rgba(245, 191, 66, 1)',
                    'rgba(30, 55, 110 , 1)'
                ],
                borderWidth: 1
            }]
        };

        // Configuration options
        const config = {
            type: 'bar', // You can change this to 'line', 'pie', etc.
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Admin Dashboard Overview'
                    }
                }
            },
        };

        // Render the chart
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        new Chart(ctx, config);
    </script>
@endsection
