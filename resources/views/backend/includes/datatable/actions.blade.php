<x-backend::dropdown.container>
    <x-backend::dropdown.item :route="route($routes['edit'], $row)" permission="update" :permission_params="$row">
        <i class="fal fa-pen mr-1"></i> {{ __('Edit') }}
    </x-backend::dropdown.item>
    <x-backend::dropdown.item
        class="text-danger" data-toggle="modal" data-target="#confirm_{{$label}}_{{ $row->id }}"
        permission="delete" :permission_params="$row">
        <i class="fa fa-trash mr-1"></i> {{ __('Delete') }}
    </x-backend::dropdown.item>
    <x-backend::modals.confirm
        :route="route($routes['delete'], $row)" :model="$row"
        permission="delete" :permission_params="$row">
        :button="false"></x-backend::modals.confirm>
</x-backend::dropdown.container>