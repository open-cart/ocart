<?php


namespace App\Plugins\Blog\Services\Abstracts;
use App\Plugins\Blog\Models\Page;
use App\Plugins\Blog\Repositories\PageDescriptionRepository;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;

abstract class StorePageDescriptionServiceAbstract
{
    /**
     * @var PageDescriptionRepository
     */
    protected $pageDescriptionRepository;

    protected $languageRepository;

    /**
     * StoreCategoryServiceAbstract constructor.
     * @param PageDescriptionRepository $pageDescriptionRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(PageDescriptionRepository $pageDescriptionRepository, LanguageRepository $languageRepository)
    {
        $this->pageDescriptionRepository = $pageDescriptionRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * @param Request $data
     * @param Page $page
     * @return mixed
     */
    abstract public function execute(Request $data, Page $page);
}
