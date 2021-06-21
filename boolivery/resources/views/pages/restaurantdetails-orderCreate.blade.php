@extends('layouts.main-layout')
@section('title')

    {{$restaurant -> name}} 
    
@endsection

@section('content')

    <main>
        <div class="container" id="app2">
            <div>
                <h2>{{$restaurant->name}}</h2>
                <div>{{$restaurant->address}}</div>
                <h3>Lista piatti</h3>
                <ul>
                    @foreach ($restaurant->plates as $plate)
                        <li>
                            <div>
                                <span>{{$plate->name}}</span>
                                <span><button v-on:click="addPlate({{$plate->id}},{{$plate->price}})">ADD</button></span>
                                <span><button v-on:click="removePlate({{$plate->id}},{{$plate->price}})">REMOVE</button></span>
                            </div>
                            <div>{{$plate->price}}</div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <form action="{{route('createOrder')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div>
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name">
                    </div>
                    <div>
                        <label for="lastname">Cognome</label>
                        <input type="text" id="lastname" name="lastname">
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div>
                        <label for="shipping_address">Indirizzo</label>
                        <input type="text" id="shipping_address" name="shipping_address">
                    </div>
                    <div>
                        <div v-for="item in cart">
                            <input type="number" name="plates_ids[]" :value="item">
                        </div>
                    </div>
                    <div>
                        <label for="total_price">Total Price</label>
                        <input type="text" id="total_price" name="total_price" :value="total" readonly>
                    </div>
                    <div>
                        <label for="date_delivery">Data</label>
                        <input type="date" id="date_delivery" name="date_delivery">
                    </div>
                    <div>
                        <label for="time_delivery"></label>
                        <input type="time" id="time_delivery" name="time_delivery">
                    </div>
                    <div>
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="0">Pagato</option>
                            <option value="1">Da pagare</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Crea</button>
                    </div>
                    
                </form>
            </div>
            
        </div>
    </main>

    <script>
        new Vue({
          el: '#restaurant-details-container',
          data: {
              cart: [],
              total:0
          },
          methods: {
                addPlate: function (value, price){
                    this.cart.push(value);
                    this.total = this.total+price;
                    console.log(this.cart, price);
                },
                removePlate: function(value, price){
                    const index = this.cart.indexOf(value);
                    if(index > -1){
                        this.cart.splice(index, 1);
                        this.total = this.total-price;
                    }
                    console.log(this.cart);
                },
          },
          computed: {
              
          }
      });
    </script>
    
@endsection