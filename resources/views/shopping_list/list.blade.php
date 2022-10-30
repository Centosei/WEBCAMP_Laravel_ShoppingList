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
        @if (session('front.list_delete_success') == true)
            「買うもの」を削除しました！！<br>
        @endif
        <a href="/completed_shopping_list/list">購入済み「買うもの」一覧</a>
        <table border="1">
            <tr>
            <th>登録日</th>
            <th>「買うもの」名</th>
            </tr>
@foreach ($list as $item)
            <tr>
                <td>{{ $item->created_at->format('Y/m/d') }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <form action="#" method="post">
                        @csrf
                        <button onclick='return confirm("このタスクを「完了」にします。よろしいですか？");'>完了</button>
                    </form>
                </td>
                <td>　</td>
                <td>
                    <form action="{{ route('delete', ['shopping_list_id' => $item->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button>削除</button>
                    </form>
                </td>
            </tr>
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
        <p><a href="/logout">ログアウト</a></p>
@endsection