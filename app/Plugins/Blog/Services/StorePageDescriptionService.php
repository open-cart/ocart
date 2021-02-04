<?php


namespace App\Plugins\Blog\Services;


use App\Plugins\Blog\Models\Page;
use App\Plugins\Blog\Services\Abstracts\StorePageDescriptionServiceAbstract;
use Illuminate\Http\Request;

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
