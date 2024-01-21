@extends('layouts.app')

@section('content')
<div class="container">

    @if (null !== (Session::get('msg')))
    <div class="alert alert-success  text-lg-center">
        <h1>{{Session::get('msg')}}</h1>
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        @foreach ($users as $user)
        <tbody>
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->surname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}">
                        <button class="btn btn-primary btn-sm">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                    </a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" name="user_id" value="{{ $user->id }}" class="btn btn-danger btn-sm delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>

                </td>
        </tbody>
        @endforeach

    </table>
    {{ $users->links() }}
</div>
@endsection