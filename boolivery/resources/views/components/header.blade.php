<header>
    <nav id="nav-header">
        <div id="logo">
            <a href="{{route('home')}}">
                <img src="{{ asset('storage/graphics/logo.png') }}">
            </a>
        </div>
        <div id="container-list">
            <ul>
                <li class="nav-list">
                    <a href="{{route('info-company')}}">
                        Chi siamo
                    </a>
                </li>
                <li class="nav-list">
                    <a href="{{route('faq')}}">
                        FAQ
                    </a>
                </li>
                <li class="nav-list">
                    <a href="{{route('contacts')}}">
                        Contatti
                    </a>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-list">
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-list">
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
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
    </nav>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function () {

    new Vue({
        el: '#nav-header',
        data: {
            dropDown: false,
        },
        methods: {
            getDropDown: function(){
                this.dropDown = !this.dropDown;
            },
        },
    });
});
</script>