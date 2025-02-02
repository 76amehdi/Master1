<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Report</title>
    <style>
        body {
            font-family: 'NotoSans', Arial, sans-serif;
            margin: 5px;
            padding: 0;
            font-size: 8px;
        }
        h2 {
            margin-bottom: 5px;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 8px;
        }
        th, td {
            border: 1px solid black;
            padding: 3px;
            text-align: left;
            font-size: 8px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Orders Report</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Tracking ID</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Total Products</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->tracking_id }}</td>
                <td>{{ $order->delivery_firstname }} {{ $order->delivery_lastname }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->delivery_status }}</td>
                <td>
                    @if($order->orderDetails->isNotEmpty())
                        @php
                            $total = 0;
                        @endphp
                        @foreach($order->orderDetails as $orderDetail)
                            @php
                                $total = $total + $orderDetail->quantity;
                            @endphp
                        @endforeach
                        {{$total}}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>