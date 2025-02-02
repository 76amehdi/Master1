<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Facture d'Achat</title>
    <style>
        @media print {
            @page {
                size: A3;
            }
        }

        ul {
            padding: 0;
            margin: 0 0 1rem 0;
            list-style: none;
        }

        body {
            font-family: "Inter", sans-serif;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        table th,
        table td {
            border: 1px solid silver;
        }

        table th,
        table td {
            text-align: right;
            padding: 8px;
        }

        h1,
        h4,
        p {
            margin: 0;
        }

        .container {
            padding: 20px 0;
            width: 1000px;
            max-width: 90%;
            margin: 0 auto;
        }

        .inv-title {
            padding: 10px;
            border: 1px solid silver;
            text-align: center;
            margin-bottom: 30px;
        }

        .inv-logo {
            width: 150px;
            display: block;
            margin: 0 auto;
            margin-bottom: 40px;
        }

        /* header */
        .inv-header {
            display: flex;
            margin-bottom: 20px;
        }

        .inv-header> :nth-child(1) {
            flex: 2;
        }

        .inv-header> :nth-child(2) {
            flex: 1;
        }

        .inv-header h2 {
            font-size: 20px;
            margin: 0 0 0.3rem 0;
        }

        .inv-header ul li {
            font-size: 15px;
            padding: 3px 0;
        }

        /* body */
        .inv-body table th,
        .inv-body table td {
            text-align: left;
        }

        .inv-body {
            margin-bottom: 30px;
        }

        /* footer */
        .inv-footer {
            display: flex;
            flex-direction: row;
        }

        .inv-footer> :nth-child(1) {
            flex: 2;
        }

        .inv-footer> :nth-child(2) {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="inv-title">
            <h1>Facture d'Achat # {{ $purchase->id }}</h1>
        </div>
        <img src="https://tiyyashop.ma/cdn/shop/files/LOGO_Tiyya_HD_120x.png" alt="Logo Tiyya" class="inv-logo" />
        <div class="inv-header">
            <div>
                <h2>Détails du Fournisseur</h2>
                <ul>
                    <li>Nom: {{ $purchase->fournisseur->name }}</li>
                    <li>Email: {{ $purchase->fournisseur->email }}</li>
                    <li>Téléphone: {{ $purchase->fournisseur->phone }}</li>
                    <li>Adresse: {{ $purchase->fournisseur->address }}</li>
                </ul>
                 <h2>Détails de l'Entrepôt</h2>
                 <ul>
                    <li>Nom: {{ $purchase->warehouse->name }}</li>
                     <li>Emplacement: {{ $purchase->warehouse->location }}</li>
                 </ul>
            </div>
            <div>
                <table>
                    <tr>
                        <th>Date d'Achat</th>
                        <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Statut du Paiement</th>
                        <td>{{ ucfirst($purchase->payment_status) }}</td>
                    </tr>
                     <tr>
                        <th>Montant à Payer</th>
                        <td>{{ number_format($purchase->amount_to_pay, 2) }} USD</td>
                     </tr>
                     <tr>
                        <th>Réduction</th>
                        <td>{{ number_format($purchase->reduction, 2) }} USD</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="inv-body">
            <table>
                <thead>
                     <tr>
                        <th>Date de Paiement</th>
                        <th>Montant</th>
                        <th>Méthode de Paiement</th>
                        <th>Description de la Transaction</th>
                    </tr>
                </thead>
                <tbody>
                   @php
                       $totalPaid = 0;
                   @endphp
                   @foreach ($purchase->payments as $payment)
                       @php
                           $totalPaid += $payment->amount;
                       @endphp
                       <tr>
                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</td>
                            <td>{{ number_format($payment->amount, 2) }} USD</td>
                            <td>{{ ucfirst($payment->payment_method) }}</td>
                            <td>{{ $payment->transaction_reference ?? 'N/A' }}</td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="inv-footer">
            <div>
                <!-- required -->
            </div>
             <div>
                    <table>
                         <tr>
                            <th>Montant Total</th>
                            <td>{{ number_format($purchase->amount_to_pay - $purchase->reduction, 2) }} USD
                            </td>
                        </tr>
                        <tr>
                            <th>Total Payé</th>
                            <td>{{ number_format($totalPaid, 2) }} USD</td>
                        </tr>
                        <tr>
                             <th>Solde Restant</th>
                            <td>{{ number_format($purchase->amount_to_pay - $purchase->reduction - $totalPaid, 2) }} USD</td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>
</body>

</html>