@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('product.view') }}" class="hover:text-blue-600 transition-colors">Products</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-800 font-medium">Create Product</span>
        </nav>

        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Create New Product</h1>
                <p class="text-sm text-gray-500">Fill in the details below to add a product</p>
            </div>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-3 mb-6">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm font-semibold text-red-700">Please fix the following errors:</p>
                </div>
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Card --}}
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                {{-- Section: Basic Info --}}
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Basic Information</h2>
                </div>
                <div class="px-6 py-5 space-y-5">

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Product Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            placeholder="Enter product name"
                            class="w-full px-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                            {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                        @error('name')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                        <textarea id="description" name="description" rows="4" placeholder="Enter product description..."
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none">{{ old('description') }}</textarea>
                    </div>

                    {{-- Price + Stock (2 col) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Price (৳) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">৳</span>
                                <input type="number" id="price" name="price" value="{{ old('price') }}"
                                    placeholder="0.00" step="0.01" min="0"
                                    class="w-full pl-8 pr-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                                    {{ $errors->has('price') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                            </div>
                            @error('price')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-1.5">Stock
                                Quantity</label>
                            <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}"
                                min="0"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                    </div>

                </div>

                {{-- Section: Category & Status --}}
                <div class="px-6 py-4 border-y border-gray-100 bg-gray-50">
                    <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Category & Status</h2>
                </div>
                <div class="px-6 py-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1.5">Category</label>
                            <select id="category" name="category"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white">
                                <option value="">Select category</option>
                                {{-- @foreach ($categories as $cat)
                                    <option value="{{ $cat['id'] }}"
                                        {{ old('category') == $cat['id'] ? 'selected' : '' }}>
                                        {{ $cat['name'] }}
                                    </option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                            <select id="status" name="status"
                                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white">
                                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Section: Image --}}
                <div class="px-6 py-4 border-y border-gray-100 bg-gray-50">
                    <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Product Image</h2>
                </div>
                <div class="px-6 py-5">
                    <div
                        class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-blue-400 transition-colors group">
                        <svg class="w-10 h-10 mx-auto text-gray-300 group-hover:text-blue-400 transition-colors mb-3"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm text-gray-500 mb-1">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-400">PNG, JPG, WEBP up to 2MB</p>
                        <input type="file" name="image" accept="image/*"
                            class="mt-3 text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 cursor-pointer">
                    </div>
                    @error('image')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    {{-- Or enter image URL --}}
                    <div class="mt-4">
                        <label for="image_url" class="block text-sm font-medium text-gray-700 mb-1.5">Or enter Image
                            URL</label>
                        <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}"
                            placeholder="https://example.com/image.jpg"
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>

                {{-- Footer Buttons --}}
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('product.view') }}"
                        class="text-sm font-medium text-gray-500 hover:text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white text-sm font-medium px-6 py-2.5 rounded-xl transition-all duration-150 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Create Product
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
