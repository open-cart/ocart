@if($showFields)
<div class="space-y-4">
    {!! $form->getField('acreage')->render() !!}
    <div class="grid grid-cols-3 gap-4">
        {!! $form->getField('province_id')->render() !!}
        {!! $form->getField('district_id')->render() !!}
    </div>
    {!! $form->getField('address')->render() !!}
    {!! $form->getField('location')->render() !!}
</div>
@endif
<script>
    $(function() {
        $("[name=province_id]").change(function() {
            axios.get('{!! route('location.district') !!}?id=' + $(this).val()).then(res => {
                const data = res.data.map(function(d) {
                    return '<option value="'+d.districtid+'">'+d.name+'</option>';
                });
                data.unshift('<option value="">- Chọn quận huyện -</option>')
                $("[name=district_id]").html(data.join(''));
            });
        })
    })
</script>
