<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>{{$order->name}} Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: black;
        }
        .header {
            text-align: center;
        }
        .header img {
            width: 120px;
        }
        .container {
            margin-top: 30px;
        }
        .order-details {
            margin-top: 30px;
        }
        .order-details th, .order-details td {
            padding: 8px;
            text-align: left;
        }
        
        .order-details td {
            background-color: #f9f9f9;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Header with Logo -->
    <div class="header">
        <img src="https://tiyyashop.ma/cdn/shop/files/LOGO_Tiyya_HD_120x.png" alt="Tiyya Shop Logo">
        <h1>Tiyya Shop</h1>
    </div>

    <!-- Order Information -->
    <div class="container">
        <p><strong>Customer Name:</strong> {{$order->name}}</p>
        <p><strong>Customer Email:</strong> {{$order->email}}</p>
        <p><strong>Customer Phone:</strong> {{$order->phone}}</p>
        <p><strong>Customer Address:</strong> {{$order->address}}</p>
        <p><strong>Delivery Status:</strong> {{$order->delivery_status}}</p>
        <p><strong>Payment Status:</strong> {{$order->payment_status}}</p>
        <p><strong>Tracking ID:</strong> {{$order->tracking_id}}</p>
    </div>

    <!-- Order Details Table -->
    <div class="container order-details">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Weight</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderDetails as $orderDetail)
                    <tr>
                        <td>{{$orderDetail->product_title}}</td>
                        <td>{{number_format($orderDetail->price, 2)}}</td>
                        <td>{{$orderDetail->quantity}}</td>
                        <td>{{number_format($orderDetail->price * $orderDetail->quantity, 2)}}</td>
                        <td>{{$orderDetail->product_weight}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Total Price -->
    <div class="container total">
        <p><strong>Total Amount: </strong>{{number_format($order->orderDetails->sum(function($detail) { return $detail->price * $detail->quantity; }), 2)}}</p>
    </div>

    

</body>
</html>
