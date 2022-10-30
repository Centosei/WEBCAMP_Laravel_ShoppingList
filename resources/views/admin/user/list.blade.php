@extends('layout')

@section('title')(一覧画面)@endsection

@section('main')
        <menu>
            <a href="/admin/top">管理画面Top</a><br/>
            <a href="/admin/user/list">ユーザ一覧</a><br/>
            <a href="/admin/logout">ログアウト</a><br/>
        </menu>
        <h1>ユーザ一覧</h1>
        <table border="1">
            <tr>
            <th>ユーザID</th>
            <th>ユーザ名</th>
            <th>購入した「買うもの」の数</th>
            </tr>
@foreach ($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->item_num }}</td>
            </tr>
@endforeach
        </table>
@endsection