<head>
    @include('site.head')
</head>
<main id="main">
    <div class="container">
        <h2>Create Admin</h2>
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Create Admin</button>
        </form>
    </div>
</main>

<head>
    @include('site.footer')
</head>