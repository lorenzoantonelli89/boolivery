@extends('layouts.main-layout')

@section('content')


    <main class="createPlate">
        <div class="createPlateContainer">
          <a class='backToPlateList' href="{{route('plateList', encrypt(($restaurant  -> id)))}}">Torna ai piatti</a>
  {{-- inizio form --}}
         
           <div class="createPlateContainerForm">
                <div class="createTitle">
                    <h2>
                        Modifica Piatto:
                    </h2>
                </div>

              <form method="POST" enctype="multipart/form-data" action="{{route('storePlate', $restaurant->id)}}">
  
                  @csrf
                  @method('POST')
          
                  <div class="form-group">
                    
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" placeholder="Nome piatto">
                    
                  </div>
  
                  <div class="form-group">
                    <label for="description">Descrizione</label>
                    <textarea  class="form-control descInp" name="description" placeholder="Descrizione piatto"></textarea>
                  </div>
  
                  <div class="form-group insertImg">
                      <label for="image">Immagine</label>
                      <input  class='insertFile' type="file" class="form-control" name="image" value="image">
                      {{-- @if (($plate -> image != null) )
                        <img class="protoImg" src="{{ asset('/storage/restaurant-plates')}}/{{ $plate->image }}" alt="{{ $plate->plate_name }}">
                      @endif --}}
                  </div>
  
                  <div class="form-group price">
                      <label  for="price">Prezzo</label>
                      <span>
                        <input  type="number"  name="price" step="0.01"  placeholder="Prezzo">
                        <span class="euro">€</span>
    
                      </span>
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