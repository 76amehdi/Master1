<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achats & Paiements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 5px;
            font-size: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 8px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 3px;
            text-align: left;
            font-size: 8px;
        }
        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .bold {
            font-weight: bold;
        }
        .totals-table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
            font-size: 10px;
        }
         .totals-table td {
            padding: 5px;
            text-align: left;
            border: none;
        }

        .totals-table td.bold {
           font-weight: bold;
           text-align: right;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Achats & Paiements</h1>
    <p>Date du rapport: {{ now()->format('d-m-Y') }}</p>
</div>

<table class="table">
    <thead>
        <tr>
            <th class="bold">ID</th>
            <th class="bold">Fournisseur</th>
            <th class="bold">Entrepôt</th>
            <th class="bold">Date</th>
            <th class="bold">Statut</th>
            <th class="bold">Montant à payer</th>
            <th class="bold">Réduction</th>
            <th class="bold">Date de paiement</th>
            <th class="bold">Montant payé</th>
            <th class="bold">Méthode de paiement</th>
        </tr>
    </thead>
    <tbody>
    @php
        $totalAmountToPay = 0;
        $totalPaymentAmount = 0;
    @endphp
    @foreach ($purchases as $purchase)
            @php
                $totalAmountToPay += $purchase->amount_to_pay;
            @endphp
        @if($purchase->payments->count() > 0)
            @foreach ($purchase->payments as $payment)
                @php
                    $totalPaymentAmount += $payment->amount;
                @endphp
                <tr>
                    <td>{{ $purchase->id }}</td>
                    <td>{{ $purchase->fournisseur->name }}</td>
                    <td>{{ $purchase->warehouse->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}</td>
                    <td>{{ $purchase->payment_status }}</td>
                    <td>{{ $purchase->amount_to_pay }}</td>
                    <td>{{ $purchase->reduction }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->payment_method }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>{{ $purchase->id }}</td>
                <td>{{ $purchase->fournisseur->name }}</td>
                <td>{{ $purchase->warehouse->name }}</td>
                <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}</td>
                <td>{{ $purchase->payment_status }}</td>
                <td>{{ $purchase->amount_to_pay }}</td>
                <td>{{ $purchase->reduction }}</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
<table class="totals-table">
    <tr>
        <td class="bold">Montant total à payer:</td>
        <td class="bold">{{ number_format($totalAmountToPay, 2) }}</td>
    </tr>
    <tr>
        <td class="bold">Montant total payé:</td>
        <td class="bold">{{ number_format($totalPaymentAmount, 2) }}</td>
    </tr>
</table>

</body>
</html>