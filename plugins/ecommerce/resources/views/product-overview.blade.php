@if($showFields)
<div class="grid grid-cols-3 gap-4">
    {!! $form->getField('sku')->render() !!}
    {!! $form->getField('price')->render() !!}
    {!! $form->getField('sale_price')->render() !!}
</div>
@endif

