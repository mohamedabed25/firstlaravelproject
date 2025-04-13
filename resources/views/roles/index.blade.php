@extends("admin.layout.master")

@section('page-title', 'roles')

@section('content')
<div class="app-content">
    <!--begin::Container-->
    <div id="users-data">
        <table class="table table-striped" id="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>created at </th>
                    <th>updated at </th>


                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr class="{{ $loop->even ? 'row-even' : 'row-odd' }}">
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td>{{ $role->updated_at}}</td>
                        <td>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <a href="#"
                                    class="btn btn-edit"
                                    data-id="{{ $role->id }}"
                                    data-username="{{ $role->name }}"
                                    data-created_at="{{ $role->created_at }}"
                                    data-updated_at="{{ $role->updated_at }}"
                                    onclick="openEditModal(this)">
                                    Edit
                                </a>
                                <form action="/roles/{{ $role->id }}" method="POST" class="delete-form inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            </div>

    <!-- Edit Role Modal -->
    <div id="editRoleModal{{ $role->id }}" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal({{ $role->id }})">&times;</span>
            <h2>Edit Role</h2>
            <form id="editRoleForm{{ $role->id }}" action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="role_id" id="edit_role_id_{{ $role->id }}">
                <div>
                    <label>Role Name:</label>
                    <input type="text" name="role_name" id="edit_role_name_{{ $role->id }}">
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{--  لارفل هنا بيرجع الفورم دي عند الضغط علي اي لينك من اللينكات

        <nav>
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
            ...
          </ul>
        </nav>


        --}}
        <div class="pagination-wrapper">
            {{ $roles->links() }}
        </div>

    </div>
@endsection
