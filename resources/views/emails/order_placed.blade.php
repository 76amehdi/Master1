<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Commande Reçue</title>
</head>
<body>
    <h1>Une nouvelle commande a été passée!</h1>
     <p>Voici les détails de la commande:</p>
    <ul>
        <li><strong>ID de la Commande:</strong> {{ $order->tracking_id }}</li>
         <li><strong>Adresse de Livraison:</strong> {{ $order->delivery_address }}, {{ $order->delivery_city }}, {{ $order->delivery_country }}</li>
          <li><strong>Adresse de Facturation:</strong> {{ $order->billing_address }}, {{ $order->billing_city }}, {{ $order->billing_country }}</li>
        <li><strong>Téléphone:</strong> {{ $order->phone }}</li>
        <li><strong>Méthode de Paiement:</strong> {{ $order->payment }}</li>
    </ul>
    <h2>Produits Commandés:</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Titre du Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->order_details as $detail)
                <tr>
                    <td>{{ $detail->product_title }}</td>
                    <td>${{ $detail->price }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>${{ $detail->price * $detail->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Veuillez traiter cette commande dès que possible. Merci!</p>
</body>
</html>