<?php
namespace Ocart\Media\Models;

use Botble\Media\Services\UploadsManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ocart\Core\Models\BaseModel;

class MediaFile extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media_files';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'folder_id',
        'mime_type',
        'size',
        'url',
        'options',
        'slug',
        'parent_folder',
        'is_folder',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'options' => 'json',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (MediaFile $file) {
            if ($file->isForceDeleting()) {
//                $uploadManager = new UploadsManager;
//                $uploadManager->deleteFile($file->url);
            }
        });
    }

    /**
     * @return string
     */
    public function getTypeAttribute()
    {
        $type = 'document';
        if ($this->attributes['mime_type'] == 'youtube') {
            return 'video';
        }

        foreach (config('packages.media.media.mime_types', []) as $key => $value) {
            if (in_array($this->attributes['mime_type'], $value)) {
                $type = $key;
                break;
            }
        }

        return $type;
    }

    public function getUrlFileAttribute()
    {
        if (File::extension($this->name)) {
            return 'upload/' . $this->name;
        }

        return 'upload/' . $this->name . '.' . File::extension($this->url);
    }

    /**
     * @return bool
     */
    public function canGenerateThumbnails(): bool
    {
        return false;
//        return is_image($this->mime_type) &&
//            !in_array($this->mime_type, ['image/svg+xml', 'image/x-icon']) &&
//            Storage::exists($this->url);
    }
}