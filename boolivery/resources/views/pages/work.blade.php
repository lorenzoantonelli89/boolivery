@extends('layouts.main-layout')
@section('title')

    Lavora con noi
    
@endsection
@section('content')

    <main>
        <div id="work-container">
            <div id="section-1">
                <!-- Trapezio in position absolute -->
                <div id="absolute-trapezoid"></div>
                <div class="div-margin">
                    <div id="text-intro">
                        <h1>Entra a far parte della nostro team work!</h1>
                        <p>Quando pensi a Booliveroo, probabilmente pensi alla possibilità di ricevere i piatti che ami a domicilio, in mezz'ora.<br> 
                        Incredibile, vero? Eppure, le cose veramente incredibili succedono dietro le quinte: storie di grande crescita, immense sfide ed enormi opportunità.<br>
                        Storie che ci piacerebbe raccontare insieme a te.<br>
                        Vogliamo diventare la food company definitiva: l'app alla quale ti affidi</p>
                        <!-- HASHTAG RAPPRESENTATIVO CUI NON VIGE NESSUNA REGOLA SEMANTICA -->
                        <div id="workwithus">
                            <p><i><span class="colored">#</span>workwith<span class="colored">us</span></i></p>
                        </div>
                    </div>
                    <div id="text-dx">
                        <h1>Canditati ora,<br> per le posizioni di Rider, Development,<br> Marketing</h1>
                        <a href="#staffpos">
                            <div id="button">
                                <span>Cerca posizioni aperte</span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Ottagono in position absolute -->
                <div id="absolute-octagon"></div>
            </div>
        </div>
    </main>
    
@endsection