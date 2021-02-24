<?php


namespace Ocart\Page\Services;

use Illuminate\Http\Request;
use Ocart\Page\Models\Page;
use Ocart\Page\Services\Abstracts\StorePageDescriptionServiceAbstract;

class StorePageDescriptionService extends StorePageDescriptionServiceAbstract
{

    /**
     * @param Request $data
     * @param Page $page
     * @return mixed|void
     */
    public function execute(Request $data, Page $page)
    {
        $descriptions = $data->input('description');

        $languages = $this->languageRepository->getListActive();

        foreach ($languages as $code => $value) {
            $description = [
                'page_id'     => $page->id,
                'lang'        => $code,
                'title'       => $descriptions[$code]['title'],
                'keyword'     => $descriptions[$code]['keyword'],
                'description' => $descriptions[$code]['description'],
                'content'     => $descriptions[$code]['content'],
            ];

            $page->description()->updateOrCreate([
                'page_id'     => $page->id,
                'lang'        => $code,
            ], $description);
        }
    }
}
