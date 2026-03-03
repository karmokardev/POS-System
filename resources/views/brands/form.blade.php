@extends('layouts.app')

@section('title', $brand->id ? 'Edit Brand' : 'Create Brand')

@section('content')
    <section class="font-sans h-screen overflow-hidden">
        <div class="flex h-full">

            @include('sidebar.sidebar')

            <div class="flex-1 flex flex-col">
                @include('header.header')

                <div class="p-6">

                    <div class="bg-white shadow rounded-lg p-6 max-w-xl">

                        <h2 class="text-xl font-bold mb-6">
                            {{ $brand->id ? 'Edit Brand' : 'Add Brand' }}
                        </h2>

                        <form action="{{ $brand->id
        ? route('brands.update', $brand->id)
        : route('brands.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @if($brand->id) @method('PUT') @endif

                            <div class="mb-4">
                                <label class="block mb-1 font-medium">Brand Name</label>
                                <input type="text" name="name" value="{{ old('name', $brand->name) }}"
                                    class="w-full border rounded px-3 py-2">
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1 font-medium">Logo</label>
                                <input type="file" name="logo" class="w-full border rounded px-3 py-2">

                                @if($brand->logo)
                                    <img src="{{ asset('storage/' . $brand->logo) }}" class="w-20 h-20 mt-2 rounded">
                                @endif
                            </div>

                            <div class="mb-6">
                                <label class="block mb-1 font-medium">Status</label>
                                <select name="status" class="w-full border rounded px-3 py-2">

                                    <option value="Active" {{ old('status', $brand->status) == 'Active' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="Inactive" {{ old('status', $brand->status) == 'Inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>
                            </div>

                            <button type="submit" class="px-5 py-2 bg-blue-500 text-white rounded hover:bg-brand-600">
                                {{ $brand->id ? 'Update Brand' : 'Save Brand' }}
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection