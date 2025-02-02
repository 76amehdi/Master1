@extends('tiyya.index')
@section('content')
    <style>
        .container {
            width: 100%;
            margin: 0 auto;

        }

        .header-image {
            width: 100%;
            height: auto;
            max-height: 350px;
            overflow: hidden;
            position: relative;


        }

        .header-image img {
            width: 100%;
            display: block;
            object-fit: cover;

        }

        .header-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px #000000;
            white-space: nowrap;
        }


        .content {
            padding: 30px 0;
            text-align: left;
        }

        .content p {
            margin-left: 80px;
            margin-bottom: 20px;
        }
    </style>
    </head>
    <head><title>
        carte
    </title></head>

    <body>
        <div class="container">

            <div class="header-image">
                <img src="{{ asset( $categoryData->image) }}" alt="Argan Oil Image">
                <div class="header-text">

                    {{ strtoupper($categoryData->title) }}
                </div>
            </div>

            <div class="content">
                <br>
                <br>
                <br>
                <p>
                    {{-- Using explode and implode with line breaks --}}
                    @php
                        $sentences = explode('.', $categoryData->text);
                        $formattedText = implode('.<br>', array_map('trim', $sentences));
                        echo $formattedText;
                    @endphp
                </p>

            </div>

        </div>
    @endsection
