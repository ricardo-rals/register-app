@extends('layouts.app')

@section('title', 'Listagem dos usuários')

@section('content')
<h1>Listagem dos usuários</h1>
<a href="{{ route('users.create') }}">NOVO USUARIO</a>

<form action="{{ route('users.index') }}" method="get" class="py-5">
    <input type="text" name="search" placeholder="Pesquisar" >
    <button>Pesquisar</button>
</form>

<table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
          <th>
            Nome
          </th>
          <th>
            E-mail
          </th>
          <th>
            Editar
          </th>
        </tr>
      </thead>
      <tbody>
    @foreach ($users as $user)
        <tr>
            <td>
                {{ $user->name }}
            </td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}">Editar</a>
            </td>
            <td>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="py-12">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection

