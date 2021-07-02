@extends('layouts.main-layout')

@section('title')
    Aggiungi piatto di {{$restaurant -> name}}
@endsection

@section('content')


    <main class="createPlate">
        <div class="createPlateContainer">

          <div>
            <a class='backToPlateList' href="{{route('plateList', encrypt(($restaurant  -> id)))}}">Torna ai piatti</a>
          </div>

          <div class="polygon"></div>
          <div class="polygonTwo"></div>

          <div class="createTitle">
              <h2>
                  Aggiungi Piatto:
              </h2>
          </div>
                
           <div class="createPlateContainerForm">

              <form method="POST" enctype="multipart/form-data" action="{{route('storePlate', $restaurant->id)}}">
  
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
                    <input type="text" class="form-control" name="name" placeholder="Nome piatto" required>
                    
                  </div>
  
                  <div class="form-group">
                    <label for="description">Descrizione</label>
                    <textarea  class="form-control descInp" name="description" placeholder="Descrizione piatto" required></textarea>
                  </div>
  
                  <div class="form-group insertImg">
                      <label for="image">Immagine</label>
                      <input  class='insertFile' type="file" class="form-control" name="image" value="image" required>
                      {{-- @if (($plate -> image != null) )
                        <img class="protoImg" src="{{ asset('/storage/restaurant-plates')}}/{{ $plate->image }}" alt="{{ $plate->plate_name }}">
                      @endif --}}
                  </div>
  
                  <div class="form-group price">
                      <label  for="price">Prezzo</label>
                      <span>
                        <input  type="number"  name="price" step="0.01"  placeholder="Prezzo" required>
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
  
  
                 
                 
  
                  <button type="submit" class="btn btn-primary">Crea</button>
  
                </form>
          </div>
        
        </div>
      </main>

    

@endsection