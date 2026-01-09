@extends('layouts.admin')

@section('content')
<div class="container mt-5">

    <div class="row">
        <!-- Invite Form -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    Invite User
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('invite.store') }}">
                        @csrf

                        <div class="mb-2">
                            <label>Name</label>
                            <input name="name" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Role</label>
                            <select name="role_id" class="form-select">
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
                            <div class="mb-2">
                                <label>Company Name</label>
                                <input name="company_name" class="form-control">
                            </div>
                        @endif

                        <button class="btn btn-success w-100">
                            Invite
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <!-- User Listing -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    Users
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-secondary">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Company</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $user->role->name }}
                                        </span>
                                    </td>
                                    <td>{{ $user->company?->name ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
