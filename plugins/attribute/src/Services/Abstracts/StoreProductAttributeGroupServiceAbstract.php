<?php

namespace Ocart\Attribute\Services\Abstracts;

use Ocart\Attribute\Models\AttributeGroup;
use Ocart\Attribute\Repositories\Interfaces\AttributeGroupRepository;
use Illuminate\Http\Request;
use Ocart\Attribute\Repositories\Interfaces\AttributeRepository;

abstract class StoreProductAttributeGroupServiceAbstract
{
    /**
     * @var AttributeGroupRepository
     */
    protected $attributeGroupRepository;

    /**
     * @var AttributeRepository
     */
    protected $attributeRepository;

    /**
     * StoreCategoryServiceAbstract constructor.
     * @param AttributeGroupRepository $attributeGroupRepository
     * @param AttributeRepository $attributeRepository
     */
    public function __construct(AttributeGroupRepository $attributeGroupRepository,
                                AttributeRepository $attributeRepository)
    {
        $this->attributeGroupRepository = $attributeGroupRepository;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @param Request $request
     * @param AttributeGroup $attributeGroup
     * @return mixed
     */
    abstract public function execute(Request $request, AttributeGroup $attributeGroup);
}