@extends('layouts.main-layout')

@section('content')

    <main>

         <a href="{{route('plateList', $plate -> restaurant_id)}}">Torna ai piatti</a>
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

                <div class="form-group">
                    <label for="image">Immagine</label>
                    <input type="file" class="form-control" name="image" value="image">
                    @if (($plate -> image != null) )
                      <img style="height: 100px; width:180px; object-fit:contain" src="{{ asset('/storage/restaurant-plates')}}/{{ $plate->image }}" alt="{{ $plate->plate_name }}">
                    @endif
                </div>

                <div class="form-group">
                    <label  for="price">Prezzo</label>
                    <input type="number"  name="price" step="0.01" value="{{$plate -> price}}" placeholder="Prezzo piatto">
                </div>

                <div class="form-group">
                  <div class="my-3">Visibilità:</div>
                  <div>
                      <label for="visible">Non visibile</label>
                      <input id="visible" type="radio" step="0.01" name="visible" value="0" >
                  </div>
                  <div>
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

                <button type="submit" class="btn btn-primary">Submit</button>

              </form>
        </div>

    </main>
    
@endsection