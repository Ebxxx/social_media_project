@extends('layouts.app')

@section('content')
    <h1>Profile</h1>
    
    <div>
    <p>Profile Picture Path: {{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'No profile picture' }}</p>
    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('default-profile-picture.png') }}" alt="Profile Picture" class="rounded-full w-32 h-32">
    </div>



    <div>
        <strong>Name:</strong> {{ $user->name }}
    </div>
    
    <div>
        <strong>Email:</strong> {{ $user->email }}
    </div>

    <a href="{{ route('profile.edit') }}">Edit Profile</a>
@endsection
