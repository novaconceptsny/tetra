<x-wire-elements-pro::bootstrap.slide-over :content-padding="false" :close-button="false">
    <div class="sidebar-div">
        <div class="sidebar mysidebar">
            <div class="preview">
                <h5 class="sidebar-heading">{{ $project->name }}</h5>
                <a href="#"  wire:slide-over="close" class="x text-decoration-none">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
            <div class="date">
                <h6>{{ $project->created_at->format('M d, Y') }}</h6>
            </div>
            <div class="select-tours">
                <h5>Select Layout</h5>
            </div>
            {{--@if($selectedTour && $selectedTour->getFirstMediaUrl('thumbnail'))
                <div class="sidebar-main-img mx-0">
                    <img src="{{ $selectedTour->getFirstMediaUrl('thumbnail') }}" alt="preview-img"/>
                </div>
            @endif

            <div class="select-box">
                <div class="input-group mt-4 border-1">
                    <select wire:model.live="selectedTourId" wire:change="selectTour" class="form-control">
                        @foreach($project->tours as $tour)
                            <option value="{{ $tour->id}}">{{ $tour->name }}</option>
                        @endforeach
                    </select>
                    @if($selectedTourId)
                        <a href="{{ route('tours.show', [$selectedTourId, 'project_id' => $project->id]) }}"
                           class="input-group-text bg-white text-decoration-none">Enter
                        </a>
                    @endif
                </div>
            </div>--}}

            <div class="mb-3">
                <table class="table">
                    <tr>
                        <th>Layout Name</th>
                        <th>Tour</th>
                        <th>Created By</th>
                        <th></th>
                    </tr>

                    @forelse($project->layouts as $layout)
                        <tr>
                            <td>{{ $layout->name }}</td>
                            <td>{{ $layout->tour->name }}</td>
                            <td>{{ $layout->user->name }}</td>
                            <td>
                                <a class="text-dark" href="{{ route('tours.show', [$layout->tour_id, 'layout_id' => $layout->id]) }}">
                                    <i class="fal fa-sign-in"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="pb-5 text-capitalize text-center">
                                <h6 class="mb-3">No layout created</h6>
                                <button class="btn btn-light btn sm" wire:modal="forms.layout-form, @js(['project' => $project->id])" >
                                    Create Layout <i class="fal fa-plus ms-2"></i>
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </table>

                @if($project->layouts->count())
                    <div class="text-end">
                        <button class="btn btn-light btn sm"
                                wire:modal="forms.layout-form, @js(['project' => $project->id])">
                            Create Layout <i class="fal fa-plus ms-2"></i>
                        </button>
                    </div>
                @endif
            </div>

            <div class="collection mt-5">
                <h5>Collections</h5>
                @forelse($project->artworkCollections as $collection)
                    <a href="{{ route('artworks.index', ['collection_id' => $collection->id]) }}"
                       target="_blank" class="col-btn">{{ $collection->name }}</a>
                @empty
                    <span class="text-center d-block">{{ __('No collections') }}</span>
                @endforelse
            </div>

            <div class="contributor">
                <h5>Contributors</h5>
                <div class="img-container d-flex">
                    @forelse($project->contributors as $contributor)
                        <div class="name-tip" data-text="{{ $contributor->name }}">
                            <img src="{{ $contributor->avatar_url }}" alt="{{ $contributor->name }}"/>
                        </div>
                    @empty
                        <span class="text-center d-block">{{ __('No contributors') }}</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-wire-elements-pro::bootstrap.slide-over>