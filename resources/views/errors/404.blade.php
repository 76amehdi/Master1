<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found | Tiyya</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Custom CSS for Tiyya 404 */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #fce4ec, #fff);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .error-template {
            padding: 40px;
            text-align: center;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            margin: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .error-template:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .error-template::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(to right, #f48fb1, #e91e63);
            border-radius: 15px 15px 0 0;
        }

        .error-template h1 {
            font-size: 5em;
            color: #e91e63;
            margin-bottom: 0.5em;
        }

        .error-template h2 {
            font-size: 1.8em;
            color: #555;
            margin-bottom: 1em;
        }

        .error-details {
            font-size: 1.1em;
            color: #777;
            margin-bottom: 2em;
        }

        .error-actions .btn {
            background-color: #e91e63;
            border: none;
            color: #fff;
            border-radius: 30px;
            padding: 10px 25px;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
            display: inline-flex;
            align-items: center;
        }

        .error-actions .btn:hover {
            background-color: #d81b60;
            transform: translateY(-3px);
        }

        .error-actions .btn i {
            margin-right: 8px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .error-template h1 {
                font-size: 3.5em;
            }

            .error-template h2 {
                font-size: 1.5em;
            }

            .error-template {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="error-template">
        <h1>Oops!</h1>
        <h2>404 Not Found</h2>
        <p class="error-details">
            Sorry, the page you're looking for seems to be lost in the clouds! 
        </p>
        <div class="error-actions">
            <a href="javascript:history.back()" class="btn">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
