<div>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
</div>

<div class="cart-container">
    <h2>Shopping Cart</h2>
    @if($cartItems->isEmpty())
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
            @foreach($cartItems->collection->toArray() as $item)
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
        </table>

        {{ $cartItems->links() }}

    @endif
</div>
