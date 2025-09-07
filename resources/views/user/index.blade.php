@extends('layouts.default')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Users</h5>
                    <a href="{{ route('users.create') }}" class="btn btn-light btn-sm">
                        Add User
                    </a>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Company</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
									<td>{{ Config::get('user_type.'.$user->user_role_id) }}</td>
									<td>{{ $user->company->name }}</td>
                                    <td class="text-end">
                                         
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                
            </div>

        </div>
    </div>
</div>
@endsection
