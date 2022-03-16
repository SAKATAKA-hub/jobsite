{{--
=========================================
    勤務地　一覧テーブル
=========================================
--}}

<table class="table border mt-5  bg-white">
    <thead>
        <tr>
            <th scope="col">地域</th>
            <th scope="col">都道府県</th>
            <th scope="col">市区町村</th>
            <th scope="col">区</th>
        </tr>
    </thead>
    <tbody>

        {{-- 地域 --}}
        @foreach ($location_radions as $radion)

            {{-- 都道府県 --}}
            @foreach ($radion->todohukens as $todohuken)


                {{-- 市町村 --}}
                @foreach ($todohuken->shichosons as $shichoson)
                <tr>
                    <th scope="row">{{  $radion->name }}</th>
                    <td>{{ $todohuken->name }}</td>
                    <td>{{ $shichoson->name }}</td>
                    <td>---</td>
                </tr>

                    {{-- 区 --}}
                    @foreach ($shichoson->kus as $ku)
                    <tr>
                        <th scope="row">{{  $radion->name }}</th>
                        <td>{{ $todohuken->name }}</td>
                        <td>{{ $shichoson->name }}</td>
                            <td>{{ $ku->name }}</td>
                    </tr>
                    @endforeach

                @endforeach

            @endforeach

        @endforeach
    </tbody>
</table>
