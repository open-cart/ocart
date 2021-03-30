<?php
namespace Ocart\Media\Models;

use Botble\Media\Services\UploadsManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Storage;
use Ocart\Core\Models\BaseModel;

class MediaFolder extends BaseModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media_folders';

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
        'name',
        'slug',
        'parent_folder',
        'user_id',
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
}