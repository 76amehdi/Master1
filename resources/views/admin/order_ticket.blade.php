<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$order->name}} Bill</title>
</head>
<body style="
        font-family: Arial, sans-serif;
        background-color: white;
        color: black;
        margin: auto;
        padding: auto;
    ">
    <div style="
   
      position: absolute;
       top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    ">
        <div style="
         
            width: 8cm;
            
            border: 1px solid #ddd;
            padding: 8px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            background-color: #fff;
            position: relative;
            ">
            <div style="
                display: flex;
                justify-content: space-between;
                margin-bottom: 8px;
                padding: 0 5px;
            ">
               <div style=" line-height: 1.2;">
                  <p style=" font-weight: bold; margin: 0;">{{ Str::random(11) }}</p>
                 <p style="margin: 0;">{{ $order->tracking_id }}</p>
                </div>
                <div style="position: absolute; top: 5px; right: 5px;">
                     <img src="https://tiyyashop.ma/cdn/shop/files/LOGO_Tiyya_HD_120x.png" alt="Tiyya Logo" style="max-width: 80px;">
                 </div>
           </div>
            <div style="
                border-top: 1px solid #eee;
                margin: 5px 0;
            "></div>
            <div style="  margin: 3px 0;
                line-height: 1.3;
                padding: 0 5px;">
              <p style=" margin: 3px 0;
                line-height: 1.3;">
                 @if($order->delivery_address)
                   addresse : {{ $order->delivery_address }}, {{ $order->delivery_city }} 
                 @else
                 addresse : {{ $order->address }}, {{ $order->billing_city }} ({{ $order->billing_country }})
                 @endif
                </p>
                <p style=" margin: 3px 0;
                 line-height: 1.3;">
                    @if($order->delivery_firstname || $order->delivery_lastname)
                        client : {{ $order->delivery_firstname }} {{ $order->delivery_lastname }}
                       @if($order->delivery_phone)
                           ({{ $order->delivery_phone }})
                         @endif
                    @else
                      client :  {{ $order->name }} ({{ $order->phone }})
                     @endif
                </p>
                 <p style=" margin: 5px; padding: 5px;
                line-height: 1.3; border:solid 2px black; ">
                    {{ count($order->orderDetails) }} produit
                    @if($order->delivery_phone)
                       ({{ $order->delivery_phone }})
                     @else
                       ({{ $order->phone }})
                     @endif
                </p>
            </div>
            <div style="
                border-top: 1px solid #eee;
                margin: 5px 0;
            "></div>
            <div style="display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 5px;
                margin-bottom: 5px;">
            <p style=" font-weight: bold; margin: 0;">{{ $order->orderDetails->sum(function($detail) { return $detail->price * $detail->quantity; }) }} MAD</p>
            </div>
           
        </div>
    </div>
</body>
</html>