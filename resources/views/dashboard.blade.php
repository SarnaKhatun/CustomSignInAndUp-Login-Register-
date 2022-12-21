@extends('layout.app')
@section('title')
    Dashboard
@endsection

@section('body')
    <a href="{{route('logoutt')}}" class="text-sm text-gray-700 dark:text-gray-500 underline" onclick="event.preventDefault();document.getElementById('logoutForm').submit();">Logout</a>
    <form action="{{route('logoutt')}}" method="post" id="logoutForm">
        @csrf
    </form>
    <h1 class="py-5">{{Auth::user()->name}}</h1>
@endsection
