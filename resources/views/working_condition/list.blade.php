<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>勤務条件リスト</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="p-3 bg-white">
    <main class="m-3">


        <h1 class="border-bottom mb-5">勤務条件リスト</h1>


        <ul class="list-group">


            <li class="list-group-item bg-light">
                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="m-0">勤務地</h5>

                    <div>
                        <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#location_table" aria-expanded="false" aria-controls="location_table">
                            テーブル
                        </button>
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#locationModal">
                            モーダル
                        </button>
                    </div>
                </div>

                <div class="collapse" id="location_table">
                    @include('working_condition.tables.location')
                </div>


                <!-- Modal -->
                <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="locationModalLabel">勤務地</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @include('working_condition.inputs.location')
                        </div>
                    </div>
                    </div>
                </div>
            </li>


            <li class="list-group-item bg-light">職種</li>
            <li class="list-group-item bg-light">業種</li>
            <li class="list-group-item bg-light">駅</li>
            <li class="list-group-item bg-light">その他</li>
        </ul>






    </main>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
