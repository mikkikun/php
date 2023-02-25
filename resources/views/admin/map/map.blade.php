@extends('layouts.app')

@section('content')
<title>マップ</title>
<div id="map" style="height:500px">
</div>
<script src="{{ asset('/js/map.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyB97jyoa697wN5B5sLKJF_zEyTlYNzCtPk&callback=initMap" async defer>
</script>








@endsection