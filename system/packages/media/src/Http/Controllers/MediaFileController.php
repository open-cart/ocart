<?php

namespace Ocart\Media\Http\Controllers;

use Illuminate\Support\Arr;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Media\Facades\TnMedia;
use Ocart\Media\Http\Requests\MediaFileRequest;

class MediaFileController extends BaseController
{

    public function postUpload(MediaFileRequest $request)
    {
        $result = TnMedia::handleUpload(Arr::first($request->file('file')), $request->input('parent_id', 0));

        if ($result['error'] == false) {
            return TnMedia::responseSuccess([
                'id'  => $result['data']->id,
                'src' => $result['data']->url,
            ]);
        }

        return TnMedia::responseError($result['message']);
    }
}