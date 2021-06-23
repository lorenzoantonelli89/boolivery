@extends('layouts.main-layout')
@section('title')
    FAQ
@endsection
@section('content')
    <main>
        <div id="faq-container">
            <div class="div-margin">
                <div id="back-h1">
                    <h1>FAQ</h1>
                </div>
                <div id="faq">
                    <ul id="quest">
                        <li v-for="quest in questions">
                            <p>@{{quest.quest}}</p>
                            <p>@{{quest.answer}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <script>
        new Vue({
            el: '#faq-container',
            data: {
                questions: [
                    {
                        quest: 'Lorem ispum?',
                        answer: 'ed sit adam'
                    },
                    {
                        quest: 'Dolor sit amet?',
                        answer: 'Dolor sit atet'
                    },
                    {
                        quest: 'Dolor sit amet?',
                        answer: 'Dolor sit atet'
                    },
                    {
                        quest: 'Dolor sit amet?',
                        answer: 'Dolor sit atet'
                    },
                    {
                        quest: 'Dolor sit amet?',
                        answer: 'Dolor sit atet'
                    }
                ]
            }
        });
    </script>
@endsection