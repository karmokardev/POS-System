@extends('layouts.app')

@section('title', 'Brand Management')

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
                        <h2 class="text-2xl font-bold">Brand Management</h2>

                        <a href="{{ route('brands.create') }}"
                            class="px-4 py-2 bg-brand-500 text-white rounded hover:bg-brand-600">
                            + Add Brand
                        </a>
                    </div>

                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-3">S.No</th>
                                    <th class="p-3">Logo</th>
                                    <th class="p-3">Name</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($brands as $key => $brand)
                                    <tr class="border-t hover:bg-gray-50">

                                        <td class="p-3">{{ $key + 1 }}</td>

                                        <td class="p-3">
                                            @if($brand->logo)
                                                <img src="{{ asset('storage/' . $brand->logo) }}"
                                                    class="w-12 h-12 rounded object-cover">
                                            @else
                                                <span class="text-gray-400 text-sm">No Logo</span>
                                            @endif
                                        </td>

                                        <td class="p-3 font-medium">{{ $brand->name }}</td>

                                        <td class="p-3">
                                            @if($brand->status == 'Active')
                                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm">
                                                    Active
                                                </span>
                                            @else
                                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>

                                        <td class="p-3 flex gap-2">
                                            <a href="{{ route('brands.edit', $brand->id) }}"
                                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded text-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-4 text-center text-gray-500">
                                            No Brands Found
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