{{--
=========================================
    勤務地　一覧テーブル
=========================================
--}}

<table class="table border mt-5">
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
        @foreach ($locations as $location)
        {{-- <tr>
            <th scope="row">{{  $location->name }}</th>
            <td></td>
            <td></td>
            <td></td>
        </tr> --}}

            {{-- 都道府県 --}}
            @foreach ($location->todohukens as $todohuken)
            {{-- <tr>
                <th scope="row"></th>
                <td>{{ $todohuken->name }}</td>
                <td></td>
                <td></td>
            </tr> --}}

                {{-- 市町村 --}}
                @foreach ($todohuken->shichosons as $shichoson)
                <tr>
                    <th scope="row">{{  $location->name }}</th>
                    <td>{{ $todohuken->name }}</td>
                    <td>{{ $shichoson->name }}</td>
                    <td>---</td>
                </tr>

                    {{-- 区 --}}
                    @foreach ($shichoson->kus as $ku)
                    <tr>
                        <th scope="row">{{  $location->name }}</th>
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
