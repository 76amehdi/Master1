<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px; /* Reduce font size for more content fit */
        }
        th, td {
            border: 1px solid black;
            padding: 4px; /* Reduce padding for better fit */
            text-align: left;
            word-break: break-word; /* Break long text */
        }
        th {
            background-color: #f2f2f2;
        }

          .total-row {
            font-weight: bold;
             
          }
         @page {
            margin: 30px; /* Adjust margins around the page */
         }

    </style>
</head>
<body>
    <h1>Sales Report</h1>

    @if($startDate && $endDate)
       <p><strong>Date Range : </strong>{{ $startDate }} to {{ $endDate }} </p>
    @endif

     @if($orders->isNotEmpty())
          <h2>Total Sales : {{ number_format($totalSales, 2) }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                     <th>Order Date</th>
                      <th>Name</th>
                    <th>Email</th>
                    <th>Product ID</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                     <th>Total Product Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    @foreach($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at }}</td>
                             <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $detail->product_id }}</td>
                            <td>{{ $detail->product_title }}</td>
                            <td>{{ number_format($detail->price, 2) }}</td>
                            <td>{{ $detail->quantity }}</td>
                             <td>{{ number_format($detail->price * $detail->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
             <tfoot>
                   <tr>
                    <td colspan="8"  class="total-row" style="text-align: right;">Total Sales:</td>
                    <td  class="total-row">{{ number_format($totalSales, 2) }}</td>
                </tr>
           </tfoot>
        </table>


    @else
        <p>No sales data found for the selected period.</p>
    @endif
</body>
</html>