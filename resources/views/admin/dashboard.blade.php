<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Orders</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 24px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .admin-name {
            font-size: 14px;
        }

        .logout-btn {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid white;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .container {
            padding: 30px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
        }

        .orders-section {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .section-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .section-header h2 {
            font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f9f9f9;
        }

        th {
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            color: #555;
            border-bottom: 2px solid #eee;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .order-id {
            font-weight: 600;
            color: #667eea;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background-color: #d4edda;
            color: #155724;
        }

        .view-btn {
            background-color: #667eea;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .view-btn:hover {
            background-color: #764ba2;
        }

        .pagination {
            padding: 20px;
            text-align: center;
        }

        .pagination a, .pagination span {
            margin: 0 5px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #667eea;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .pagination a:hover {
            background-color: #f0f0f0;
        }

        .pagination .active {
            background-color: #667eea;
            color: white;
            border-color: #667eea;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal.show {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 30px;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .order-details-item {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .order-details-item:last-child {
            border-bottom: none;
        }

        .item-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .item-label {
            font-weight: 600;
            color: #555;
        }

        .item-value {
            color: #333;
        }
    </style>
</head>
<body>
    <header>
        <h1>🛒 Admin Dashboard</h1>
        <div class="header-right">
            <div class="admin-name">
                Welcome, <strong>{{ auth()->user()->name }}</strong>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </header>

    <div class="container">
        <!-- Statistics Cards -->
        <div class="stats">
            <div class="stat-card">
                <h3>Total Orders</h3>
                <div class="stat-value">{{ $totalOrders }}</div>
            </div>
            <div class="stat-card">
                <h3>Total Revenue</h3>
                <div class="stat-value">${{ number_format($totalRevenue, 2) }}</div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="orders-section">
            <div class="section-header">
                <h2>All Orders</h2>
            </div>

            @if ($orders->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Total Amount</th>
                            <th>Items</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="order-id">#{{ $order->id }}</td>
                                <td>{{ $order->full_name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>{{ $order->items()->count() }}</td>
                                <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <button class="view-btn" onclick="viewOrderDetails({{ $order->id }})">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="no-data">
                    <p>No orders found.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Order Details Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Order Details</h2>
            <div id="modalBody"></div>
        </div>
    </div>

    <script>
        function viewOrderDetails(orderId) {
            // Fetch order details via AJAX
            fetch(`/admin/order/${orderId}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('modalBody').innerHTML = data;
                    document.getElementById('orderModal').classList.add('show');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to load order details');
                });
        }

        function closeModal() {
            document.getElementById('orderModal').classList.remove('show');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('orderModal');
            if (event.target === modal) {
                modal.classList.remove('show');
            }
        }
    </script>
</body>
</html>
