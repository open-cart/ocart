<?php
namespace Ocart\Attribute\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ocart\Attribute\Models\AttributeGroup;
use Ocart\Attribute\Services\Abstracts\StoreProductAttributeGroupServiceAbstract;

class StoreProductAttributeGroupService extends StoreProductAttributeGroupServiceAbstract
{

    public function execute(Request $request, AttributeGroup $attributeGroup)
    {
        DB::beginTransaction();

        $data = $request->all();

        $data['slug'] = $request->input('slug') ?? Str::limit(Str::slug($request->input('title')));

        /** @var AttributeGroup $model */
        $model = $this->attributeGroupRepository->getModel();

        $group = $this->attributeGroupRepository->updateOrCreate([
            'id' => $request->route('id')
        ], $model->fill($data)->toArray());

        $attributes = json_decode($request->get('attributes', '[]'), true) ?: [];
        $deletedAttributes = json_decode($request->get('deleted_attributes', '[]'), true) ?: [];

        $this->deleteAttributes($group->id, $deletedAttributes);
        $this->storeAttributes($group->id, $attributes);

        DB::commit();

        return $group;
    }

    public function deleteAttributes($attribute_group_id, $attributeIds = [])
    {
        if (empty($attributeIds)) {
            return;
        }
        $this->attributeRepository
            ->deleteWhere([
                [
                    'id',
                    'in',
                    $attributeIds
                ],
                'attribute_group_id' => $attribute_group_id,
            ]);
    }

    public function storeAttributes($attribute_group_id, $attributes = [])
    {
        $model = $this->attributeRepository->getModel();
        foreach ($attributes as $item) {
            if (isset($item['id'])) {
                $model->fill($item);
                $this->attributeRepository->updateOrCreate([
                    'id' => $item['id']
                ], $model->toArray());
            } else {
                $item['attribute_group_id'] = $attribute_group_id;
                $item['slug'] = $item['slug'] ?? Str::limit(Str::slug($item['title']));
                $this->attributeRepository->create($item);
            }
        }
    }
}