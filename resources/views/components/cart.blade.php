<div>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
</div>

<div class="cart-container">
    <h2>Shopping Cart</h2>
    @if (count($items) > 0)
        <table>
            <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['product_id'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['price'], 2) }}</td>
                    <td>{{ number_format($item['total_price']) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p><strong>Total:</strong> ${{ number_format($totalPrice, 2) }}</p>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
