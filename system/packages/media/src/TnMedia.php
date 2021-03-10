<?php

namespace Ocart\Media;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ocart\Media\Repositories\Interfaces\MediaFileRepository;

class TnMedia
{
    /**
     * @var MediaFileRepository
     */
    protected $fileRepository;

    public function __construct(MediaFileRepository $mediaFileRepository)
    {
        $this->fileRepository = $mediaFileRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function renderHeader()
    {
        return view('packages/media::header');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function renderFooter()
    {
        return view('packages/media::footer');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function renderContent()
    {
        return view('packages/media::content');
    }

    /**
     * @param $fileUpload
     * @param int $folderId
     * @param string $path
     */
    public function handleUpload($fileUpload, $folderId = 0, $path = '')
    {
        $file = $this->fileRepository->getModel();

        if ($fileUpload->getSize() / 1024 > (int)config('core.media.media.max_file_size_upload')) {
            return [
                'error'   => true,
                'message' => trans('core/media::media.file_too_big', ['size' => config('packages.media.media.max_file_size_upload')]),
            ];
        }

        $fileExtension = $fileUpload->getClientOriginalExtension();

        $file->name = $this->fileRepository->createName(File::name($fileUpload->getClientOriginalName()),
            $folderId);

//        $folderPath = $this->folderRepository->getFullPath($folderId, $path);

        $fileName = $this->fileRepository->createSlug($file->name, $fileExtension, Storage::path($folderPath));

        $filePath = $fileName;

        if ($folderPath) {
            $filePath = $folderPath . '/' . $filePath;
        }

        $content = File::get($fileUpload->getRealPath());

        Storage::put($filePath, $content);

//        $this->uploadManager->saveFile($filePath, $content);
//
//        $data = $this->uploadManager->fileDetails($filePath);

        if (empty($data['mime_type'])) {
            return [
                'error'   => true,
                'message' => trans('core/media::media.can_not_detect_file_type'),
            ];
        }

        $file->url = $data['url'];
        $file->size = $data['size'];
        $file->mime_type = $data['mime_type'];

        $file->folder_id = $folderId;
        $file->user_id = Auth::check() ? Auth::user()->getKey() : 0;
        $file->options = request()->get('options', []);
        $this->fileRepository->createOrUpdate($file);

        if ($file->canGenerateThumbnails()) {
            foreach (config('core.media.media.sizes', []) as $size) {
                $readableSize = explode('x', $size);
                $this->thumbnailService
                    ->setImage($fileUpload->getRealPath())
                    ->setSize($readableSize[0], $readableSize[1])
                    ->setDestinationPath($folderPath)
                    ->setFileName(File::name($fileName) . '-' . $size . '.' . $fileExtension)
                    ->save();
            }

            if (config('core.media.media.watermark.source')) {
                $image = Image::make(public_path($file->url));
                $image->insert(
                    config('core.media.media.watermark.source'),
                    config('core.media.media.watermark.position', 'bottom-right'),
                    config('core.media.media.watermark.x', 10),
                    config('core.media.media.watermark.y', 10)
                );
                $image->save(public_path($file->url));
            }
        }

        return [
            'error' => false,
            'data'  => $file,
        ];
    }

    public function responseSuccess()
    {

    }

    public function responseError()
    {

    }
}