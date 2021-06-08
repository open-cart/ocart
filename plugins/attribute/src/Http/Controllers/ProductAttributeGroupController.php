<?php

namespace Ocart\Attribute\Http\Controllers;


use Illuminate\Http\Request;
use Ocart\Attribute\Forms\AttributeGroupForm;
use Ocart\Attribute\Http\Requests\AttributeGroupUpdateRequest;
use Ocart\Attribute\Models\AttributeGroup;
use Ocart\Attribute\Repositories\Interfaces\AttributeGroupRepository;
use Ocart\Attribute\Http\Requests\AttributeGroupCreateRequest;
use Ocart\Attribute\Services\StoreProductAttributeGroupService;
use Ocart\Attribute\Tables\AttributeGroupTable;
use Illuminate\Support\Facades\Event;
use Ocart\Core\Forms\FormBuilder;
use Ocart\Core\Http\Controllers\BaseController;
use Ocart\Core\Http\Responses\BaseHttpResponse;
use Prettus\Repository\Events\RepositoryEntityDeleting;

class ProductAttributeGroupController extends BaseController
{

    /**
     * @var AttributeGroupRepository
     */
    protected $repo;

    /**
     * @var StoreProductAttributeGroupService
     */
    protected $storeProductAttributeGroupService;

    public function __construct(AttributeGroupRepository $repo,
                                StoreProductAttributeGroupService $storeProductAttributeGroupService)
    {
        $this->repo = $repo;
        $this->storeProductAttributeGroupService = $storeProductAttributeGroupService;
        $this->authorizeResource($repo->getModel(), 'id');
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'ecommerce.attribute_groups.index',
            'show' => 'ecommerce.attribute_groups.update',
            'create' => 'ecommerce.attribute_groups.create',
            'store' => 'ecommerce.attribute_groups.create',
            'edit' => 'ecommerce.attribute_groups.update',
            'update' => 'ecommerce.attribute_groups.update',
            'destroy' => 'ecommerce.attribute_groups.destroy',
        ];
    }

    public function index(AttributeGroupTable $table)
    {
        return $table->render();
    }

    function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/attribute::attributes.create'));

        return $formBuilder->create(AttributeGroupForm::class)
            ->setMethod('POST')
            ->setUrl(route('ecommerce.attribute_groups.store'))
            ->renderForm();
    }

    function store(AttributeGroupCreateRequest $request, BaseHttpResponse $response)
    {
        /** @var AttributeGroup $group */
        $group = $this->repo->getModel();

        $group = $this->storeProductAttributeGroupService->execute($request, $group);

        return $response->setPreviousUrl(route('ecommerce.attribute_groups.index'))
            ->setNextUrl(route('ecommerce.attribute_groups.show', $group->id));
    }

    function show($id, FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/ecommerce::categories.edit'));

        $group = $this->repo->skipCriteria()
            ->with('attributes')
            ->find($id);

        return $formBuilder->create(AttributeGroupForm::class, ['model' => $group])
            ->setMethod('PUT')
            ->setUrl(route('ecommerce.attribute_groups.update', ['id' => $group->id]))
            ->renderForm();
    }

    function update($id, AttributeGroupUpdateRequest $request, BaseHttpResponse $response)
    {
        /** @var AttributeGroup $group */
        $group = $this->repo->getModel();

        $this->storeProductAttributeGroupService->execute($request, $group);

        return $response->setPreviousUrl(route('ecommerce.attribute_groups.index'))
            ->setNextUrl(route('ecommerce.attribute_groups.show', $id));
    }

    function destroy(Request $request)
    {
        Event::listen(RepositoryEntityDeleting::class, function($repo) {
            if ($repo->getModel() instanceof AttributeGroup) {
                if ($repo->getModel()->is_default) {
                    throw new \Error(trans('core/base::notices.cannot_delete'));
                }
            }
        });

        $this->repo->delete($request->input('id'));

        return response()->json([]);
    }
}