@extends('layouts.app')

@section('content')

<h2>ニュース新規作成</h2>
<form action="{{ action('App\Http\Controllers\Admin\PostController@create') }}" method="post" >
    @if (count($errors) > 0)
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    @endif
    <label>タイトル</label>
    <input type="text" class="" name="title" value="{{ old('title') }}">

    <label>本文</label>
    <textarea class="" name="body" rows="20">{{ old('body') }}</textarea>
    

    <input class="" type="checkbox" id="inlinecheckbox01" name="cardgame" value="1">
    <label class="" for="inlinecheckbox01">遊戯王</label>
    <input class="" type="checkbox" id="inlinecheckbox02"  name="cardgame" value="2">
    <label class="" for="inlinecheckbox02">遊戯王ラッシュデュエル</label>
    <input class="" type="checkbox" id="inlinecheckbox03"  name="cardgame" value="3" >
    <label class="" for="inlinecheckbox03">デュエル・マスターズ</label>
    <input class="" type="checkbox" id="inlinecheckbox04" name="cardgame" value="4">
    <label class="" for="inlinecheckbox04">ポケモンカード</label>
    <input class="" type="checkbox" id="inlinecheckbox05"  name="cardgame" value="5">
    <label class="" for="inlinecheckbox05">ヴァイスシュヴァルツ</label>
    <input class="" type="checkbox" id="inlinecheckbox06"  name="cardgame" value="6" >
    <label class="" for="inlinecheckbox06">シャドウバース</label>
    <input class="" type="checkbox" id="inlinecheckbox07" name="cardgame" value="7">
    <label class="" for="inlinecheckbox07">ヴァンガード</label>
    <input class="" type="checkbox" id="inlinecheckbox08"  name="cardgame" value="8">
    <label class="" for="inlinecheckbox08">ONE PIECE</label>
    <input class="" type="checkbox" id="inlinecheckbox09"  name="cardgame" value="9" >
    <label class="" for="inlinecheckbox09">マジック：ザ・ギャザリング</label>
    <input class="" type="checkbox" id="inlinecheckbox10" name="cardgame" value="10">
    <label class="" for="inlinecheckbox10">ウィクロス</label>

    <label>画像</label>
    <input type="file" class="" name="image">
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="更新">
</form>

@endsection