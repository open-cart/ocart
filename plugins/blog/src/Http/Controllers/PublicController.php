<?php

namespace Ocart\Blog\Http\Controllers;

use Ocart\Blog\Repositories\Interfaces\CategoryRepository;
use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\SeoHelper\Facades\SeoHelper;
use Ocart\Theme\Facades\Theme;
use Illuminate\Support\Str;

class PublicController extends BaseController
{

    /**
     * @var PostRepository
     */
    protected $repo;
    protected $repoCategory;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->repo = $postRepository;
        $this->repoCategory = $categoryRepository;
    }

    /**
     * Chi tiet bai viet
     * @return mixed
     */
    public function post($slug)
    {
        $post = $this->repo->with('categories')->findByField('slug', $slug)->first();
        if (empty($post)) {
            abort(404);
        }
        $title = $post->name;
//        $description = Str::limit(strip_tags($post->description), 250);
        $description = Str::limit($post->description, 250);
        SeoHelper::setTitle($title);
        SeoHelper::setDescription($description);
        $meta = SeoHelper::openGraph();
        $meta->setTitle($title);
        $meta->setDescription($description);
        $meta->setType('article');

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, POST_MODULE_SCREEN_NAME, $post);

        return Theme::scope('post',  compact('post'),'packages/blog::post');
    }

    /**
     * Trang chi tiết shop
     * @return mixed
     */
    public function blog()
    {
        $title = 'Blog title';
        $description = 'Blog deps';
        SeoHelper::setTitle($title);
        SeoHelper::setDescription($description);
        $meta = SeoHelper::openGraph();
        $meta->setTitle($title);
        $meta->setDescription($description);
        $meta->setType('Blog page');

        $posts = $this->repo->paginate(9);

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, BLOG_CATEGORY_MODULE_SCREEN_NAME, []);

        return Theme::scope('blog',  compact( 'posts'),'packages/post::blog');
    }

    /**
     * Danh muc bai viet
     * @return mixed
     */
    public function postCategory($slug)
    {
        $category = $this->repoCategory->findByField('slug', $slug)->first();
        if (empty($category)) {
            abort(404);
        }
        $title = $category->name;
        $description = Str::limit(strip_tags($category->description), 250);
        SeoHelper::setTitle($title);
        SeoHelper::setDescription($description);
        $meta = SeoHelper::openGraph();
        $meta->setTitle($title);
        $meta->setDescription($description);
        $meta->setType('category article');

        $posts = $this->repo->postForCategory($category->id, 9);

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, BLOG_CATEGORY_MODULE_SCREEN_NAME, $category);

        return Theme::scope('post-category',  compact('category', 'posts'),'packages/post::post-category');
    }
}
