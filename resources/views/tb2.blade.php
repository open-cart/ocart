@props(['columns', 'html', 'data'])
<table {{ $attributes }}>
    <thead>
    <tr>
        @foreach($columns as $row)
            <th {{ $attributes->only([])->merge(array_merge(
                \Arr::only($row, ['class', 'id', 'title', 'width', 'style']),
                $row['attributes'] ?? [],
                isset($row['titleAttr']) ? ['title' => $row['titleAttr']] : []
            )) }}>{!! $row['title'] !!}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            @foreach($columns as $name => $row)
                <td {{ $attributes->only([])->merge(array_merge(
                \Arr::only($row, ['class', 'id', 'title', 'width', 'style']),
                $row['attributes'] ?? [],
                isset($row['titleAttr']) ? ['title' => $row['titleAttr']] : []
            )) }}>
                    {!! isset($row['render']) ? $row['render']($item) : $item->{$row['name']} !!}
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
