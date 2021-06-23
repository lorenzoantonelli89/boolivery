@extends('layouts.main-layout')

@section('content')

    <main class="editPlate">
      <div class="editPlateContainer">
        <a class='backToPlateList' href="{{route('plateList', encrypt($plate -> restaurant_id))}}">Torna ai piatti</a>
{{-- inizio form --}}
       
         <div class="container">

            <h2>
                Modifica Piatto:
            </h2>

            <form method="POST" enctype="multipart/form-data" action="{{route('updatePlate', $plate -> id)}}">

                @csrf
                @method('POST')
        
                <div class="form-group">
                  
                  <label for="name">Nome</label>
                  <input type="text" class="form-control" name="name" value="{{$plate -> name}}" placeholder="Nome piatto">
                  
                </div>

                <div class="form-group">
                  <label for="description">Descrizione</label>
                  <input type="text" class="form-control" name="description" value="{{$plate -> description}}" placeholder="Descrizione piatto">
                </div>

                <div class="form-group insertImg">
                    <label for="image">Immagine</label>
                    <input type="file" class="form-control" name="image" value="image">
                    @if (($plate -> image != null) )
                      <img class="protoImg" src="{{ asset('/storage/restaurant-plates')}}/{{ $plate->image }}" alt="{{ $plate->plate_name }}">
                    @endif
                </div>

                <div class="form-group price">
                    <label  for="price">Prezzo</label>
                    <input  type="number"  name="price" step="0.01" value="{{$plate -> price}}" placeholder="Prezzo piatto">
                    <span class="euro">€</span>
                </div>

                <div class="form-group">
                  <div class="visibility">Visibilità:</div>
                  <div class="radio">
                      
                      <label for="visible">Non visibile</label>
                      <input id="visible" type="radio" step="0.01" name="visible" value="0" >
                  
                      <label for="visible">Visibile</label>
                      <input id="visible" type="radio" step="0.01" name="visible" value="1" >
                  </div>
              </div>


               
                @if ($errors->any())
                  <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                  </div>
                @endif

                <button type="submit" class="btn btn-primary">Modifica</button>

              </form>
        </div>
      
      </div>
    </main>
    
@endsection