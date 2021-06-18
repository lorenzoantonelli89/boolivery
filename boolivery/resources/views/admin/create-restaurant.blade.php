@extends('layouts.main-layout')

@section('content')
    
    <div class="container py-4">
        {{-- DA INSERIRE CODICE RILEVAZIONE ERRORI --}}
        <h1>Aggiungi nuovo Ristorante</h1>
        <form method="POST" action="{{route('storeRestaurant')}}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            {{-- restaurant --}}
            <div class="form-group">
                <label for="name">Nome Ristorante</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="address">Indirizzo Ristorante</label>
                <input type="text" id="address" name="address">
            </div>
            <div class="form-group">
                <label for="phone">Num telefono</label>
                <input type="number" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="description">Descrizione</label>
                <input type="text" id="description" name="description">
            </div>
            <div class="form-group">
                <label for="image_profile">Foto Profilo</label>
                <input type="file" id="image_profile" name="image_profile">
            </div>
            <div class="form-group">
                <label for="image_cover">Foto Copertina</label>
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
            <div class="form-group">
                <p>Scegli categorie</p>
                @foreach ($categories as $category)
                <div>
                    <div>
                        <label for="category_id[]">{{$category->name}}</label>
                        <input type="checkbox" name="category_id[]" id="category_id[]" value="{{$category->id}}">
                    </div>
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

@endsection