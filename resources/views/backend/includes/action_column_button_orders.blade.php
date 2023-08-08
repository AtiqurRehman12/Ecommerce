<div class="text-end">
    <x-buttons.show route='{!!route("backend.$module_name.show", $data)!!}' title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    <a href="{!! route("backend.$module_name.detail", $data->id) !!}" style="padding:6px" class="bg-secondary rounded" title="{{ __('Order Detail') }}" small="true"><i class="fa-solid fa-eye text"></i></a>
    <a href="{!! route("backend.$module_name.confirm", $data->id) !!}" style="padding:6px" class="bg-success rounded" title="{{ __('Confirm Order') }}" small="true"><i class="fa-solid fa-check text-warning"></i></a>
    <a href="{!! route("backend.$module_name.reject", $data->id) !!}" style="padding:6px" class="bg-danger rounded" title="{{ __('Reject Order') }}" small="true"><i class="fa-solid fa-times text-dark"></i></a>
</div>
