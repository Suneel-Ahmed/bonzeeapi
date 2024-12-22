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
  <style>
    input[type="radio"] {
        display: none;
    }

    label {
        cursor: pointer;
        margin-right: 10px;
    }

    #toggleButton {
        margin-top: 10px;
        padding: 10px 20px;
        font-size: 16px;
    }

    #on:checked + label {
        font-weight: bold;
        color: green;
    }

    #off:checked + label {
        font-weight: bold;
        color: red;
    }
</style>

<div class = 'shadow-md'  style = ' padding : 20px 10px ; margin : 30px 0px; align-items: center; display: flex; justify-content : space-between; ' >
    <h1  style = 'font-size : 20px; font-weight: bold; ' >
        Easypaisa And JaazCash Feature
    </h1>
    <form action="{{ route('toggleLock') }}" method="POST">
    @csrf
    <div>
        <input type="radio" id="on" name="locked" value="1" onchange="this.form.submit()" 
            @if($lockStatus && $lockStatus[0]->locked == 1) checked @endif>
        <label for="on">On</label>

        <input type="radio" id="off" name="locked" value="0" onchange="this.form.submit()" 
            @if($lockStatus && $lockStatus[0]->locked == 0) checked @endif>
        <label for="off">Off</label>
    </div>
</form>
<script>
    const toggleButton = document.getElementById('toggleButton');
    const onRadio = document.getElementById('on');
    const offRadio = document.getElementById('off');

    toggleButton.addEventListener('click', () => {
        if (onRadio.checked) {
            onRadio.checked = false;
            offRadio.checked = true;
            toggleButton.textContent = "Off";
        } else {
            offRadio.checked = false;
            onRadio.checked = true;
            toggleButton.textContent = "On";
        }
    });
</script>

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
