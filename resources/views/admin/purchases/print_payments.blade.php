<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiements pour l'Achat #{{ $purchase->id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 30px;
            background-color: #f9f9f9;
            color: #333;
        }
         h1 {
           color: #3a3a3a;
           border-bottom: 2px solid #eee;
           padding-bottom: 10px;
           margin-bottom: 20px;
         }

       p {
         line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

         table thead th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #555;
             text-align: left;
        }

        th, td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

         tr:hover {
             background-color: #f5f5f5;
         }

         tr:last-child td {
            border-bottom: none;
          }

        .total {
           margin-top: 30px;
           padding: 15px;
           background-color: #f0f6ff;
           border: 1px solid #ddd;
           border-radius: 5px;
           box-shadow: 0 2px 5px rgba(0,0,0,0.03);
          display: inline-block;

        }

        .total p {
             margin: 5px 0;
              font-weight: bold;

        }

         .total p strong{
               color: #4a4a4a;
         }


          .payment-details {
               margin-top: 25px;
               border-bottom: 2px solid #eee;
                padding-bottom: 10px;
                color: #5a5a5a;
           }
           .payment-details h3{
             margin-bottom: 0px;

           }
    </style>
</head>
<body>
    <h1>Paiements pour l'Achat #{{ $purchase->id }}</h1>
       <p><strong>Fournisseur:</strong> {{ $purchase->fournisseur->name }}</p>
    <p><strong>Entrepôt:</strong> {{ $purchase->warehouse->name }}</p>
    <p><strong>Date d'Achat:</strong> {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}</p>
    <p><strong>Statut de Paiement:</strong> {{ $purchase->payment_status }}</p>
    <p><strong>Montant à Payer:</strong> {{ $purchase->amount_to_pay }}</p>
    <p><strong>Réduction:</strong> {{ $purchase->reduction }}</p>

    <div class="payment-details">
    <h3>Détails des Paiements</h3>
   </div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Montant</th>
                <th>Méthode de Paiement</th>
                <th>Description de la Transaction</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($purchase->payments as $payment)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y H:i') }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->transaction_reference }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucun paiement disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">
         <p><strong>Total des Paiements:</strong> {{ $totalPayments }}</p>
        <p><strong>Statut:</strong> {{ $isPaid ? 'Payé Intégralement' : 'Paiement en Attente' }}</p>
    </div>
</body>
</html>