<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- route -->
    <meta name="wc_location_api" content="{{route('wc_location_api')}}">
    <meta name="wc_occupation_api" content="{{route('wc_occupation_api')}}">
    <meta name="wc_industry_api" content="{{route('wc_industry_api')}}">
    <meta name="wc_train_api" content="{{route('wc_train_api')}}">
    <meta name="wc_other_api" content="{{route('wc_other_api')}}">


    <title>テスト</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .wc_list{
            max-width: 900px;
            margin: 0 auto;
        }
    </style>

</head>
<body class="p-3 bg-white">
    <main id="app" class="m-3">


        <h1 class="border-bottom mb-5">テスト</h1>


        <div class="wc_list card p-3 mb-5">


            <cheakbox-occupation-component></cheakbox-occupation-component>

        </div>


    </main>
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>

