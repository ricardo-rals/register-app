@extends('layouts.app')

@section('title', 'Listagem dos usuários')

@section('content')
<h1>Listagem dos usuários</h1>
<a href="{{ route('users.create') }}">NOVO USUARIO</a>

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
        </tr>
    @endforeach
    </tbody>
</table>

@endsection

