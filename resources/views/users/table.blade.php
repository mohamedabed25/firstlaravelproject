<table class="table table-striped" id="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Photo</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr class="{{ $loop->even ? 'row-even' : 'row-odd' }}">
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <img src="{{ !empty($user->photo) ? asset('storage/' . $user->photo) : asset('dist/assets/img/avatar5.png') }}" width="50">

                </td>
                <td><span class="role-badge role-{{ strtolower($user->role) }}">{{ $user->role }}</span></td>
                <td>
                    <a href="#" class="btn btn-edit">Edit</a>
                    <form action="#" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination-wrapper">
    {{ $users->links() }}
</div>
