@extends('layouts.app')

@section('title', 'Roles Management')

@section('content')
    <section class="font-sans h-screen overflow-hidden">
        <div class="flex h-full">

            <!-- Sidebar -->
            @include('sidebar.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                @include('header.header')
                <div class="p-6">

                    <h2 class="text-2xl font-bold mb-6">Roles Management</h2>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded transition-opacity duration-500">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="flex gap-6">
                        <div class="bg-white w-full shadow rounded-lg p-6">
                            <h3 class="text-lg font-semibold mb-4">Create Role</h3>

                            <form action="{{ route('roles.store') }}" method="POST" class="flex gap-4">
                                @csrf

                                <input type="text" name="name" placeholder="Enter Role Name" required
                                    class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#F2CBB8]">

                                <button type="submit"
                                    class="bg-[#cd5c5c] text-white px-6 py-2 rounded hover:bg-[#a94a22] transition">
                                    Create
                                </button>
                            </form>
                        </div>
                        <div class="bg-white shadow w-full rounded-lg p-6">
                            <h3 class="text-lg font-semibold mb-4">Update Roles</h3>

                            <div class="overflow-x-auto">
                                <table class="min-w-full border border-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left border">ID</th>
                                            <th class="px-4 py-2 text-left border">All Role Name</th>
                                            <th class="px-4 py-2 text-center border w-56">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($roles as $role)
                                            <tr class="hover:bg-gray-50">

                                                <td class="px-4 py-2 border">
                                                    {{ $role->id }}
                                                </td>

                                                <td class="px-4 py-2 border">
                                                    <form action="{{ route('roles.update', $role->id) }}" method="POST"
                                                        class="flex gap-2">
                                                        @csrf
                                                        @method('PUT')

                                                        <input type="text" name="name" value="{{ $role->name }}"
                                                            class="border border-gray-300 rounded px-3 py-1 w-full focus:outline-none focus:ring-2 focus:ring-green-400">

                                                </td>

                                                <td class="px-4 py-2 border text-center space-x-2">

                                                    <button type="submit"
                                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition text-sm">
                                                        Update
                                                    </button>
                                                    </form>

                                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition text-sm">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach

                                        @if($roles->count() == 0)
                                            <tr>
                                                <td colspan="3" class="text-center py-4 text-gray-500">
                                                    No roles found.
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection