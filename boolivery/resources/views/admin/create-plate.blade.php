@extends('layouts.main-layout')

@section('content')

<main>

    <div class="container">


       
            <h2>
                Aggiungi un nuovo piatto:
            </h2>

            <form method="POST" action="{{route('storePlate')}}">

                @csrf
                @method('POST')
        
                <div class="form-group">
                  
                  <label for="name">Nome</label>
                  <input type="text" class="form-control" name="name" placeholder="Nome piatto">
                  
                </div>

                <div class="form-group">
                  <label for="description">Descrizione</label>
                  <input type="text" class="form-control" name="description"  placeholder="Descrizione piatto">
                </div>

                <div class="form-group">
                    <label for="image">Immagine</label>
                    <input type="file" class="form-control" name="image">
                </div>


                <div class="form-group">
                    <label  for="price">Prezzo</label>
                    <input type="number" step="0.01" name="price"  placeholder="Prezzo piatto">
                </div>

               

                <button type="submit" class="btn btn-primary">Submit</button>

              </form>
        </div>

</main>
    

@endsection