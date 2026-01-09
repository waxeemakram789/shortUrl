@extends('layouts.admin')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Invite User</h4>
    </div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('invite.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter full name">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email">
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-select" name="role">
                    @if(auth()->user()->isSuperAdmin())
                        <option value="Admin">Admin</option>
                    @endif
                    @if(auth()->user()->isAdmin())
                        <option value="Admin">Admin</option>
                        <option value="Member">Member</option>
                    @endif
                </select>
            </div>

            @if(auth()->user()->isSuperAdmin())
                <div class="mb-3">
                    <label class="form-label">Company Name</label>
                    <input type="text" class="form-control" name="company_name" placeholder="Enter new company name">
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter password">
            </div>

            <button type="submit" class="btn btn-success">Invite</button>
        </form>
    </div>
</div>

@endsection
