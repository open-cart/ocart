<?php

namespace Ocart\Media\Http\Controllers;

use Botble\Assets\Facades\AssetsFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Ocart\Media\Facades\TnMedia;
use Ocart\Media\Models\MediaFile;
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
        page_title()->setTitle(trans('File management'));

        AssetsFacade::addStylesDirectly([
            'vendor/packages/media/css/app.css',
        ])
            ->addScriptsDirectly([
                'vendor/packages/media/js/app.js',
            ]);

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

        return view('packages.media::index', compact('files', 'items', 'folders', 'breadcrumbs'));
    }

    public function list(Request $request){
        $folder = $this->fileRepository->getModel();

        if ($slug = $request->get('folder', 0)) {
            $name = \Arr::last(explode(DIRECTORY_SEPARATOR, $slug));

            $folder = $this->fileRepository->findByField('id', $name)->first();
        }

        $files = $this->fileRepository->scopeQuery(function($q) use ($folder, $request){
            $q = $q->orderBy('is_folder', 'DESC');

            $q = $q->where('folder_id', $folder->id ?? 0);

            if ($text = $request->input('text')) {
                $q = $q->where('name','like', '%' . $text . '%');
            }

            switch ($request->input('type', null)) {
                case 'image':
                    $q = $q->whereIn('mime_type', config('packages.media.media.mime_types.image'));
                    break;
                case 'video':
                    $q = $q->whereIn('mime_type', config('packages.media.media.mime_types.video'));
                    break;
                case 'document':
                    $q = $q->whereIn('mime_type', config('packages.media.media.mime_types.document'));
                    break;
                default:
                    break;
            }

            switch($request->input('sort', null)) {
                case 'name_asc':
                    $q = $q->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $q = $q->orderBy('name', 'desc');
                    break;
                case 'created_at_asc':
                    $q = $q->orderBy('created_at', 'asc');
                    break;
                case 'created_at_desc':
                    $q = $q->orderBy('created_at', 'desc');
                    break;
                case 'size_asc':
                    $q = $q->orderBy('size', 'asc');
                    break;
                case 'size_desc':
                    $q = $q->orderBy('size', 'desc');
                    break;
                default:
                    break;
            }

            return $q;
        })->paginate(40);

        $list = collect($files->items());
        $items = $list->where('is_folder', 0)->map(function($file) {
            return $this->getResponseFileData($file);
        });
        $items = $items->values();

        $folders = $list->where('is_folder', 1)->values();

        $breadcrumbs = $this->getBreadcrumbs($folder);

        view()->share('breadcrumbs', $breadcrumbs);
        view()->share('root', $folder);

        return response()->json([
                'message' => 'Success',
                'error' => null,
                'data' => [],
        ] + compact('files', 'items', 'folders', 'breadcrumbs'));
    }

    public function delete(Request $request, BaseHttpResponse $response)
    {
        $id = $request->get('id');

        \DB::beginTransaction();

        $file = $this->fileRepository->find($id);

        $server = \League\Glide\ServerFactory::create([
            'source' => Storage::path('upload'),
            'cache' => storage_path('framework/cache/images'),
//        'driver' => 'imagick',
        ]);

        if ($file->is_folder == '1') {
            if (!$file->parent_folder) {
                $folders = MediaFile::where('parent_folder', 'like', '/'.$file->name.'%')->where('is_folder', '1')->get();
            } else {
                $folders = MediaFile::where('parent_folder', 'like', $file->parent_folder.'/'.$file->name.'%')->where('is_folder', '1')->get();
            }

            $values = $folders->pluck('id')->values();
            $values[] = $file->id;

            $files = MediaFile::whereIn('folder_id', $values)->get();

            MediaFile::whereIn('folder_id', $values)->forceDelete();

            foreach ($files as $item) {
                Storage::delete($item->url);
                $server->deleteCache(str_replace('upload/', '', $item->url));
            }
        } else {
            Storage::delete($file->url);
            $server->deleteCache(str_replace('upload/', '', $file->url));
        }

//        $this->fileRepository->delete($id);

        $file->forceDelete();

        \DB::commit();

        return response()->json([]);

//        return $response->setMessage(trans('Delete file successfully'));
    }

    public function postRename(Request $request, BaseHttpResponse $response)
    {
        $id = $request->get('id');
        $name = $request->input('name');

        $file = $this->fileRepository->find($id);

        if ($name == $file->name) {
            return $response->setMessage(trans('Rename successfully'));
        }

        $name = $this->fileRepository->createName(File::name($name), $file->folder_id);

        $this->fileRepository->update(['name' => $name], $id);

        return $response->setMessage(trans('Rename successfully'));
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
            'url'        => get_image_url($file->url_file, null, true),
            'full_url'   => TnMedia::getImageUrl($file->url_file),
            'download_url'   => TnMedia::url($file->url),
            'type'       => $file->type,
            'icon'       => $file->icon,
            'thumb'      => $file->type == 'image' ? get_image_url($file->url_file, 'thumb') : null,
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
