<div class="flex flex-col space-y-4">
    <a href="">Reload</a>
{{--    {{ dd($model) }}--}}
    <p>
        Time: {!! $model->created_at !!}
    </p>

    <p>
        Full Name: {!! $model->name !!}
    </p>

    <p>
        Email: {!! $model->email !!}
    </p>

    <p>
        Phone: {!! $model->phone ?? 'N/A' !!}
    </p>

    <p>
        Address: {!! $model->address ?? 'N/A' !!}
    </p>

    <p>
        Subject: {!! $model->subject ?? 'N/A' !!}
    </p>
    <p>
        Content:
    </p>
    <pre class="whitespace-normal break-words bg-gray-100 p-3 text-sm rounded">
        {!! $model->content !!}
    </pre>
</div>