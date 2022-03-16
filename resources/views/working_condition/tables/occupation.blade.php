{{--
=========================================
    職種　一覧テーブル
=========================================
--}}

<table class="table border mt-5  bg-white">
    <thead>
        <tr>
            <th scope="col">職種グループ1</th>
            <th scope="col">職種グループ2</th>
            <th scope="col">職種名</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($occupation_group01s as $group01)
         @foreach ($group01->group02s as $group02)
          @foreach ($group02->items as $item)
            <tr>
                <td>{{ $group01->name }}</td>
                <td>{{ $group02->name }}</td>
                <td>{{ $item->name }}</td>
            </tr>
          @endforeach
         @endforeach
        @endforeach
    </tbody>


</table>
