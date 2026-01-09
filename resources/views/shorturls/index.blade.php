@extends('layouts.admin')

@section('content')
<div class="container mt-5">

    @if(auth()->user()->isAdmin() || auth()->user()->isMember())
        <div class="card mb-4 shadow">
            <div class="card-header bg-success text-white">
                Create Short URL
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('shorturls.store') }}">
                    @csrf
                    <input name="original_url" class="form-control mb-2"
                           placeholder="https://example.com">
                    <button class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            Short URLs
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Short</th>
                        <th>Original</th>
                        <th>User</th>
                        <th>Company</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($urls as $url)
                        <tr>
                            <td>
                                <a target="_blank"
                                   href="{{ route('shorturls.redirect', $url->code) }}">
                                    {{ url('/s/'.$url->code) }}
                                </a>
                            </td>
                            <td>{{ $url->original_url }}</td>
                            <td>{{ $url->user->name }}</td>
                            <td>{{ $url->company->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
