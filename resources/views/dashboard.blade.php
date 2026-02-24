@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
    <section class="font-sans h-screen overflow-hidden">
        <div class="flex h-full">

            <!-- Sidebar -->
            @include('sidebar.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                @include('header.header')
                <div>
                    dashboard
                </div>
            </div>
        </div>
    </section>
@endsection