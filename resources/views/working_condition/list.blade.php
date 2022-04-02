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


    <title>勤務条件検索(サンプル)</title>

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


        <h1 class="border-bottom mb-5">勤務条件検索(サンプル)</h1>

        <div class="wc_list">
            {{-- <cheakbox-occupation-component></cheakbox-occupation-component> --}}
        </div>



        <ul class="wc_list list-group">

            <!-- Alert -->
            @include('includes.session_alert')


            <!--# 勤務地-->
            <li class="list-group-item bg-light">
                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="m-0">勤務地</h5>
                    <div>
                        <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#locationTable" aria-expanded="false" aria-controls="locationTable">
                            テーブル
                        </button>
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#locationModal">
                            モーダル
                        </button>
                        {{-- <a class="btn btn-secondary" href="{{route('wc_location_update')}}">CSV更新</a> --}}
                    </div>
                </div>

                <!-- Table -->
                <div class="collapse" id="locationTable">
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
                                <cheakbox-location-component></cheakbox-location-component>
                            </div>
                            <div class="modal-footer">
                                <div class="w-100  text-center">
                                    <button class="btn btn-primary btn-lg w-100"  data-bs-dismiss="modal" aria-label="Close">
                                        希望勤務地を保存
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>


            <!--# 職種-->
            <li class="list-group-item bg-light">
                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="m-0">職種</h5>
                    <div>
                        <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#occupationTable" aria-expanded="false" aria-controls="occupationTable">
                            テーブル
                        </button>
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#occupationModal">
                            モーダル
                        </button>
                        {{-- <a class="btn btn-secondary" href="{{route('wc_occupation_update')}}">CSV更新</a> --}}
                    </div>
                </div>

                <!-- Table -->
                <div class="collapse" id="occupationTable">
                    @include('working_condition.tables.occupation')
                </div>

                <!-- Modal -->
                <div class="modal fade" id="occupationModal" tabindex="-1" aria-labelledby="occupationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="occupationModalLabel">職種</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <cheakbox-occupation-component></cheakbox-occupation-component>
                            </div>
                            <div class="modal-footer">
                                <div class="w-100  text-center">
                                    <button class="btn btn-primary btn-lg w-100"  data-bs-dismiss="modal" aria-label="Close">
                                        希望職種を保存
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>


            <!--# 業種-->
            <li class="list-group-item bg-light">
                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="m-0">業種</h5>
                    <div>
                        <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#industryTable" aria-expanded="false" aria-controls="industryTable">
                            テーブル
                        </button>
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#industryModal">
                            モーダル
                        </button>
                        {{-- <a class="btn btn-secondary" href="{{route('wc_industry_update')}}">CSV更新</a> --}}
                    </div>
                </div>

                <!-- Table -->
                <div class="collapse" id="industryTable">
                    @include('working_condition.tables.industry')
                </div>

                <!-- Modal -->
                <div class="modal fade" id="industryModal" tabindex="-1" aria-labelledby="industryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="industryModalLabel">業種</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <cheakbox-industry-component></cheakbox-industry-component>
                            </div>
                            <div class="modal-footer">
                                <div class="w-100  text-center">
                                    <button class="btn btn-primary btn-lg w-100"  data-bs-dismiss="modal" aria-label="Close">
                                        希望業種を保存
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>


            <!--# 駅(路線)-->
            <li class="list-group-item bg-light">
                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="m-0">駅(路線)</h5>
                    <div>
                        <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#trainTable" aria-expanded="false" aria-controls="trainTable">
                            テーブル
                        </button>
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#trainModal">
                            モーダル
                        </button>
                        {{-- <a class="btn btn-secondary" href="{{route('wc_train_update')}}">CSV更新</a> --}}
                    </div>
                </div>

                <!-- Table -->
                <div class="collapse" id="trainTable">
                    @include('working_condition.tables.train')
                </div>

                <!-- Modal -->
                <div class="modal fade" id="trainModal" tabindex="-1" aria-labelledby="trainModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="trainModalLabel">駅(路線)</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <cheakbox-train-component></cheakbox-train-component>
                            </div>
                            <div class="modal-footer">
                                <div class="w-100  text-center">
                                    <button class="btn btn-primary btn-lg w-100"  data-bs-dismiss="modal" aria-label="Close">
                                        希望駅(路線)を保存
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>


            <!--# その他条件-->
            <li class="list-group-item bg-light">
                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="m-0">その他条件</h5>
                    <div>
                        <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#otherTable" aria-expanded="false" aria-controls="otherTable">
                            テーブル
                        </button>
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#otherModal">
                            モーダル
                        </button>
                        {{-- <a class="btn btn-secondary" href="{{route('wc_other_update')}}">CSV更新</a> --}}
                    </div>
                </div>

                <!-- Table -->
                <div class="collapse" id="otherTable">
                    @include('working_condition.tables.other')
                </div>

                <!-- Modal -->
                <div class="modal fade" id="otherModal" tabindex="-1" aria-labelledby="otherModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="otherModalLabel">その他条件</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <cheakbox-other-component></cheakbox-other-component>
                            </div>
                            <div class="modal-footer">
                                <div class="w-100  text-center">
                                    <button class="btn btn-primary btn-lg w-100"  data-bs-dismiss="modal" aria-label="Close">
                                        その他条件を保存
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>






    </main>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
