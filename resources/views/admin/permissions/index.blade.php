@extends('layouts.app')
@section('title', 'permissions Management')
@section('content')
    <section class="font-sans h-screen overflow-hidden">
        <div class="flex h-full">

            <!-- Sidebar -->
            @include('sidebar.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                @include('header.header')
                <div class="p-6 h-screen overflow-y-auto">

                    <h2 class="text-2xl font-bold mb-6">Permission Management</h2>

                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="flex gap-6">

                        {{-- Create Permission --}}
                        <div class="bg-white shadow w-full rounded p-6 mb-8">
                            <h3 class="font-semibold mb-4">Create Permission</h3>

                            <form action="{{ route('permissions.store') }}" method="POST" class="flex gap-4">
                                @csrf
                                <input type="text" name="name" class="flex-1 border rounded px-4 py-2"
                                    placeholder="Enter Permission Name" required>

                                <button class="bg-blue-600 text-white px-6 py-2 rounded">
                                    Create
                                </button>
                            </form>
                        </div>

                        {{-- Permission List --}}
                        <div class="bg-white shadow w-full rounded p-6 mb-8">
                            <h3 class="font-semibold mb-4">All Permissions</h3>

                            <table class="w-full border">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-4 py-2">ID</th>
                                        <th class="border px-4 py-2">Name</th>
                                        <th class="border px-4 py-2 w-48">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $permission->id }}.</td>

                                            <td class="border px-4 py-2">
                                                <form action="{{ route('permissions.update', $permission->id) }}" method="POST"
                                                    class="flex gap-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="name" value="{{ $permission->name }}"
                                                        class="border rounded px-2 py-1 w-full">
                                            </td>

                                            <td class="border px-4 py-2 text-center space-x-2">
                                                <button class="bg-green-500 text-white px-3 py-1 rounded text-sm">
                                                    Update
                                                </button>
                                                </form>

                                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Delete?')"
                                                        class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Assign Permission To Role --}}
                    <div class="bg-white shadow rounded p-6">
                        <h3 class="font-semibold mb-4">Assign Permission To Role</h3>
                        <div class="flex gap-6">
                            @foreach($roles as $role)
                                <div class="mb-6 border p-4 rounded w-full">

                                    <h4 class="font-semibold mb-3 text-blue-600">
                                        {{ $role->name }}
                                    </h4>

                                    <form action="{{ route('permissions.assign') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="role_id" value="{{ $role->id }}">

                                        <div class="grid grid-cols-3 gap-3">
                                            @foreach($permissions as $permission)
                                                <label class="flex items-center gap-2">
                                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                    <span>{{ $permission->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>

                                        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                                            Update
                                        </button>
                                    </form>

                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection