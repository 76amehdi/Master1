<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Purchases Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fournisseur</th>
                <th>Warehouse</th>
                <th>Purchase Date</th>
                <th>Payment Status</th>
                <th>Amount to Pay</th>
                <th>Reduction</th>
                <th>Total Products</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->id }}</td>
                    <td>{{ $purchase->fournisseur->name }}</td>
                    <td>{{ $purchase->warehouse->name }}</td>
                    <td>{{ $purchase->purchase_date }}</td>
                    <td>{{ $purchase->payment_status }}</td>
                    <td>{{ $purchase->amount_to_pay }}</td>
                    <td>{{ $purchase->reduction }}</td>
                      <td>
                         @if($purchase->purchasedetail->isNotEmpty())
                         @php
                         $total = 0;
                          @endphp
                         @foreach($purchase->purchasedetail as $purchasedetail)
                         @php
                         $total = $total + $purchasedetail->quantity;
                         @endphp
                         @endforeach
                         {{$total}}
                         @else
                         No products
                         @endif
                     </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>