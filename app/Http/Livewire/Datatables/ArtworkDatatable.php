<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Artwork;

class ArtworkDatatable extends BaseDatatable
{
    public $columns = [];
    public $routes = [];
    public $model = Artwork::class;
    public $columnsToggleable = false;
    public $bulkDeleteEnabled = false;

    public function mount()
    {
        $this->columns = $this->getColumns();
        $this->routes = $this->getRoutes();
    }

    public function dehydrate(){
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function render()
    {
        $data = array();

        $data['heading'] = __('Artworks');

        $rows = $this->model::query()
            ->with('collection', 'company', 'media')
            ->sort($this->sortBy, $this->sortOrder)
            ->paginate($this->perPage);

        $rows->getCollection()->transform(function ($row){
            $row->company_name = $row->company->name;
            $row->collection_name = $row->collection?->name;
            return $row;
        });

        $data['rows'] = $rows;
        $data['label'] = 'artwork';

        return view('livewire.datatables.artwork', $data);
    }

    public function resetFilters()
    {
        $this->reset(['perPage']);

    }

    public function getColumns()
    {
        $columns = [
            'company_name' => [
                'name' => 'Company',
                'visible' => true,
            ],
            'collection_name' => [
                'name' => 'Collection',
                'visible' => true,
            ],
            'name' => [
                'name' => 'Name',
                'visible' => true,
            ],
            'artist' => [
                'name' => 'Artist',
                'visible' => true,
            ],
            'type' => [
                'name' => 'Type',
                'visible' => true,
            ],
            'img' => [
                'name' => 'Image',
                'visible' => true,
                'render' => false,
                'move_before' => 'company_name'
            ],
        ];

        return $columns;
    }

    public function getRoutes()
    {
        $routes =  [
            'create' => 'backend.artworks.create',
            'edit' => 'backend.artworks.edit',
            'delete' => 'backend.artworks.destroy',
        ];

        if (user()->cannot('create', Artwork::class)) {
            unset($routes['create']);
        }

        return $routes;
    }
}