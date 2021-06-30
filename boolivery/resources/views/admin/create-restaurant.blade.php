@extends('layouts.main-layout')

@section('content')
<main>

    <div class="createRestContainer">
        <div class="turnBackCont">
            <a class="turnBack" href="{{route('listRestaurant')}}">Torna ai Ristoranti</a>
        </div>
        {{-- DA INSERIRE CODICE RILEVAZIONE ERRORI --}}
        <div class="polygon"></div>
        <div class="polygonTwo"></div>
        <div class="polygonThree"></div>
        <div class="createRestTitle">
            <h2>Aggiungi Ristorante</h2>
        </div>
        
        <div class="formCreateRest">



            <form method="POST" action="{{route('storeRestaurant')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                {{-- restaurant --}}
                <div class="form-group">
                    <label for="name">Nome Ristorante</label>
                    <input type="text" id="name" name="name" maxlength="255" placeholder="Nome Ristorante">
                </div>
                <div class="form-group">
                    <label for="address">Indirizzo Ristorante</label>
                    <input type="text" id="address" name="address" maxlength="255" placeholder="Indirizzo">
                </div>
                <div class="form-group">
                    <label for="phone">Num telefono</label>
                    <input type="number" id="phone" name="phone" maxlength="64" placeholder="Telefono">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <input type="text" id="description" name="description"  maxlength="1000" placeholder="Descrizione">
                </div>
                <div class="form-group insert-img">
                    <label for="image_profile">Carica una foto profilo</label>
                    <input type="file" id="image_profile" name="image_profile">
                </div>
                <div class="form-group insert-img">
                    <label for="image_cover">Carica una foto copertina</label>
                    <input type="file" id="image_cover" name="image_cover">
                </div>
                {{-- <div class="form-group">
                    <label for="popular">Vuoi sponsorizzare il ristorante?</label>
                    <select name="popular" id="popular">
                        <option value="0">Si'</option>
                        <option value="1">No</option>
                    </select>
                </div> --}}
                {{-- categorie --}}
                <p>Scegli almeno 1 categoria</p>
                <div class="categoryCheckboxes">
                    @foreach ($categories as $category)
                    
                        <div>
                            <label for="category_id[]">{{$category->name}}</label>
                            <input type="checkbox" name="category_id[]" id="category_id[]" value="{{$category->id}}">
                        </div>
                    
                    @endforeach
                </div>
                {{-- ERRORI --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <button type="submit" class="btn btn-primary">Crea</button>
            </form>
        </div>
    </div>
</main>
@endsection