<?php


namespace Ocart\Page\Services\Abstracts;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;
use Ocart\Page\Models\Page;
use Ocart\Page\Repositories\PageDescriptionRepository;

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
