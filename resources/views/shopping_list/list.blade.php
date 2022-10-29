@extends('layout')

@section('title')(一覧画面)@endsection

@section('main')
        <h1>「買うもの」の登録</h1>
        @if (session('front.list_register_success') == true)
            「買うもの」を登録しました！！<br>
        @endif
        @if ($errors->any())
            <div>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            </div>
        @endif
        <form action="/shopping_list/register" method="post">
            @csrf
            「買うもの」名：<input name="name"><br>
            <button>「買うもの」を登録する</button>
        </form>
        <h1>「買うもの」一覧</h1>
        <a href="/completed_shopping_list/list">購入済み「買うもの」一覧</a>
        <table border="1">
            <tr>
            <th>登録日
            <th>「買うもの」名
@foreach ($list as $item)
        <tr>
            <td>{{ $item->created_at->format('Y/m/d') }}
            <td>{{ $item->name }}
@endforeach
        </table>
        <!-- ページネーション -->
        現在{{ $list->currentPage() }}ページ目<br>
        @if ($list->onFirstPage() === false)
        <a href="/shopping_list/list">最初のページ</a>
        @else
        最初のページ
        @endif
        /
        @if ($list->previousPageUrl() !== null)
            <a href="{{ $list->previousPageUrl() }}">前に戻る</a>
        @else
            前に戻る
        @endif
        /
        @if ($list->nextPageUrl() !== null)
            <a href="{{ $list->nextPageUrl() }}">次に進む</a>
        @else
            次に進む
        @endif
        <br>
        <hr>
@endsection