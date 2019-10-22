@extends('layout')

<div class="container">
    <h1 style="text-align: center">Пользователи</h1>
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Логин</th>
            <th scope="col">ФИО</th>
            <th scope="col">email</th>
            <th scope="col">Дата окончания</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->subscribe_end }}</td>
                        <td><a href="{{ route('users.edit', $user->id) }}" type="button" class="btn btn-primary">Редактировать</a></td>
                    </tr>
        @endforeach
        </tbody>
    </table>
</div>
