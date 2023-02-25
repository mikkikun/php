@extends('layouts.app')

@section('content')
<title>マップ</title>
<div id="map" style="height:500px">
</div>
<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=[APIキーをここに入力]&callback=initMap" async defer>
</script>








@endsection