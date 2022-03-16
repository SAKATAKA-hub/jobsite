{{--
=========================================
    その他　一覧テーブル
=========================================
--}}
<table class="table border mt-5 bg-white">
    <thead>
        <tr>
            <th scope="col">その他条件グループ</th>
            <th scope="col">その他条件名</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($other_groups as $group)
         @foreach ($group->items as $item)
            <tr>
                <td>{{ $group->name }}</td>
                <td>{{ $item->name }}</td>
            </tr>
         @endforeach
        @endforeach
    </tbody>
</table>


