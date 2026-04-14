@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold text-gray-800">Products</h1>
                <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-1 rounded-full">
                    {{ count($products) }} items
                </span>
            </div>
            <a href="{{ route('product.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-150">
                Create
            </a>
            <form action="" method="POST">
                @csrf
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Sync from API
                </button>
            </form>
        </div>

        {{-- Success Alert --}}
        @if (session('success'))
            <div
                class="flex items-start gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
                <svg class="w-5 h-5 mt-0.5 shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Error Alert --}}
        @if ($errors->has('api_error'))
            <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4">
                <svg class="w-5 h-5 mt-0.5 shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <p class="text-sm font-medium">{{ $errors->first('api_error') }}</p>
            </div>
        @endif

        {{-- Table Card --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800">
                        <tr>
                            <th
                                class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider w-12">
                                #</th>
                            <th
                                class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider w-16">
                                Image</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                Details</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                Category</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                Rating</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                Rating</th>
                            <th
                                class="px-4 py-3 text-center text-xs font-semibold text-gray-300 uppercase tracking-wider w-24">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($products as $index => $product)
                            <tr class="hover:bg-gray-50 transition-colors duration-100">

                                {{-- Serial --}}
                                <td class="px-4 py-3 text-sm text-gray-400">{{ $index + 1 }}</td>

                                {{-- Image --}}
                                <td class="px-4 py-3">
                                    @if (!empty($product['image']))
                                        <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}"
                                            class="w-12 h-12 object-cover rounded-lg border border-gray-200" loading="lazy">
                                    @else
                                        <div
                                            class="w-12 h-12 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>

                                {{-- Name --}}
                                <td class="px-4 py-3">
                                    <p class="text-sm font-semibold text-gray-800">{{ $product['title'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">ID: {{ $product['id'] }}</p>
                                </td>

                                {{-- Description --}}
                                <td class="px-4 py-3">
                                    <p class="text-sm font-semibold text-gray-800">{{ $product['description'] }}</p>
                                </td>

                                {{-- Category --}}
                                <td class="px-4 py-3">
                                    @if (!empty($product['category']))
                                        <span
                                            class="inline-block bg-indigo-50 text-indigo-700 text-xs font-medium px-2.5 py-1 rounded-full border border-indigo-100">
                                            {{ $product['category'] }}
                                        </span>
                                    @else
                                        <span class="text-gray-300">—</span>
                                    @endif
                                </td>

                                {{-- Price --}}
                                <td class="px-4 py-3">
                                    <span class="text-sm font-bold text-emerald-600">
                                        ৳ {{ number_format($product['price'], 2) }}
                                    </span>
                                </td>

                                {{-- Rating --}}
                                <td class="px-4 py-3">
                                    <span class="text-sm font-bold text-emerald-600">
                                        {{ $product['rating']['rate'] }}
                                        {{ $product['rating']['count'] }}
                                    </span>
                                </td>

                                {{-- Action --}}
                                <td class="px-4 py-3 gap-2 flex text-center">
                                    <a href=""
                                        class="inline-block text-xs font-medium text-green-600 hover:text-white border border-green-500 hover:bg-green-600 px-3 py-1.5 rounded-lg transition-all duration-150">
                                        View
                                    </a>
                                    <a href=""
                                        class="inline-block text-xs font-medium text-blue-600 hover:text-white border border-blue-500 hover:bg-blue-600 px-3 py-1.5 rounded-lg transition-all duration-150">
                                        Edit
                                    </a>
                                    <a href=""
                                        class="inline-block text-xs font-medium text-red-600 hover:text-white border border-red-500 hover:bg-red-600 px-3 py-1.5 rounded-lg transition-all duration-150">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-16 text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-200 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-gray-500 font-medium">No products found</p>
                                    <p class="text-gray-400 text-sm mt-1">Try syncing from the API or clearing your
                                        filters.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Table Footer --}}
            {{-- @if (count($products) > 0)
                <div
                    class="px-4 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-sm text-gray-500">
                    <span>Showing <strong class="text-gray-700">{{ count($products) }}</strong> product(s)</span>
                    @if (request()->hasAny(['search', 'category', 'status']))
                        <a href="{{ route('products.index') }}"
                            class="text-blue-600 hover:underline text-xs font-medium">
                            Clear all filters
                        </a>
                    @endif
                </div>
            @endif --}}
        </div>

        {{-- Pagination (DB paginate() হলে কাজ করবে) --}}
        {{-- @if (method_exists($products, 'links'))
            <div class="mt-4 flex justify-end">
                {{ $products->withQueryString()->links() }}
            </div>
        @endif --}}

    </div>
@endsection
