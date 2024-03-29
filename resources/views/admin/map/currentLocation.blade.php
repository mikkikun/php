@extends('layouts.app')

@section('content')
<title>マップ</title>
    <div id="map" style="height:1000px">
    </div>
    <script>
        // currentLocation.jsで使用する定数latに、controllerで定義した$latをいれて、currentLocation.jsに渡す
        const lat = {{ $lat }};
        // currentLocation.jsで使用する定数lngに、controllerで定義した$lngをいれて、currentLocation.jsに渡す
        const lng = {{ $lng }};
    </script>
    {{--    上記の処理をしてから、googleMapを読み込まないとエラーが出てくる--}}

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/setLocation.js') }}"></script>
    <script src="{{ asset('/js/currentLocation.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyB97jyoa697wN5B5sLKJF_zEyTlYNzCtPk&callback=initMap" async defer>
    </script>

@endsection