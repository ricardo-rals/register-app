@extends('layouts.app')
@section('title', 'Detalhe do usuário')
@section('content')
    <h1 class="text-2xl font-semibold leading-tigh py-2">Detalhes do usuário {{ $user->name }}</h1>

    <ul>
        <li>Nome: {{ $user->name }}</li>
        <li>E-mail: {{ $user->email }}</li>
        <li>Telefone: {{ $user->phone_number }}</li>
        <li>Data de Nascimento: {{ $user->birth_date->format('d-m-Y') }}</li>
        <li>Idade: {{ $user->age }}</li>
        <img src="{{ url("storage/{$user->image}") }}" alt="{{ $user->name }}" class="object-cover h-48 w-96">
    </ul>

    <table class="leading-normal">
        <tbody>
            @can('admin')
                <td class="px-5 py-5">
                    <a href="{{ route('users.edit', $user->id) }}" class="bg-green-200 rounded-full py-2 px-6">Editar</a>
                </td>
                <td class="px-5 py-5">
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="py-12">
                        @method('DELETE')
                        @csrf
                        <button type="submit"
                            class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
                    </form>
                </td>
            @endcan
            <td class="px-5 py-5">
                <a href="{{ route('users.index') }}" class="bg-orange-200 rounded-full py-2 px-6">Voltar</a>
            </td>
            </tr>
        </tbody>
    </table>


@endsection
