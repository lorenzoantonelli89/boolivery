@extends('layouts.main-layout')

@section('content')

<main>

    <div class="container">


       
            <h2>
                Aggiungi un nuovo piatto:
            </h2>

            <form method="POST" enctype="multipart/form-data" action="{{route('storePlate', $restaurant->id)}}">

                @csrf
                @method('POST')
        
                <div class="form-group">
                  
                  <label for="name">Nome</label>
                  <input id="name" type="text" class="form-control" name="name" placeholder="Nome piatto">
                  
                </div>

                <div class="form-group">
                  <label for="description">Descrizione</label>
                  <input id="description" type="text" class="form-control" name="description"  placeholder="Descrizione piatto">
                </div>

                <div class="form-group">
                    <label for="image">Immagine</label>
                    <input id="image" type="file" class="form-control" name="image">
                </div>


                <div class="form-group">
                    <label  for="price">Prezzo</label>
                    <input id="price" type="number" step="0.01" name="price"  placeholder="Prezzo piatto">
                </div>


                <div class="form-group">
                    <div class="my-3">Visibilità:</div>
                    <div>
                        <label for="visible">Non visibile</label>
                        <input id="visible" type="radio"  name="visible" value="0" >
                    </div>
                    <div>
                        <label for="visible">Visibile</label>
                        <input id="visible" type="radio"  name="visible" value="1" >
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