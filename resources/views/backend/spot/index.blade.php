@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-end">
                <a href="{{ route('spots.create') }}" class="btn btn-sm btn-outline-primary"><i
                        class="fal fa-plus"></i> {{ __('Add New') }}</a>
            </div>
            <h5 class="mb-0 ">{{ __('Spots') }}</h5>
        </div>
        <div class="card-body p-0">
            <div class="mb-3">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('Tour') }}</th>
                        <th scope="col">{{ __('Name') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @forelse($spots as $spot)
                        <tr>
                            <td>{{ $spot->tour->name }}</td>
                            <td>{{ $spot->name }}</td>
                            <td>
                                <x-backend::dropdown.container permission="update|delete" :permission_params="$spot">
                                    <x-backend::dropdown.item
                                        permission="update" :permission_params="$spot"
                                        :route="route('spots.xml.edit', $spot)">
                                        <i class="fal fa-pen mr-1"></i> {{ __('Edit Xml') }}
                                    </x-backend::dropdown.item>

                                    <x-backend::dropdown.item
                                        permission="update" :permission_params="$spot"
                                        :route="route('spots.edit', $spot)">
                                        <i class="fal fa-pen mr-1"></i> {{ __('Edit') }}
                                    </x-backend::dropdown.item>

                                    <x-backend::dropdown.item
                                        permission="delete" :permission_params="$spot"
                                        class="text-danger" data-bs-toggle="modal"
                                        data-bs-target="#confirm_spot_{{ $spot->id }}">
                                        <i class="fa fa-trash mr-1"></i> {{ __('Delete') }}
                                    </x-backend::dropdown.item>
                                </x-backend::dropdown.container>
                            </td>
                            <x-backend::modals.confirm
                                permission="edit" :permission_params="$spot"
                                :route="route('spots.destroy', $spot)"
                                :model="$spot" :button="false"
                            />
                        </tr>
                    @empty
                        <x-backend::layout.tr-no-record/>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer py-0"></div>
    </div>
@endsection