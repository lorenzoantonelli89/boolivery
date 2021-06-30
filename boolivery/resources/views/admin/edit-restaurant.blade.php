@extends('layouts.main-layout')

@section('title')
    Modifica ristorante
@endsection

@section('content')
    
    <div class="container py-4">
        {{-- DA INSERIRE CODICE RILEVAZIONE ERRORI --}}
        <h1>Modifica Ristorante {{$restaurant->name}}</h1>
        <form method="POST" action="{{route('updateRestaurant',$restaurant->id)}}"  enctype="multipart/form-data">
            @csrf
            @method('POST')
            {{-- restaurant --}}
            <div class="form-group">
                <label for="name">Nome Ristorante:</label>
                <input type="text" id="name" name="name" value="{{$restaurant->name}}" maxlength="255">
            </div>
            <div class="form-group">
                <label for="address">Indirizzo Ristorante:</label>
                <input type="text" id="address" name="address" value="{{$restaurant->address}}" maxlength="255">
            </div>
            <div class="form-group">
                <label for="phone">Num telefono:</label>
                <input type="number" id="phone" name="phone" value="{{$restaurant->phone}}" maxlength="64">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{$restaurant->email}}">
            </div>
            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea type="text" id="description" name="description" value="{{$restaurant->description}}" maxlength="1000">{{$restaurant->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="image_profile">Foto Profilo:</label>
                <input type="file" id="image_profile" name="image_profile">
            </div>
            <div class="form-group">
                <label for="image_cover">Foto Copertina:</label>
                <input type="file" id="image_cover" name="image_cover">
            </div>
            {{-- <div class="form-group">
                <label for="popular">Vuoi sponsorizzare il ristorante?</label>
                <select name="popular" id="popular">
                    <option value="0"
                    @if ($restaurant->popular == 0)
                        selected
                    @endif
                    >Si'</option>
                    <option value="1"
                    @if ($restaurant->popular == 1)
                        selected
                    @endif
                    >No</option>
                </select>
            </div> --}}
            {{-- categorie --}}
            <div class="form-group" id="category-picker">
                <p>Scegli categorie:</p>
                @foreach ($categories as $category)
                <div>
                    <div class="right-distance">
                        <label for="category_id[]">{{$category->name}}</label>
                        <input type="checkbox" name="category_id[]" id="category_id[]" value="{{$category->id}}"
                        @foreach ($restaurant->categories as $catRes)
                            @if ($catRes->id == $category->id)
                                checked
                            @endif
                        @endforeach
                        >
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
               
            <div id="btn">
                <button type="submit" class="btn btn-primary blink">Update</button>
            </div>
            </form>
    </div>

@endsection