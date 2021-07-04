@extends('layouts.main-layout')

@section('title')
    Modifica {{$restaurant ->name}}
@endsection

@section('content')
    <main>
            <div class="containerEditRestaurant">

                <div class="turnBackCont">
                    <a class="turnBack" href="{{route('listRestaurant')}}">Torna ai Ristoranti</a>
                </div>

                <div class="polygon"></div>
                <div class="polygonTwo"></div>
                <div class="polygonThree"></div>
                {{-- DA INSERIRE CODICE RILEVAZIONE ERRORI --}}
                <div class="createRestTitle">
                    <h2>Modifica Ristorante {{$restaurant->name}}</h2>
                </div>

                <div class="formEditRestaurant">
                    <form method="POST" action="{{route('updateRestaurant',$restaurant->id)}}"  enctype="multipart/form-data">
                        @csrf
                        @method('POST')

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
                        {{-- restaurant --}}
                        <div class="form-group">
                            <label for="name">Nome Ristorante:</label>
                            <input type="text" id="name" name="name" value="{{$restaurant->name}}" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Indirizzo Ristorante:</label>
                            <input type="text" id="address" name="address" value="{{$restaurant->address}}" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Num telefono:</label>
                            <input type="number" id="phone" name="phone" value="{{$restaurant->phone}}" maxlength="64" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="{{$restaurant->email}}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descrizione</label>
                            <textarea type="text" id="description" name="description" value="{{$restaurant->description}}" maxlength="1000" required>{{$restaurant->description}}</textarea>
                        </div>

                        <div class="imgSectionCont">
                            <div class="form-group insert-img">
                            
                                <label for="image_profile">Foto Profilo:</label>
                                <input type="file" id="image_profile" name="image_profile" >
                            
                                @if (($restaurant -> image_profile != null) )
                                    <img class="protoImg" src="{{ asset('/storage/restaurant-profile')}}/{{ $restaurant->image_profile }}" alt="{{ $restaurant->name }}">
                                @endif

                            </div>
                            <div class="form-group insert-img">
                                <label for="image_cover">Foto Copertina:</label>
                                <input type="file" id="image_cover" name="image_cover" >

                                @if (($restaurant -> image_cover != null) )
                                    <img class="protoImg" src="{{ asset('/storage/restaurant-cover')}}/{{ $restaurant->image_cover }}" alt="{{ $restaurant->name }}">
                                @endif
                            </div>
                        </div>

                        <p>Scegli categorie:</p>
                        <div class="categoryCheckboxes">
                            @foreach ($categories as $category)
                            
                                <div class="checkboxesContainer">
                                    <input type="checkbox" name="category_id[]" id="category_id[]" value="{{$category->id}}"
                                        @foreach ($restaurant->categories as $catRes)
                                            @if ($catRes->id == $category->id)
                                                checked
                                            @endif
                                        @endforeach
                                    >
                                    <label for="category_id[]">{{$category->name}}</label>
                                </div>
                            
                            @endforeach
                        </div> 
                    
                        <button class="button" type="submit" class="btn btn-primary blink">Modifica</button>
                        
                        
                        
                       
                        
                        </form>
                    </div>
            </div>

        </main>
    
@endsection