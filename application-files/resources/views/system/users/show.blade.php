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
        <tr>
            <td>
                <hr>
                <h6>Detail:</h6>
                <hr>
            <td>
        </tr>

        <tr>
            <td><label for="firstName">Bio:</label></td>
            <td><label for="firstName">{{ $user?->detail?->bio }}</label></td>
        </tr>
        <tr>
            <td><label for="firstName">Status:</label></td>
            <td><label for="firstName">
                    @if ($user?->detail?->status == 1)
                        Active
                    @elseif($user?->detail?->status == 0)
                        Inactive
                    @endif
                </label></td>
        </tr>
    </table>
@endsection
