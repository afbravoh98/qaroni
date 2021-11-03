<!-- Modal -->
<div class="modal fade" id="orderModal-{{$event->id}}" tabindex="-1" aria-labelledby="orderModal-{{$event->id}}" aria-hidden="true">
    <form method="POST" action="{{ route('events.order', ['slug' => $event->slug])}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModal">Reservar ticket's evento {{ $event->translation($lang)->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                @csrf
                                <div>
                                    <label class="mt-2" for="quantity">
                                        {{ __('Quantity') }}
                                        <input class="form-control" type="number" min="1" name="quantity"/>
                                    </label>
                                    @error('quantity')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <label class="mt-2" for="email">
                                        {{ __('Email') }}
                                        <input class="form-control" type="email" name="email"/>
                                    </label>
                                    @error('email')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Reservar</button>
                </div>
            </div>
        </div>
    </form>
</div>
