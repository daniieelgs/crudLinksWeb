@extends('layouts.master')

@section('content')
        
    <div class="card text-center formCardCenter">
        <div class="card-header">
            Editar WEB
        </div>
        <div class="card-body">

            
            <form class="row g-3 needs-own-validation" novalidate id="form" action="/web/{{$dada->id}}" method="POST">
                
                @csrf

                @method('PUT')

                <div class="col-12 form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" data-oldvalue="{{ old('name') }}" name="name" placeholder=" " value="{{$dada->name}}" required>
                    <label for="nom">Nom</label>
                    <div class="invalid-feedback">
                        @if($errors->has('name'))
                            {{$errors->first('name')}}
                        @else
                            Camp obligatori.
                        @endif  
                    </div>
                </div>
                <div class="col-12 form-floating">
                    <input type="text" class="form-control regex-check @error('url') is-invalid @enderror" data-regex="[A-z0-9]+\.[A-z0-9]+" id="url" data-oldvalue="{{ old('url') }}" name="url" placeholder=" " value="{{$dada->url}}" required>
                    <label for="url">URL</label>
                    <div class="invalid-feedback">
                        URL invalid.
                    </div>
                </div>

                <div class="col-12">
                    <label for="description">Descripció</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" data-oldvalue="{{ old('description') }}" id="description" name="description" placeholder=" " required>{{$dada->description}}</textarea>
                    <div class="invalid-feedback">
                        Introdueix una descripció.
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Actualitzar</button>
                </div>
            </form>      
            
        </div>
    </div>
@endsection

@section('script')

    <script>

        const nameField = document.getElementById("name");
        const originalValue = nameField.value;

        const invalidFeedback = nameField.parentElement.querySelector(".invalid-feedback");
        const originalMessage = invalidFeedback.innerText;

        const btnSubmit = document.getElementById("btnSubmit");

        let nameList = [];

        fetch('http://linksweb.test/api/readAllNames')
            .then(res => res.json())
            .then(res => nameList = res.map(n => n.name))
            .catch(console.error);

        nameField.addEventListener("blur", () => {

            if(nameField.value != originalValue && nameList.includes(nameField.value)){
                nameField.classList.remove("is-valid");
                nameField.classList.add("is-invalid");
                invalidFeedback.innerText = "Aquest nom ja está registrat."
                btnSubmit.disabled = true;
            }else if(!nameField.value.trim()){
                nameField.classList.remove("is-valid");
                nameField.classList.add("is-invalid");
                btnSubmit.disabled = false;
            }else {
                nameField.classList.remove("is-invalid");
                nameField.classList.add("is-valid");
                invalidFeedback.innerText = originalMessage;
                btnSubmit.disabled = false;
            }
        });


    </script>

    <script src="{{asset('js/validateForm.js')}}"></script>
    <script type="text/javascript" src="https://chir.ag/projects/ntc/ntc.js"></script>
@endsection