@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <h2 class="text-2xl font-bold mt-4">Pending Registrations</h2>

        @foreach ($pendingUsers as $user)
            <div>
                <p>Name: {{ $user->name }}</p>
                <p>Email: {{ $user->email }}</p>
                <div class="flex">
                    <form method="post" action="{{ route('admin.approve-user', $user->id) }}" onsubmit="return confirm('Are you sure you want to approve this user?');">
                        @csrf
                        <button type="submit" class="border bg-adminPrimary rounded-2xl w-[100px] text-white py-2">Approve</button>
                    </form>
                    <form method="post" action="{{ route('admin.decline-user', $user->id) }}" onsubmit="return confirm('Are you sure you want to decline this user?');">
                        @csrf
                        <button type="submit" class="border bg-adminPrimary rounded-2xl w-[100px] text-white py-2">Decline</button>
                    </form>
                </div>
            </div>
            <hr>
            <br>
        @endforeach
    </div>
@endsection
