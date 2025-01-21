@extends('ccns-ecommerce-cart::layouts.app')

@section('content')
    <h1>Your Cart</h1>

    @if($cartObjects->isEmpty())
        <p>Your cart is empty!</p>
    @else
        <table>
            <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartData as $item)
                <tr>
                    <td>{{ $item->product_id }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity * $item->price }}</td>
                    <td>
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td>
                    <div class="cart-summary">
                        <p><strong>Subtotal:</strong> {{ number_format($cartSummary['subtotal'], 2) }} บาท</p>
                        <p><strong>Discount:</strong> {{ number_format($cartSummary['discount'], 2) }} บาท</p>
                        <p><strong>Shipping:</strong> {{ number_format($cartSummary['shipping'], 2) }} บาท</p>
                        <p><strong>Total:</strong> {{ number_format($cartSummary['total'], 2) }} บาท</p>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>

        {{ $cartObjects->links() }}

    @endif
@endsection
