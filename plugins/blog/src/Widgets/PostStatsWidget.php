<?php
namespace Ocart\Blog\Widgets;

use Ocart\Blog\Repositories\Interfaces\PostRepository;
use Ocart\Dashboard\Supports\StatsWidget;

class PostStatsWidget extends StatsWidget
{

    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function buildWidget()
    {
        parent::buildWidget();

        $this->setTotal($this->postRepository->count());
    }
}