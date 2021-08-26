<?php

return [
    [
        'name' => "Blog",
        'flag' => "blog",
//        'parent_flag' => 'blog'
    ],
    [
        'name' => "Posts",
        'flag' => "blog.posts.index",
        'parent_flag' => 'blog'
    ],
    [
        'name' => "Create",
        'flag' => "blog.posts.create",
        'parent_flag' => 'blog.posts.index'
    ],
    [
        'name' => "Edit",
        'flag' => "blog.posts.update",
        'parent_flag' => 'blog.posts.index'
    ],
    [
        'name' => "Delete",
        'flag' => "blog.posts.destroy",
        'parent_flag' => 'blog.posts.index'
    ],

    [
        'name' => "Categories",
        'flag' => "blog.categories.index",
        'parent_flag' => 'blog'
    ],
    [
        'name' => "Create",
        'flag' => "blog.categories.create",
        'parent_flag' => 'blog.categories.index'
    ],
    [
        'name' => "Edit",
        'flag' => "blog.categories.update",
        'parent_flag' => 'blog.categories.index'
    ],
    [
        'name' => "Delete",
        'flag' => "blog.categories.destroy",
        'parent_flag' => 'blog.categories.index'
    ],

    [
        'name' => "Tags",
        'flag' => "blog.tags.index",
        'parent_flag' => 'blog'
    ],
    [
        'name' => "Create",
        'flag' => "blog.tags.create",
        'parent_flag' => 'blog.tags.index'
    ],
    [
        'name' => "Edit",
        'flag' => "blog.tags.update",
        'parent_flag' => 'blog.tags.index'
    ],
    [
        'name' => "Delete",
        'flag' => "blog.tags.destroy",
        'parent_flag' => 'blog.tags.index'
    ]
];
