<header id="header" :class="(scrollOn == true) ? 'box-shadow' : ''" >
    <nav id="nav-header">
        <div id="logo">
            <a href="{{route('home')}}">
                <img src="{{ asset('storage/graphics/Logo.png') }}">
            </a>
        </div>
        <div id="container-list">
            <ul>
                <li class="nav-list">
                    <a href="{{route('info-company')}}">
                    <i class="fas fa-info-circle"></i> Chi siamo
                    </a>
                </li>
                <li class="nav-list">
                    <a href="{{route('faq')}}">
                    <i class="fas fa-question-circle"></i> FAQ
                    </a>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-list">
                        <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Accedi') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-list">
                            <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> {{ __('Registrati') }}</a>
                        </li>
                    @endif
                @else
                    <li id="liDropdown" class="nav-list" v-on:click="getDropDown" :class="(dropDown == true) ? 'back-groundcl' : ''">
                        <a href="#" role="button"  v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div id="drop-container" :class="(dropDown == false) ? 'none' : 'active'">
                            <div>
                                <a id="dashboard" href="{{route('listRestaurant')}}">
                                    Dashboard
                                </a>
                            </div>
                            <a id="logout" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
        <div class="hamburger" v-on:click="activeMenu()">
            <i class="fas fa-bars"></i>
            <div v-if="active === true" class="menuHamburger">
                <ul>
                    <li class="nav-list">
                        <a href="{{route('info-company')}}">
                        <i class="fas fa-info-circle"></i> Chi siamo
                        </a>
                    </li>
                    <li class="nav-list">
                        <a href="{{route('faq')}}">
                        <i class="fas fa-question-circle"></i> FAQ
                        </a>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-list">
                            <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Accedi') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-list">
                                <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> {{ __('Registrati') }}</a>
                            </li>
                        @endif
                    @else
                        <li id="liDropdown" class="nav-list" v-on:click="getDropDown" >
                            <a href="#" role="button"  v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div id="drop-container" :class="(dropDown == false) ? 'none' : 'active'">
                                <div>
                                    <a id="dashboard" href="{{route('listRestaurant')}}">
                                        Dashboard
                                    </a>
                                </div>
                                <a id="logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function () {

    new Vue({
        el: '#header',
        data: {
            dropDown: false,
            scrollOn: false,
            active: false,
        },
        mounted(){
            document.addEventListener('scroll', this.scrollUp);
        },
        methods: {
            // funzione che apre e chiude il dropdown
            getDropDown: function(){
                this.dropDown = !this.dropDown;
            },
            // funziona per gestire il cambio background header con lo scroll
            scrollUp: function () {
                this.scrollOn = true;
                if(window.scrollY == 0){
                    this.scrollOn = false;
                }
            },
            activeMenu: function() {
                this.active = !this.active;
            },
            disactiveMenu: function() {
                if (this.active == true) {
                    this.active = !this.active;
                }
            }
        },
    });
});
</script>