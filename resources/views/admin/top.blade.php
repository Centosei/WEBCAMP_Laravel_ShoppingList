@extends('layout')

@section('title')(一覧画面)@endsection

@section('main')
        <menu>
            <a href="/admin/top">管理画面Top</a><br/>
            <a href="/admin/user/list">ユーザ一覧</a><br/>
            <a href="/admin/logout">ログアウト</a><br/>
        </menu>
        @if ($errors->any())
            <div>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            </div>
        @endif
        <h1>管理画面</h1>
@endsection