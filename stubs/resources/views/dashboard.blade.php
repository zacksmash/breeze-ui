@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <div>You are logged in!</div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit">
            {{ __('Logout') }}
        </button>
    </form>
@endsection
