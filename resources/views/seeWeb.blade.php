@extends('layouts.master')

@section('modal')
    
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Estas segur de que desitjar eliminar la WEB '<i><span class="web-name"></span></i>'?</p>
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
    
    @if ($dada != null)

        <table class="table table-stripped web-table">
            <thead>
                <th>ID</th>
                <th>Nom</th>
                <th>URL</th>
                <th>Descripció</th>
                <th></th>
            </thead>    

            <tbody>

                <tr>
                    <td>{{$dada->id}}</td>
                    <td>{{$dada->name}}</td>
                    <td><a href="{{$dada->url}}" target="_blank">{{$dada->url}}<a></td>
                    <td>{{$dada->description}}</td>
                    <td class="button-actions-2">
                        <button type="button" class="btn btn-outline-warning web-link" data-link="/web/{{$dada->id}}/edit">Editar</button>
                        <button type="button" class="btn btn-outline-danger delete-web" data-webid="{{$dada->id}}" data-webname="{{$dada->name}}">Esborrar</button>
                    </td>
                </tr>              



            </tbody>
        </table>

        @else
            <h3 class="not-results">Sense resultats</h3>
        @endif

@endsection

@section('script')
    
    <script src="{{asset('js/webs.js')}}"></script>

@endsection