@extends('layouts.main-layout')

@section('content')

    <main>

         <a href="{{route('plateList', $plate -> restaurant_id)}}">Torna ai piatti</a>
{{-- inizio form --}}
         <div class="container">

            <h2>
                Modifica Piatto:
            </h2>

            <form method="POST" action="{{route('updatePlate', $plate -> id)}}">

                @csrf
                @method('POST')
        
                <div class="form-group">
                  
                  <label for="plate_name">Nome</label>
                  <input type="text" class="form-control" name="plate_name" value="{{$plate -> plate_name}}" placeholder="Nome piatto">
                  
                </div>

                <div class="form-group">
                  <label for="description">Descrizione</label>
                  <input type="text" class="form-control" name="description" value="{{$plate -> description}}" placeholder="Descrizione piatto">
                </div>

                <div class="form-group">
                    <label for="image">Immagine</label>
                    <input type="file" class="form-control" name="image">
                </div>


                <div class="form-group">
                    <label  for="price">Prezzo</label>
                    <input type="number" step="0.01" name="price" value="{{$plate -> price}}" placeholder="Prezzo piatto">
                </div>

               

                <button type="submit" class="btn btn-primary">Submit</button>

              </form>
        </div>

    </main>
    
@endsection