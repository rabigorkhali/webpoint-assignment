@extends('system.layouts.master')

@section('content')
    <table>
        <tr>
            <td><label for="firstName">First Name:</label></td>
            <td><label for="firstName">{{ $user->firstname }}</label></td>
        </tr>
        <tr>
            <td><label for="firstName">Last Name:</label></td>
            <td><label for="firstName">{{ $user->lastname }}</label></td>
        </tr>
        <tr>
            <td><label for="firstName">Username:</label></td>
            <td><label for="firstName">{{ $user->username }}</label></td>
        </tr>
        <tr>
            <td><label for="firstName">Email:</label></td>
            <td><label for="firstName">{{ $user->email }}</label></td>
        </tr>
        <tr>
            <td><label for="firstName">Email verified at:</label></td>
            <td><label for="firstName">{{ $user?->email_verified_at?->format('Y-m-d') ?? 'N/A' }}</label></td>
        </tr>
    </table>
@endsection
