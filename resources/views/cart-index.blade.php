@extends('ccns-ecommerce-cart::layouts.app')

@section('content')

    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Shopping Cart</h1>

            @if(empty($cart) || empty($cart['items']))
                <p>Your cart is empty!</p>
            @else
                <x-ccns-ecommerce-cart::cart :cart="$cart"></x-ccns-ecommerce-cart::cart>
            @endif

        </div>
    </div>

@endsection
