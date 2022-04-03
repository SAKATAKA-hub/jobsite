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


        <title>勤務条件入力フォーム(サンプル)</title>

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


            <h1 class="border-bottom mb-5">勤務条件入力フォーム(サンプル)</h1>


            <ul class="wc_list list-group">

                <!-- Alert -->
                @include('includes.session_alert')


                <!--# 勤務地-->
                <li class="list-group-item bg-light">
                    <wcim-location-component></wcim-location-component>
                </li>


                <!--# 駅(路線)-->
                <li class="list-group-item bg-light">
                    <div class="d-flex justify-content-between align-items-center">

                        <h5 class="m-0">駅(路線)</h5>

                        <i class="bi bi-chevron-right text-primary"></i>
                    </div>
                </li>


                <!--# 職種-->
                <li class="list-group-item bg-light">
                    <div class="d-flex justify-content-between align-items-center">

                        <h5 class="m-0">職種</h5>

                        <i class="bi bi-chevron-right text-primary"></i>
                    </div>
                </li>


                <!--# 業種-->
                <li class="list-group-item bg-light">
                    <div class="d-flex justify-content-between align-items-center">

                        <h5 class="m-0">業種</h5>

                        <i class="bi bi-chevron-right text-primary"></i>
                    </div>
                </li>


                <!--# その他条件-->
                <li class="list-group-item bg-light">
                    <div class="d-flex justify-content-between align-items-center">

                        <h5 class="m-0">その他条件</h5>

                        <i class="bi bi-chevron-right text-primary"></i>
                    </div>
                </li>
            </ul>






        </main>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
