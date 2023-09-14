<head>
    @include('site.head')
</head>
<main id="main">
    <div class="container">
        <h2>Admin List</h2>
        <a href="{{ route('admin.create') }}" class="btn btn-primary">Add Admin</a>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered" class="text-center" style="text-align: center; color: #5777ba;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id_admin }}</td>
                    <td>{{ $admin->username }}</td>
                    <td>{{ $admin->password }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $admin->id_admin) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.destroy', $admin->id_admin) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

<head>
    @include('site.footer')
</head>