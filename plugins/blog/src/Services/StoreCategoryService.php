<?php
namespace Ocart\Blog\Services;


use Illuminate\Http\Request;
use Ocart\Blog\Models\Post;
use Ocart\Blog\Services\Abstracts\StoreCategoryServiceAbstract;

class StoreCategoryService extends StoreCategoryServiceAbstract
{

    public function execute(Request $request, Post $post)
    {
        $categories = $request->input('categories');
        if (!empty($categories)) {
            $post->categories()->detach();
            foreach ($categories as $category) {
                $post->categories()->attach($category);
            }
        }
    }
}
