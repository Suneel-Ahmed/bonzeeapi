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
                            <div>Offical Tasks : {{ $user->balance}}</div>
                            <div> Tasks : {{ $user->balance}}</div>
                            <div> Daily Tasks : {{ $user->balance}}</div>
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
                            <div>Offical Tasks : {{ $user->balance}}</div>
                            <div> Tasks : {{ $user->balance}}</div>
                            <div> Daily Tasks : {{ $user->balance}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    
    <!-- Tasks  -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Tasks <span></span> </h1>
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




    <!-- Offical Tasks  -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Offical Tasks <span></span> </h1>
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

