<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between items-center" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($user->first_name)}} {{ __($user->last_name)}}
            
        </h2>
        <h2>
        @if ($user->last_active_at && $user->last_active_at->gt(now()->subMinutes(5)))
        <span style = "color : rgb(4, 209, 8);" class="text-green-800 font-bold">Online</span>
    @elseif ($user->last_active_at)
        <span class="text-gray-500">{{ $user->last_active_at->diffForHumans() }}</span>
    @else
        <span style = "color : rgb(240, 43, 22);" class="text-gray-500">Never Active</span>
    @endif
        </h2>
        </div>
    </x-slot>


    <!-- User Details  -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">User Details <span></span> </h1>
                    <div class="w-full  grid grid-cols-2 " >
                            <div  >
                              First Name  :   {{ $user->first_name}}
                            </div>
                            <div>
                              Last Name  :   {{ $user->last_name}}
                            </div>
                            <div>Telegram Id : {{ $user->telegram_id}} </div>
                            <div>Balance : {{ $user->balance}} </div>
                            <div>Referrals : {{ $user->balance}}</div>
                            <div>Payment Verification :    @if ($user->payment_verified)
  <span style = "color : rgb(4, 209, 8);" class = " font-bold" >Verified </span>
    @else
    <span style = "color : rgb(240, 43, 22);" class = " font-bold" >  Not Verified</span>

    @endif</div>
                            <div>Offical Tasks : {{ $tasksStatus['completed_tasks']}} / {{ $tasksStatus['all_tasks']}}</div>
                            <div> Tasks : {{ $earnTasks['completed_tasks'] }} / {{ $earnTasks['all_tasks'] }} </div>
                            <div> Daily Tasks : {{ $dailytasksStatus['completed_tasks'] }} / {{ $dailytasksStatus['all_tasks'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>



       <!-- Daily Tasks  -->

       <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4"> Daily Tasks <span></span> </h1>
                    <div style = "display: flex; justify-content: space-around; align-items: center;" >

<div style = "width:50%" >
    <canvas id="DailyTasksChart"></canvas>
</div>
<div style = "width : 50% ; gap : 30px ; display : flex; flex-direction : column ; align-items : end " >
    <h1 style = " font : bold ; color : white ; font-size : 20px ; display : flex; justify-content : center ; align-items : center; width : 70%; background-color : rgb(74, 72, 72); padding : 20px 0px; border-radius : 20px" > All Tasks : {{ $dailytasksStatus['all_tasks'] }}</h1>
    <h1 style = " font : bold ; color : white ; font-size : 20px ; display : flex; justify-content : center ; align-items : center; width : 70%; background-color : rgb(74, 72, 72); padding : 20px 0px; border-radius : 20px" >Completed Tasks : {{ $dailytasksStatus['completed_tasks'] }}</h1>
    <h1 style = " font : bold ; color : white ; font-size : 20px ; display : flex; justify-content : center ; align-items : center; width : 70%; background-color : rgb(74, 72, 72); padding : 20px 0px; border-radius : 20px" >Remaining Tasks : {{ $dailytasksStatus['remaining_tasks'] }}</h1>
    
</div>
</div>
                        
                    
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get task data from the server-side (Laravel Blade syntax)
        const DailytaskData = {
            allTasks: {{ $dailytasksStatus['all_tasks'] }},
            completedTasks: {{ $dailytasksStatus['completed_tasks'] }},
            remainingTasks: {{ $dailytasksStatus['remaining_tasks'] }}
        };

        // Get the context of the canvas element
        const ctx = document.getElementById('DailyTasksChart').getContext('2d');

        // Create a new Chart instance
        new Chart(ctx, {
            type: 'pie', // Set the chart type to 'bar'
            data: {
                labels: ['Completed Tasks', 'Remaining Tasks'], // Labels for the chart
                datasets: [{
                    label: 'Tasks Status', // Label for the dataset
                    data: [DailytaskData.completedTasks, DailytaskData.remainingTasks], // Data from taskData
                    backgroundColor: ['#4caf50', '#f44336'], // Colors for completed and remaining tasks
                    borderColor: ['#388e3c', '#d32f2f'], // Border colors for each bar
                    borderWidth: 1 // Border width for each bar
                }]
            },
            options: {
                responsive: true, // Make the chart responsive
                plugins: {
                    legend: {
                        position: 'top', // Position of the legend
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                // Format the tooltip to display the task count
                                return context.label + ': ' + context.raw + ' tasks';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true // Ensure the y-axis starts from zero
                    }
                }
            }
        });
    });
</script>


    
    <!-- Tasks  -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Tasks <span></span> </h1>
                    <div style = "display: flex; justify-content: space-around; align-items: center;" >

<div style = "width:50%" >
    <canvas id="tasksChart"></canvas>
</div>
<div style = "width : 50% ; gap : 30px ; display : flex; flex-direction : column ; align-items : end " >
    <h1 style = " font : bold ; color : white ; font-size : 20px ; display : flex; justify-content : center ; align-items : center; width : 70%; background-color : rgb(74, 72, 72); padding : 20px 0px; border-radius : 20px" > All Tasks : {{ $earnTasks['all_tasks'] }}</h1>
    <h1 style = " font : bold ; color : white ; font-size : 20px ; display : flex; justify-content : center ; align-items : center; width : 70%; background-color : rgb(74, 72, 72); padding : 20px 0px; border-radius : 20px" >Completed Tasks : {{ $earnTasks['completed_tasks'] }}</h1>
    <h1 style = " font : bold ; color : white ; font-size : 20px ; display : flex; justify-content : center ; align-items : center; width : 70%; background-color : rgb(74, 72, 72); padding : 20px 0px; border-radius : 20px" >Remaining Tasks : {{ $earnTasks['remaining_tasks'] }}</h1>
    
</div>
</div>
                </div>
            </div>
        </div>
    </div>

   
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const taskData = {
        allTasks: {{ $earnTasks['all_tasks'] }},
        completedTasks: {{ $earnTasks['completed_tasks'] }},
        remainingTasks: {{ $earnTasks['remaining_tasks'] }}
    };

    const ctx = document.getElementById('tasksChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Completed Tasks', 'Remaining Tasks'],
            datasets: [{
                label: 'Tasks Status',
                data: [taskData.completedTasks, taskData.remainingTasks],
                backgroundColor: ['#4caf50', '#f44336'],
                borderColor: ['#388e3c', '#d32f2f'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.label + ': ' + context.raw + ' tasks';
                        }
                    }
                }
            }
        }
    });
});

