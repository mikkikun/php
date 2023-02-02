@extends('layouts.app')

@section('content')
<form action="{{ action('App\Http\Controllers\Admin\PostController@update') }}" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
          </ul>
    @endif

    <label>タイトル</label>
    <input type="text" class="" name="title" value="{{ $post_form->title }}">

    <label>本文</label>
    <textarea class="" name="body" rows="20">{{ $post_form->body }}</textarea>

    <input class="" type="checkbox" id="inlinecheckbox01" name="cardgame" value="遊戯王">
    <label class="" for="inlinecheckbox01">遊戯王</label>
    <input class="" type="checkbox" id="inlinecheckbox02"  name="cardgame" value="遊戯王ラッシュデュエル">
    <label class="" for="inlinecheckbox02">遊戯王ラッシュデュエル</label>
    <input class="" type="checkbox" id="inlinecheckbox03"  name="cardgame" value="デュエル・マスターズ" >
    <label class="" for="inlinecheckbox03">デュエル・マスターズ</label>
    <input class="" type="checkbox" id="inlinecheckbox04" name="cardgame" value="ポケモンカード">
    <label class="" for="inlinecheckbox04">ポケモンカード</label>
    <input class="" type="checkbox" id="inlinecheckbox05"  name="cardgame" value="ヴァイスシュヴァルツ">
    <label class="" for="inlinecheckbox05">ヴァイスシュヴァルツ</label>
    <input class="" type="checkbox" id="inlinecheckbox06"  name="cardgame" value="シャドウバース" >
    <label class="" for="inlinecheckbox06">シャドウバース</label>
    <input class="" type="checkbox" id="inlinecheckbox07" name="cardgame" value="ヴァンガード">
    <label class="" for="inlinecheckbox07">ヴァンガード</label>
    <input class="" type="checkbox" id="inlinecheckbox08"  name="cardgame" value="ONE PIECE">
    <label class="" for="inlinecheckbox08">ONE PIECE</label>
    <input class="" type="checkbox" id="inlinecheckbox09"  name="cardgame" value="マジック・ザ・ギャザリング" >
    <label class="" for="inlinecheckbox09">マジック・ザ・ギャザリング</label>
    <input class="" type="checkbox" id="inlinecheckbox10" name="cardgame" value="ウィクロス">
    <label class="" for="inlinecheckbox10">ウィクロス</label>
    <input class="" type="checkbox" id="inlinecheckbox10" name="cardgame" value="その他">
    <label class="" for="inlinecheckbox10">その他</label>

    <label>画像</label>
    <input type="file" class="" name="image">
    設定中: {{ $post_form->image_path }}
    <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
    </label>

    <input type="hidden" name="id" value="{{ $post_form->id }}">
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="更新">

    </form>


@endsection