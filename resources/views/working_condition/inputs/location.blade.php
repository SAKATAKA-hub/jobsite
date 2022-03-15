{{--
=========================================
    勤務地　入力一覧
=========================================
--}}


{{-- 地域 --}}
<div class="d-flex justify-content-between">
    <div>
        <!-- チェックボックス -->
        <input class="form-check-input" type="checkbox" value="" id="location_input_all">

        <!-- ラベル -->
        <label class="form-check-label" for="location_input_all">
            <h5>全国</h5>
        </label>
    </div>
</div>

<ul class="list-group">
    @foreach ($locations as $location)
    <li class="list-group-item bg-light">

        <div class="d-flex justify-content-between">
            <div>
                <!-- チェックボックス -->
                <input class="form-check-input" type="checkbox" value="" id="location_input{{ $location->id }}">

                <!-- ラベル -->
                <label class="form-check-label" for="location_input{{ $location->id }}">
                    <h5>{{ $location->name }}</h5>
                </label>
            </div>

            <button type="button"  data-bs-toggle="collapse" data-bs-target="#location_itembox{{ $location->id }}" aria-expanded="false" aria-controls="location_itembox{{ $location->id }}">
                open
            </button>
        </div>


        {{-- 都道府県 --}}
        <div class="collapse" id="location_itembox{{ $location->id }}">
            <ul class="list-group m-3">
                @foreach ($location->todohukens as $todohuken)
                <li class="list-group-item">

                    <div class="d-flex justify-content-between">
                        <div>
                            <!-- チェックボックス -->
                            <input class="form-check-input" type="checkbox" value="" id="todohuken_input{{ $todohuken->id }}">

                            <!-- ラベル -->
                            <label class="form-check-label" for="todohuken_input{{ $todohuken->id }}">
                                <h6> {{ $todohuken->name }}</h6>
                            </label>
                        </div>

                        <button type="button"  data-bs-toggle="collapse" data-bs-target="#todohuken_itembox{{ $todohuken->id }}" aria-expanded="false" aria-controls="location_itembox{{ $location->id }}">open</button>
                    </div>



                    {{-- 市町村 --}}
                    <div class="collapse" id="todohuken_itembox{{ $todohuken->id }}">
                        <ul class="list-group m-3">
                            @foreach ($todohuken->shichosons as $shichoson)
                            <li class="list-group-item">

                                <div class="d-flex justify-content-between">
                                    <div>
                                        <!-- チェックボックス -->
                                        <input class="form-check-input" type="checkbox" value="" id="shichoson_input{{ $shichoson->id }}">

                                        <!-- ラベル -->
                                        <label class="form-check-label" for="shichoson_input{{ $shichoson->id }}">
                                            <h6> {{ $shichoson->name }}</h6>
                                        </label>
                                    </div>

                                    @if ( $shichoson->kus->count() )
                                    <button type="button"  data-bs-toggle="collapse" data-bs-target="#shichoson_itembox{{ $shichoson->id }}" aria-expanded="false" aria-controls="location_itembox{{ $location->id }}">open</button>
                                    @endif
                                </div>


                                    {{-- 区 --}}
                                <div class="collapse" id="shichoson_itembox{{ $shichoson->id }}" >
                                    <div class="d-flex flex-wrap">
                                        @foreach ($shichoson->kus as $ku)
                                        <div style="width:8em;">
                                            {{-- {{ $ku->name }} --}}
                                            <!-- チェックボックス -->
                                            <input class="form-check-input" type="checkbox" value="" id="ku_input{{ $ku->id }}">

                                            <!-- ラベル -->
                                            <label class="form-check-label" for="ku_input{{ $ku->id }}">
                                                {{ $ku->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>

                            </li>
                            @endforeach
                        </ul>
                    </div>


                </li>
                @endforeach
            </ul>


        </div>
    </li>
    @endforeach
</ul>
