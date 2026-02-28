@extends('layouts.app')

@section('title', 'Category Management')

@section('content')
    <section class="font-sans h-screen overflow-hidden">
        <div class="flex h-full">

            @include('sidebar.sidebar')

            <div class="flex-1 flex flex-col">
                @include('header.header')
                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded transition-opacity duration-500">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="p-6 overflow-auto">

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Category Management</h2>

                        <a href="{{ route('categories.create') }}"
                            class="px-4 py-2 bg-brand-500 text-white rounded hover:bg-brand-600">
                            + Add Category
                        </a>
                    </div>

                    <!-- Category Table -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-3">S. No</th>
                                    <th class="p-3">Image</th>
                                    <th class="p-3">Name</th>
                                    <th class="p-3">Parent</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($categories as $key => $category)
                                    <tr class="border-t hover:bg-gray-50 transition">

                                        <td class="p-3">{{ $key + 1 }}.</td>

                                        <!-- Image -->
                                        <td class="p-3">
                                            @if($category->image)
                                                <img src="{{ asset('storage/' . $category->image) }}"
                                                    class="w-12 h-12 object-cover rounded">
                                            @else
                                                <span class="text-gray-400 text-sm">No Image</span>
                                            @endif
                                        </td>

                                        <!-- Name -->
                                        <td class="p-3 font-medium">
                                            {{ $category->name }}
                                        </td>

                                        <!-- Parent -->
                                        <td class="p-3">
                                            {{ $category->parent->name ?? 'Primary' }}
                                        </td>

                                        <!-- Status -->
                                        <td class="p-3">
                                            @if($category->status == 'Publish')
                                                <span class="px-2 py-1 text-sm bg-green-100 text-green-700 rounded">
                                                    Publish
                                                </span>
                                            @else($category->status == 'Inactive')
                                                <span class="px-2 py-1 text-sm bg-red-100 text-red-700 rounded">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Action -->
                                        <td class="p-3 flex gap-2">

                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                                Edit
                                            </a>

                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200">
                                                    Delete
                                                </button>
                                            </form>

                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-4 text-center text-gray-500">
                                            No categories found.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection