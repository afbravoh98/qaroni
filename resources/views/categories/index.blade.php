@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row text-end mt-2">
            <div class="col">
                <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Idioma</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">
                                    {{ $category->id }}
                                </th>
                                <th>
                                    {{ $category->translation($lang)->name }}
                                </th>
                                <th scope="row">
                                    {{ $category->translation($lang)->language }}
                                </th>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn" href="/categories/{{$category->slug}}/edit"> <i class="fa fa-pencil"></i></a>
                                        <form method="POST" action="{{route('categories.delete',$category->slug)}}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="form-group">
                                                <input type="submit" class="fa fa-close delete-user" value="Borrar"/>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @extends('categories.create')
    </div>
@endsection
@section('scripts')
    <script>
        $('.delete-user').click(function(e){
            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Are you sure?')) {
                // Post the form
                $(e.target).closest('form').submit() // Post the surrounding form
            }
        });
    </script>
@endsection
