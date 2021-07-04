<?php

namespace Ocart\Media\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Media\Http\Requests\MediaFolderRequest;
use Ocart\Media\Repositories\Interfaces\MediaFileRepository;
use Ocart\Media\Repositories\Interfaces\MediaFolderRepository;

class MediaFolderController extends BaseController
{

    public function store(MediaFolderRequest $request, MediaFileRepository $mediaFolderRepository)
    {
        $name = trim($request->get('name', ''));
        $parent_id = $request->get('parent_id', 0) ?? 0;
        $parent = null;
        if ($parent_id) {
            $parent = $mediaFolderRepository->findByField('id', $parent_id)->first();
        }

        $data = [
            'name' => $name,
            'slug' => Str::slug($name),
            'folder_id' => $parent_id,
            'is_folder' => '1',
            'parent_folder' => $parent ? $parent->parent_folder . DIRECTORY_SEPARATOR . $parent->name : '',
            'user_id' => 1, //Auth::user()->id,
        ];

        $folder = $mediaFolderRepository->create($data);

        return response()->json([
            'error' => 0,
            'message' => 'success',
            'data' => $folder,
        ]);
    }
}