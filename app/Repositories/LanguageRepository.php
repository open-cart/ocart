<?php

namespace App\Repositories;

use App\Models\Language;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface LanguageRepository.
 *
 * @package namespace App\Repositories;
 */
interface LanguageRepository extends RepositoryInterface
{
    /**
     * @return mixed
     */
    function getListActive();


    /**
     * @return mixed
     */
    function getCodeActive();
}
