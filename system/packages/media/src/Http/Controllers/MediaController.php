<?php

namespace Ocart\Media\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Media\Facades\TnMedia;
use Ocart\Media\Repositories\Interfaces\MediaFileRepository;
use Ocart\Media\Repositories\Interfaces\MediaFolderRepository;

class MediaController extends BaseController
{

    /**
     * @var MediaFileRepository
     */
    protected $fileRepository;

    /**
     * @var MediaFolderRepository
     */
    protected $folderRepository;

    public function __construct(MediaFileRepository $fileRepository, MediaFolderRepository $mediaFolderRepository)
    {
        $this->fileRepository = $fileRepository;
        $this->folderRepository = $mediaFolderRepository;
    }


    public function index(Request $request){
        $folder = $this->fileRepository->getModel();

        if ($slug = $request->get('folder', 0)) {
            $name = \Arr::last(explode(DIRECTORY_SEPARATOR, $slug));

            $folder = $this->fileRepository->findByField('name', $name)->first();
        }

        $files = $this->fileRepository->scopeQuery(function($q) use ($folder, $request){
            $q->orderBy('is_folder', 'DESC');

            $q->where('folder_id', $folder->id ?? 0);

            return $q;
        })->paginate(18);
        $list = collect($files->items());
        $items = $list->where('is_folder', 0)->map(function($file) {
            return $this->getResponseFileData($file);
        });
        $folders = $list->where('is_folder', 1);

        $breadcrumbs = $this->getBreadcrumbs($folder);

        view()->share('breadcrumbs', $breadcrumbs);
        view()->share('root', $folder);

        return view('packages/media::index', compact('files', 'items', 'folders', 'breadcrumbs'));
    }

    public function list(Request $request){
        $folder = $this->fileRepository->getModel();

        if ($slug = $request->get('folder', 0)) {
            $name = \Arr::last(explode(DIRECTORY_SEPARATOR, $slug));

            $folder = $this->fileRepository->findByField('name', $name)->first();
        }

        $files = $this->fileRepository->scopeQuery(function($q) use ($folder, $request){
            $q->orderBy('is_folder', 'DESC');

            $q->where('folder_id', $folder->id ?? 0);

            return $q;
        })->paginate(18);
        $list = collect($files->items());
        $items = $list->where('is_folder', 0)->map(function($file) {
            return $this->getResponseFileData($file);
        });
        $folders = $list->where('is_folder', 1);

        $breadcrumbs = $this->getBreadcrumbs($folder);

        view()->share('breadcrumbs', $breadcrumbs);
        view()->share('root', $folder);

        return response()->json([
                'message' => 'Success',
                'error' => null,
                'data' => [],
        ] + compact('files', 'items', 'folders', 'breadcrumbs'));

        return view('packages/media::index', compact('files', 'items', 'folders', 'breadcrumbs'));
    }

    protected function getBreadcrumbs($folder)
    {
        $breadcrumbs = [
            '<a href="'.route('media.index').'">All media</a>'
        ];

        if ($folder && $folder->id) {
            $split = explode(DIRECTORY_SEPARATOR, $folder->parent_folder);

            $link = '';


            foreach ($split as $item) {
                if (empty($item)) {
                    continue;
                }
                $link = trim($link.DIRECTORY_SEPARATOR.$item, DIRECTORY_SEPARATOR);
                $breadcrumbs[] = '<a href="'.route('media.index', ['folder' => $link]).'">'.$item.'</a>';
            }

            $link = trim($link.DIRECTORY_SEPARATOR.$folder->name, DIRECTORY_SEPARATOR);
            $breadcrumbs[] = '<a href="'.route('media.index', ['folder' => $link]).'">'.$folder->name.'</a>';
        }

        return join('<span>&nbsp;/&nbsp;</span>', $breadcrumbs);
    }

    /**
     * @param $file
     * @return array
     */
    protected function getResponseFileData($file)
    {
        if (empty($file)) {
            return [];
        }

        return [
            'id'         => $file->id,
            'name'       => $file->name,
            'basename'   => File::basename($file->url),
            'url'        => $file->url,
            'full_url'   => TnMedia::url($file->url),
            'type'       => $file->type,
            'icon'       => $file->icon,
            'thumb'      => $file->type == 'image' ? get_image_url($file->url, 'thumb') : null,
            'size'       => $file->human_size,
            'mime_type'  => $file->mime_type,
            'is_folder' => $file->is_folder,
            'slug' => $file->slug,
            'parent_folder' => $file->parent_folder,
//            'created_at' => date_from_database($file->created_at, 'Y-m-d H:i:s'),
//            'updated_at' => date_from_database($file->updated_at, 'Y-m-d H:i:s'),
            'options'    => $file->options,
            'folder_id'  => $file->folder_id,

        ];
    }
}