</script>


    <!-- Offical Tasks  -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Offical Tasks <span></span> </h1>
                    <div style = "display: flex; justify-content: space-around; align-items: center;" >

                        <div style = "width:50%" >
                            <canvas id="OfficaltasksChart"></canvas>
                        </div>
                        <div style = "width : 50% ; gap : 30px ; display : flex; flex-direction : column ; align-items : end " >
                            <h1 style = " font : bold ; color : white ; font-size : 20px ; display : flex; justify-content : center ; align-items : center; width : 70%; background-color : rgb(74, 72, 72); padding : 20px 0px; border-radius : 20px" > All Offical Tasks : {{ $tasksStatus['all_tasks'] }}</h1>
                            <h1 style = " font : bold ; color : white ; font-size : 20px ; display : flex; justify-content : center ; align-items : center; width : 70%; background-color : rgb(74, 72, 72); padding : 20px 0px; border-radius : 20px" >Completed Offical Tasks : {{ $tasksStatus['completed_tasks'] }}</h1>
                            <h1 style = " font : bold ; color : white ; font-size : 20px ; display : flex; justify-content : center ; align-items : center; width : 70%; background-color : rgb(74, 72, 72); padding : 20px 0px; border-radius : 20px" >Remaining Offical Tasks : {{ $tasksStatus['remaining_tasks'] }}</h1>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const tasksData = {
        allTasks: {{ $tasksStatus['all_tasks'] }},
        completedTasks: {{ $tasksStatus['completed_tasks'] }},
        remainingTasks: {{ $tasksStatus['remaining_tasks'] }}
    };

    const ctx = document.getElementById('OfficaltasksChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Completed Tasks', 'Remaining Tasks'],
            datasets: [{
                label: 'Official Tasks Status',
                data: [tasksData.completedTasks, tasksData.remainingTasks],
                backgroundColor: ['#4caf50', '#f44336'],
                borderColor: ['#388e3c', '#d32f2f'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.label + ': ' + context.raw + ' tasks';
                        }
                    }
                }
            }
        }
    });
});

</script>



    <!-- Payment Details  -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Payment Details <span></span> </h1>
                    <div class="w-full  grid grid-cols-2 " >
                            <div  >
                              First Name  :   {{ $user->first_name}}
                            </div>
                            <div>
                              Last Name  :   {{ $user->last_name}}
                            </div>
                            <div>Telegram Id : {{ $user->telegram_id}} </div>
                            <div>Balance : {{ $user->balance}} </div>
                            <div>Referrals : {{ $user->balance}}</div>
                            <div>Payment Method : {{ $user->balance}}</div>
                            <div>Offical Tasks : {{ $user->balance}}</div>
                            <div> Tasks : {{ $user->balance}}</div>
                            <div> Daily Tasks : {{ $user->balance}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</x-app-layout>

