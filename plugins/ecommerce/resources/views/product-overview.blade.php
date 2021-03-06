@if($showFields)
<div class="grid grid-cols-3 gap-4">
    {!! $form->getField('sku')->render() !!}
    {!! $form->getField('price')->render() !!}
    {!! $form->getField('price_sell')->render() !!}
</div>
@endif

