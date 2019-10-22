@extends('layout')

<div class="container">
    <h1 style="text-align: center">форма редактирования</h1>
    <form action=" {{ route('users.update', $user->id) }} " method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Логин</label>
            <input name="login" value="{{$user->login}}" type="text" class="form-control" placeholder="Введите логин">
        </div>
        <div class="form-group">
            <label>Имя</label>
            <input name="first_name" value="{{$user->first_name}}" type="text" class="form-control" placeholder="Введите имя">
        </div>
        <div class="form-group">
            <label>Фамилия</label>
            <input name="last_name" value="{{$user->last_name}}" type="text" class="form-control" placeholder="Введите фамилию">
        </div>
        <div class="form-group">
            <label>Отчество</label>
            <input name="middle_name" value="{{$user->middle_name}}" type="text" class="form-control" placeholder="Введите отчество">
        </div>
        <div class="form-group">
            <label>Пароль</label>
            <input name="password" value="" type="password" class="form-control" placeholder="Введите пароль">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input name="email" value="{{$user->email}}" type="email" class="form-control" placeholder="Введите email">
        </div>
        <div class="form-group">
            <label>Дата окончания подписки</label>
            <div class='input-group date' id='datetimepicker2'>
                <input name="subscribe_end" value="{{ $user->getSubscribeEnd($user->id) }}" type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>


