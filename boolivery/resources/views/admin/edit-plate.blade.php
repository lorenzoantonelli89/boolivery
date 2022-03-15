@extends('layouts.main-layout')

@section('title')
    Modifica {{$plate -> name}} 
@endsection


@section('content')

    <main class="editPlate">
      <div class="editPlateContainer">

        <div>
          <a class='backToPlateList' href="{{route('plateList', encrypt($plate -> restaurant_id))}}">Torna ai piatti</a>
        </div>
{{-- inizio form --}}
          <div class="polygon"></div>
          <div class="polygonTwo"></div>
          


          <div class="editPlateTitle">
            <h2>
                Modifica Piatto:
            </h2>
          </div>
         <div class="container">

            <form method="POST" enctype="multipart/form-data" action="{{route('updatePlate', $plate -> id)}}">

                @csrf
                @method('POST')

                @if ($errors->any())
                  <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                  </div>
                @endif
        
                <div class="form-group">
                  
                  <label for="name">Nome</label>
                  <input type="text" class="form-control" name="name" value="{{$plate -> name}}" placeholder="Nome piatto" required>
                  
                </div>

                <div class="form-group">
                  <label for="description">Descrizione</label>
                  <textarea  class="form-control descInp" name="description" value="{{$plate -> description}}" placeholder="Descrizione piatto" required>{{$plate -> description}}</textarea>
                </div>

                <div class="form-group insertImg">
                    <label for="image">Immagine</label>
                    
                    <div>
                      @if (($plate -> image != null) )
                        <img class="protoImg" src="{{ asset('/storage/restaurant-plates')}}/{{ $plate->image }}" alt="{{ $plate->plate_name }}">
                      @endif
                      <input  class='insertFile' type="file" class="form-control" name="image" value="image">
                    </div>
                </div>

                <div class="form-group price">
                    <label  for="price">Prezzo</label>
                    <span>
                      <input  type="number"  name="price" step="0.01" value="{{$plate -> price}}" placeholder="Prezzo piatto" required>
                      <span class="euro">€</span>
  
                    </span>
                </div>

                <div class="form-group">
                  <div class="visibility">Visibilità:</div>
                  <div class="radio">
                      
                      <label for="visible">Non visibile</label>
                      <input id="visible" type="radio" name="visible" value="0" >
                  
                      <label for="visible">Visibile</label>
                      <input id="visible" type="radio" name="visible" value="1" >
                  </div>
              </div>


               
               

                <button type="submit" class="btn btn-primary">Modifica</button>

              </form>
        </div>
      
      </div>
    </main>
    
@endsection