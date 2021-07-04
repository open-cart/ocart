<?php

namespace Ocart\Media;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Ocart\Media\Repositories\Interfaces\MediaFileRepository;
use Ocart\Media\Services\ThumbnailService;

class TnMedia
{
    /**
     * @var MediaFileRepository
     */
    protected $fileRepository;

    /**
     * @var ThumbnailService
     */
    protected $thumbnailService;

    public function __construct(MediaFileRepository $mediaFileRepository, ThumbnailService $thumbnailService)
    {
        $this->fileRepository = $mediaFileRepository;
        $this->thumbnailService = $thumbnailService;
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
    public function renderContent($data = [])
    {
        return view('packages/media::content', $data);
    }

    /**
     * @param $fileUpload
     * @param int $folderId
     * @param string $path
     */
    public function handleUpload($fileUpload, $folderId = 0, $path = '')
    {
//        $fileUpload->move('upload', $fileUpload->getClientOriginalName());
        $file = $this->fileRepository->getModel();

        if ($fileUpload->getSize() / 1024 > (int)config('packages.media.media.max_file_size_upload')) {
            return [
                'error'   => true,
                'message' => trans('packages/media::media.file_too_big', ['size' => config('packages.media.media.max_file_size_upload')]),
            ];
        }


        $fileExtension = $fileUpload->getClientOriginalExtension();

        $file->name = $this->fileRepository->createName(File::name($fileUpload->getClientOriginalName()), $folderId);

        $folderPath = 'upload';

        $fileName = $file->name;

        $filePath = $fileName;
//
        if ($folderPath) {
            $filePath = $folderPath . DIRECTORY_SEPARATOR . $filePath;
        }

        $content = File::get($fileUpload->getRealPath());
//
//        Storage::put($filePath, $content);
        $filePath = Storage::putFile($folderPath, $fileUpload);
//
//        $this->uploadManager->saveFile($filePath, $content);
//
//        $data = $this->uploadManager->fileDetails($filePath);

//        if (empty($data['mime_type'])) {
//            return [
//                'error'   => true,
//                'message' => trans('core/media::media.can_not_detect_file_type'),
//            ];
//        }
//
        $file->url = $filePath;
        $file->size = $fileUpload->getSize();
        $file->mime_type = $fileUpload->getMimeType();

        $file->folder_id = $folderId;
        $file->user_id = Auth::check() ? Auth::user()->getKey() : 0;
        $file->options = request()->get('options', []);
        $file = $this->fileRepository->updateOrCreate($file->toArray(), ['url' => $file->url]);

        if ($file->canGenerateThumbnails()) {
            foreach (config('packages.media.media.sizes', []) as $size) {
                $readableSize = explode('x', $size);
                $this->thumbnailService
                    ->setImage($fileUpload->getRealPath())
                    ->setSize($readableSize[0], $readableSize[1])
                    ->setDestinationPath($folderPath)
                    ->setFileName(File::name($filePath) . '-' . $size . '.' . $fileExtension)
                    ->save();
            }

            if (config('packages.media.media.watermark.source')) {
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

    /**
     * @param $data
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess($data, $message = null)
    {
        return response()->json([
            'error'   => false,
            'data'    => $data,
            'message' => $message,
        ]);
    }

    /**
     * @param $message
     * @param array $data
     * @param null $code
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError($message, $data = [], $code = null, $status = 200)
    {
        return response()->json([
            'error'   => true,
            'message' => $message,
            'data'    => $data,
            'code'    => $code,
        ], $status);
    }

    /**
     * @param $path
     * @return string
     */
    public function url($path)
    {
        if (!$path) {
            return null;
        }

        if (Str::contains($path, 'https://')) {
            return $path;
        }

        return Storage::url($path);
    }

    protected function convertUrl($url)
    {
        return str_replace(Storage::url('upload'), Storage::url('images'), $url);
    }

    public function getImageUrl($url, $size = null, $default = null)
    {
        if (empty($url)) {
            return $this->convertUrl($default);
        }

        if (empty($size) || $url == '__value__') {
            return $this->convertUrl($this->url($url));
        }

        if ($url == $this->getDefaultImage()) {
            return $this->convertUrl($url);
        }

        if ($size && array_key_exists($size, $this->getSizes())) {
            [$w, $h] = explode('x', $this->getSize($size));
            $url = $url . "?w=$w&h=$h";
        }

        return $this->convertUrl($this->url($url));
    }

    public function getDefaultImage()
    {
        return $this->url(config('packages.media.media.default_image'));
    }

    /**
     * @return array
     */
    public function getSizes(): array
    {
        return config('packages.media.media.sizes', []);
    }

    /**
     * @return string
     */
    public function getSize(string $name): ?string
    {
        return config('packages.media.media.sizes.' . $name);
    }

    /**
     * @param string $name
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function addSize(string $name, int $width, int $height)
    {
        config(['packages.media.media.sizes.' . $name => $width . 'x' . $height]);

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function removeSize(string $name)
    {
        $sizes = $this->getSizes();
        Arr::forget($sizes, $name);

        config(['packages.media.media.sizes' => $sizes]);

        return $this;
    }
}