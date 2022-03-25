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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        .wc_list{
            max-width: 900px;
            margin: 0 auto;
        }
    </style>

</head>
<body class="p-3 bg-white">
    <main id="app" class="m-3">


        <h1 class="border-bottom mb-5">勤務条件リスト</h1>

        <div class="wc_list card p-3 mb-5">
            <h3> 職種入力モーダル</h3>
            {{-- <cheakbox-occupation-component></cheakbox-occupation-component> --}}
            <cheakbox-other-component></cheakbox-other-component>
        </div>


    </main>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>

