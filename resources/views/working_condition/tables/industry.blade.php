{{--
=========================================
    業種　一覧テーブル
=========================================
--}}
<table class="table border mt-5 bg-white">
    <thead>
        <tr>
            <th scope="col">業種グループ</th>
            <th scope="col">業種名</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($industry_groups as $group)
         @foreach ($group->items as $item)
            <tr>
                <td>{{ $group->name }}</td>
                <td>{{ $item->name }}</td>
            </tr>
         @endforeach
        @endforeach
    </tbody>
</table>
