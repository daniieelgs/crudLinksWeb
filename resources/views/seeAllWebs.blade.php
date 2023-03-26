@extends('layouts.master')

@section('modal')
    
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar WEB</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Estas segur de que desitjar eliminar la web '<i><span class="web-name"></span></i>'?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tancar</button>
            <form class="form-delete" action="" method="POST">

                @csrf

                @method('DELETE')

                <button type="submit" class="btn btn-danger btn-delete">Eliminar</button>
            </form>
            </div>
        </div>
        </div>
    </div>

@endsection

@section('content')
    
    @if (!isset($dades) || count($dades) == 0)
        <h3 class="not-results">Sense resultats</h3>
    @else
        <table class="table table-stripped web-table">
            <thead>
                <th>Nom</th>
                <th>URL</th>
                <th>Descripció</th>
                <th></th>
            </thead>    

            <tbody>

                @forelse ($dades as $dada)

                    <tr>
                        <td>{{$dada->name}}</td>
                        <td><a href="{{$dada->url}}" target="_blank">{{$dada->url}}<a></td>
                        <td class="column-text-description" title="{{$dada->description}}">{{$dada->description}}</td>
                        <td class="button-actions-3">
                            <button type="button" class="btn btn-outline-success web-link" data-link="/web/{{$dada->id}}">Veure</button>
                            <button type="button" class="btn btn-outline-warning web-link" data-link="/web/{{$dada->id}}/edit">Editar</button>
                            <button type="button" class="btn btn-outline-danger delete-web" data-webId="{{$dada->id}}" data-webName="{{$dada->name}}">Esborrar</button>
                        </td>
                    </tr>
                    
                @empty

                @endforelse

            </tbody>
        </table>

    @endif

@endsection

@section('script')
    
    <script src="{{asset('js/webs.js')}}"></script>

@endsection