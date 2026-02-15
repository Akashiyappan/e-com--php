<div style="padding: 20px;">
    <h3 style="margin-bottom: 20px; color: #667eea;">Order #{{ $order->id }} - Details</h3>

    <!-- Customer Information -->
    <div style="margin-bottom: 30px;">
        <h4 style="color: #333; margin-bottom: 15px; border-bottom: 2px solid #667eea; padding-bottom: 10px;">
            Customer Information
        </h4>
        <div class="item-row">
            <span class="item-label">Name:</span>
            <span class="item-value">{{ $order->full_name }}</span>
        </div>
        <div class="item-row">
            <span class="item-label">Email:</span>
            <span class="item-value">{{ $order->email }}</span>
        </div>
        <div class="item-row">
            <span class="item-label">Phone:</span>
            <span class="item-value">{{ $order->phone }}</span>
        </div>
    </div>

    <!-- Shipping Address -->
    <div style="margin-bottom: 30px;">
        <h4 style="color: #333; margin-bottom: 15px; border-bottom: 2px solid #667eea; padding-bottom: 10px;">
            Shipping Address
        </h4>
        <div class="item-row">
            <span class="item-label">Address:</span>
            <span class="item-value">{{ $order->address }}</span>
        </div>
        <div class="item-row">
            <span class="item-label">City:</span>
            <span class="item-value">{{ $order->city }}</span>
        </div>
        <div class="item-row">
            <span class="item-label">Zip Code:</span>
            <span class="item-value">{{ $order->zip }}</span>
        </div>
    </div>

    <!-- Order Items -->
    <div style="margin-bottom: 30px;">
        <h4 style="color: #333; margin-bottom: 15px; border-bottom: 2px solid #667eea; padding-bottom: 10px;">
            Order Items ({{ $order->items()->count() }} items)
        </h4>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f9f9f9;">
                    <th style="padding: 10px; text-align: left; border-bottom: 2px solid #eee;">Product ID</th>
                    <th style="padding: 10px; text-align: left; border-bottom: 2px solid #eee;">Quantity</th>
                    <th style="padding: 10px; text-align: left; border-bottom: 2px solid #eee;">Price</th>
                    <th style="padding: 10px; text-align: right; border-bottom: 2px solid #eee;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px;">#{{ $item->product_id }}</td>
                        <td style="padding: 10px;">{{ $item->quantity }}</td>
                        <td style="padding: 10px;">${{ number_format($item->price, 2) }}</td>
                        <td style="padding: 10px; text-align: right;">
                            ${{ number_format($item->quantity * $item->price, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Order Summary -->
    <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px;">
        <div class="item-row" style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">
            <span>Total Amount:</span>
            <span style="color: #667eea;">${{ number_format($order->total_amount, 2) }}</span>
        </div>
        <div class="item-row" style="font-size: 14px;">
            <span class="item-label">Order Date:</span>
            <span class="item-value">{{ $order->created_at->format('M d, Y H:i A') }}</span>
        </div>
    </div>
</div>
