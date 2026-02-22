@extends('layouts.app')

@section('title', 'POS System')
@section('content')

    <div class="relative h-screen w-full overflow-hidden">

        <!-- Background Image -->
        <img src="{{ asset('images/home.jpg') }}" alt="Dashboard Image" class="absolute inset-0 w-full h-full object-cover">

        <!-- Dark Overlay-->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Text Content -->
        <div class="relative z-10 top-20 h-full text-center px-6">
            <div>
                <h1 class="text-4xl max-w-3xl mx-auto md:text-6xl font-bold text-white">
                    Bringing Earthy Warmth
                </h1>
                <p class="text-4xl md:text-6xl font-bold text-white mt-4">
                    <span class="typewriter">Home.</span>
                </p>

                <p class="text-lg md:text-xl text-gray-200 mt-4">
                    Modern designs shaped from nature’s most authentic material.
                </p>
            </div>
            <!-- login and register -->
            <div class="flex justify-center items-center gap-4 mt-6">
                <a href="{{ route('login') }}" class="inline-block bg-[#c3592b] text-white font-bold py-3 w-36 text-center rounded-lg 
                  transition-all duration-300 ease-in-out
                  hover:bg-[#a84a1e] 
                  hover:shadow-xl 
                  hover:scale-105 
                  hover:-translate-y-1">
                    Login
                </a>
                <a href="{{ route('register') }}" class="inline-block bg-[#c3592b] text-white font-bold py-3 w-36 text-center rounded-lg 
                  transition-all duration-300 ease-in-out
                  hover:bg-[#a84a1e] 
                  hover:shadow-xl 
                  hover:scale-105 
                  hover:-translate-y-1">
                    Register
                </a>
            </div>
        </div>


    </div>


    <style>
        .typewriter {
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
            border-right: 3px solid white;
            width: 0;
            animation: typing 3s steps(6, end) forwards, blink 0.7s infinite;
        }

        /* typing animation */
        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 6ch
            }

            /* 6 characters in "Dashboard." */
        }

        /* cursor blink */
        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }
    </style>
@endsection