<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 5px;
            padding: 0;
            font-size: 8px; /* Smaller default font */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px; /* Reduced margin */
            font-size: 8px; /* Smaller table font */
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 3px; /* Reduced padding */
            text-align: left;
            font-size: 8px; /* Smaller cell font */
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        img {
            max-width: 50px; /* Smaller max width */
            max-height: 50px; /* Smaller max height */
            display: block;
            margin: auto;
        }

        .image-cell {
            width: 50px; /* Reduced cell width */
            max-width: 50px;
            height: auto;
            padding: 0;
        }

        .unit-table {
            width: 100%;
            border-collapse: collapse;
        }

        .unit-table th, .unit-table td {
             border: 1px solid #ddd;
             padding: 2px; /* Reduced padding */
             font-size: 8px;
             text-align: left;
         }
         .unit-table th{
            background-color: #f2f2f2;
            font-weight: bold;
         }
    </style>
</head>

<body>
    <h2>Products Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Warehouse</th>
                <th>Brand</th>
                <th>Units</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->category->category_name ?? 'N/A' }}</td>
                    <td>{{ $product->warehouse->name ?? 'N/A' }}</td>
                    <td>{{ $product->brand ?? 'N/A' }}</td>
                    <td>
                        @if ($product->units)
                           <table class="unit-table">
                                 <thead>
                                    <tr>
                                        <th>Unit</th>
                                        <th>Price</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                   @foreach ($product->units as $unit)
                                     <tr>
                                        <td>{{ $unit->unit }}</td>
                                         <td>{{ $unit->price }}</td>
                                     </tr>
                                    @endforeach
                                </tbody>
                           </table>
                            @else
                               N/A
                            @endif
                    </td>
                    <td class="image-cell">
                        @if ($product->images->isNotEmpty())
                            <img src="{{ public_path('/' . $product->images->first()->image_path) }}"
                                alt="Product Image">
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