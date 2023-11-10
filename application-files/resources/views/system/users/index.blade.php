@extends('system.layouts.master')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
                @if ($users->count())
                    @foreach ($users as $keyUserDatum => $datumUser)
                    <tr>

                        <td>{{$i=1+$keyUserDatum}}</td>
                        <td>{{ $datumUser->firstname??'' }}</td>
                        <td>{{ $datumUser->lastname??'' }}</td>
                        <td>{{ $datumUser->username??'' }}</td>
                        <td>{{ $datumUser->email??'' }}</td>
                        <td>
                            <a class="btn btn-sm btn-dark" href="{{ URL::to($indexUrl).'/'.$datumUser->id }}">View</a>
                            <a class="btn btn-sm btn-primary" href="{{ URL::to($indexUrl).'/'.$datumUser->id.'/edit' }}">Edit</a>
                            <button class="btn btn-danger btn-sm delete-button" data-toggle="modal" data-target="#confirmationModal" data-username="{{$datumUser->username}}" data-actionurl="{{ URL::to($indexUrl).'/'.$datumUser->id }}">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="7">Data not found.</td>
                </tr>
                @endif
        </tbody>
    </table>
    @include('system.layouts.delete-modal')

@endsection
