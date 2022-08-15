@extends('layouts.app')

@section('title', 'Criar novo usuário')

@section('content')
    <h1>Novo Usuário</h1>

    @include('includes.validations-form')

    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        @include('users._partials.form')
    </form>
@endsection