@extends('layouts.app')

@section('content')
<table>
            @foreach($users as $data)
            
            <tr>
            <td class = "">
                    @if($data->profile_image !== null)
                        <img src="{{ asset('storage/profile_image').'/'.$data->profile_image }}">
                    @endif
                </td>
                <td class = "">{{ $data->name }}</td>
            </tr>
            <tr class = "">
                <td class = "">{{ $data->profile}}</td>
            </tr>
            @endforeach
            </table>









@endsection