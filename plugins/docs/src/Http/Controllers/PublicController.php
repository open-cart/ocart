<?php
namespace Ocart\Docs\Http\Controllers;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\SeoHelper\Facades\SeoHelper;
use Ocart\Theme\Facades\Theme;
use Prettus\Repository\Helpers\CacheKeys;

class PublicController extends BaseController
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Chi tiet bai viet
     * @param $version
     * @param $slug
     * @return mixed
     */
    public function post($version, $slug)
    {
        $key = 'view.markdown.' . $version.$slug;

        return \Illuminate\Support\Facades\Cache::remember($key, 3600, function () use ($key, $version, $slug) {
            CacheKeys::putKey(get_class($this->postRepository), $key);

            $post = $this->postRepository->with('categories')->findWhere([
                'slug' => $slug,
                'version' => $version
            ])->first();

            if (empty($post)) {
                abort(404);
            }

            $title = $post->name;
            $description = Str::limit($post->description, 250);
            SeoHelper::setTitle($title);
            SeoHelper::setDescription($description);
            $meta = SeoHelper::openGraph();
            $meta->setTitle($title);
            $meta->setDescription($description);
            $meta->setType('article');

            do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, POST_MODULE_SCREEN_NAME, $post);

            return Theme::scope('post',  compact('post'),'packages/blog::post')->render();
        });
    }
}