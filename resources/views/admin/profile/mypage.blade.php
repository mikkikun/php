@extends('layouts.app')

@section('content')
<form action="{{ action('App\Http\Controllers\Admin\ProfileController@index') }}" method="get">
            <table>
            <tr>
            <td class = "">
                    @if($users->profile_image !== null)
                        <img src="{{ asset('storage/profile_image').'/'.$users->profile_image }}">
                    @endif
                </td>
                <td class = "">{{ $users->name }}</td>
            </tr>
            <tr class = "">
                <td class = "">{{ $users->profile}}</td>
                <td class = "">
            </tr>
            </table>










</form>
@endsection