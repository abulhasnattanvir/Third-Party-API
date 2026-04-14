@extends('layouts.app')

@section('title', $product['name'])

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('products.index') }}" class="hover:text-blue-600 transition-colors">Products</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-800 font-medium truncate">{{ $product['name'] }}</span>
        </nav>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors border border-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to list
            </a>
            <div class="flex items-center gap-2">
                <a href="{{ route('products.edit', $product['id']) }}"
                    class="inline-flex items-center gap-1.5 text-sm font-medium text-amber-600 border border-amber-300 hover:bg-amber-50 px-4 py-2 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                <form action="{{ route('products.destroy', $product['id']) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this product?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 text-sm font-medium text-red-600 border border-red-300 hover:bg-red-50 px-4 py-2 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>

        {{-- Success Alert --}}
        @if (session('success'))
            <div
                class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-6">
                <svg class="w-5 h-5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Main Content --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left: Image --}}
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    @if (!empty($product['image']))
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                            class="w-full aspect-square object-cover">
                    @else
                        <div class="w-full aspect-square bg-gray-50 flex flex-col items-center justify-center">
                            <svg class="w-16 h-16 text-gray-200 mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm text-gray-400">No image available</p>
                        </div>
                    @endif

                    {{-- Status Badge over image area --}}
                    <div class="px-4 py-3 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-medium text-gray-500">Status</span>
                        @if (($product['status'] ?? '') === 'active')
                            <span
                                class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full border border-green-100">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                Active
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1 rounded-full border border-gray-200">
                                <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                                Inactive
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right: Details --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Name & Price Card --}}
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm px-6 py-5">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">{{ $product['name'] }}</h1>
                            <p class="text-sm text-gray-400 mt-1">Product ID: #{{ $product['id'] }}</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-3xl font-bold text-emerald-600">৳ {{ number_format($product['price'], 2) }}</p>
                        </div>
                    </div>

                    @if (!empty($product['description']))
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $product['description'] }}</p>
                        </div>
                    @endif
                </div>

                {{-- Details Grid --}}
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Product Details</h2>
                    </div>
                    <div class="divide-y divide-gray-100">

                        <div class="flex items-center justify-between px-6 py-3.5">
                            <span class="text-sm text-gray-500 font-medium">Category</span>
                            @if (!empty($product['category']))
                                <span
                                    class="bg-indigo-50 text-indigo-700 text-xs font-medium px-2.5 py-1 rounded-full border border-indigo-100">
                                    {{ $product['category'] }}
                                </span>
                            @else
                                <span class="text-gray-300 text-sm">—</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between px-6 py-3.5">
                            <span class="text-sm text-gray-500 font-medium">Stock</span>
                            @if (isset($product['stock']))
                                @if ($product['stock'] > 10)
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold text-green-600">{{ $product['stock'] }}
                                            units</span>
                                        <span
                                            class="text-xs bg-green-50 text-green-700 px-2 py-0.5 rounded-full border border-green-100">In
                                            stock</span>
                                    </div>
                                @elseif ($product['stock'] > 0)
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold text-amber-600">{{ $product['stock'] }}
                                            units</span>
                                        <span
                                            class="text-xs bg-amber-50 text-amber-700 px-2 py-0.5 rounded-full border border-amber-100">Low
                                            stock</span>
                                    </div>
                                @else
                                    <span
                                        class="text-xs font-semibold text-red-600 bg-red-50 px-2.5 py-1 rounded-full border border-red-100">Out
                                        of stock</span>
                                @endif
                            @else
                                <span class="text-gray-300 text-sm">N/A</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between px-6 py-3.5">
                            <span class="text-sm text-gray-500 font-medium">Price</span>
                            <span class="text-sm font-bold text-emerald-600">৳
                                {{ number_format($product['price'], 2) }}</span>
                        </div>

                        @if (!empty($product['created_at']))
                            <div class="flex items-center justify-between px-6 py-3.5">
                                <span class="text-sm text-gray-500 font-medium">Created</span>
                                <span
                                    class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($product['created_at'])->format('d M Y') }}</span>
                            </div>
                        @endif

                        @if (!empty($product['updated_at']))
                            <div class="flex items-center justify-between px-6 py-3.5">
                                <span class="text-sm text-gray-500 font-medium">Last Updated</span>
                                <span
                                    class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($product['updated_at'])->diffForHumans() }}</span>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Quick Stats --}}
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm px-4 py-4 text-center">
                        <p class="text-xs text-gray-400 mb-1">Price</p>
                        <p class="text-lg font-bold text-emerald-600">৳ {{ number_format($product['price'], 0) }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm px-4 py-4 text-center">
                        <p class="text-xs text-gray-400 mb-1">Stock</p>
                        <p class="text-lg font-bold text-blue-600">{{ $product['stock'] ?? '—' }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm px-4 py-4 text-center">
                        <p class="text-xs text-gray-400 mb-1">ID</p>
                        <p class="text-lg font-bold text-gray-700">#{{ $product['id'] }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
