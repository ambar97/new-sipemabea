<head>
    @include('site.head')
</head>
<main id="main">
    <div class="container">
        <h2>Edit Admin</h2>
        <form action="{{ route('admin.update', $admin->id_admin) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" value="{{ $admin->username }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" value="{{ $admin->password }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Admin</button>
        </form>
    </div>
</main>

<head>
    @include('site.footer')
</head>