{{--
=========================================
    駅(路線)　一覧テーブル
=========================================
--}}
<table class="table border mt-5 bg-white">
    <thead>
        <tr>
            <th scope="col">鉄道会社</th>
            <th scope="col">路線</th>
            <th scope="col">駅</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($train_companies as $company)
         @foreach ($company->lines as $line)
          @foreach ($line->stations as $station)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $line->name }}</td>
                <td>{{ $station->name }}駅</td>
            </tr>
          @endforeach
         @endforeach
        @endforeach
    </tbody>
</table>
