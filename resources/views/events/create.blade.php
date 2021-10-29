<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" action="{{ route('events.store')}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                                @csrf
                                <div>
                                    <label class="mt-2" for="capacity">
                                        {{ __('Capacity') }}
                                        <input class="form-control" type="number" min="1" name="capacity"/>
                                    </label>
                                    @error('capacity')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                        </div>
                        <div class="col-6">
                            <label class="mt-2" for="date">
                                {{ __('Date') }}
                                <input
                                    class="form-control"
                                    type="date"
                                    id="date"
                                    name="date"
                                    value="{{ now()->format('Y-m-d') }}"
                                    min="{{ now()->format('Y-m-d') }}"
                                    max="{{ now()->addYears(2)->format('Y-m-d') }}"
                                >
                            </label>
                            @error('date')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        @foreach(Config::get('constants.default_languages') as $language)
                           <div class="col-6">
                               <label class="mt-2" for="capacity">
                                   {{ __("Name ($language)") }}
                                   <input class="form-control" type="text" min="1" name="name_{{$language}}"/>
                               </label>
                               @error("name_$language")
                               <small class="form-text text-danger">{{$message}}</small>
                               @enderror
                           </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="mt-2" for="categoryId">
                                    {{ __('Category') }}
                                    <select  id="categoryId" name="categoryId" class="form-control">
                                        @foreach($categories as $category)
                                            <option value={{ $category->id }}>
                                                {{$category->translation($lang)->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                                @error('categoryId')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </div>
    </form>
</div>
