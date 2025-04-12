

@extends("admin.layout.master") 

@section('title', 'Home')


@section('content')

<div class="table-container">
    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" id="table-search" class="search-input" placeholder="Search by ID, Name, Email, or Role..." aria-label="Search table">
    </div>
    
    <table id="data-table">
        <thead>
            <tr>
                <th  data-sort="id">ID </span></th>
                <th  data-sort="name">Name </span></th>
                <th  data-sort="email">Email </span></th>
                <th  data-sort="role">Role </span></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ([['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'Admin'], ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'User'], ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'role' => 'Editor']] as $user)
                <tr class="{{ $loop->even ? 'row-even' : 'row-odd' }}">
                    <td data-label="ID">{{ $user['id'] }}</td>
                    <td data-label="Name">{{ $user['name'] }}</td>
                    <td data-label="Email">{{ $user['email'] }}</td>
                    <td data-label="Role">
                        <span class="role-badge role-{{ strtolower($user['role']) }}">{{ $user['role'] }}</span>
                    </td>
                    <td data-label="Actions" class="action-cell">
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
</div>
@endsection


