@extends('layouts.app')

@section('content')
<div class="container">
   <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>

        </tr>
        </thead>
        @foreach ($users as $user)
        <tbody>
            <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td></td>
        </tbody>
        @endforeach

    </table>
</div>
@endsection
