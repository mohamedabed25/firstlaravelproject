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
                    <a href="#" 
                    class="btn btn-edit" 
                    data-id="{{ $user->id }}"
                    data-username="{{ $user->username }}"
                    data-email="{{ $user->email }}"
                    data-role="{{ $user->role }}"
                    data-photo="{{ !empty($user->photo) ? asset('storage/' . $user->photo) : asset('dist/assets/img/avatar5.png') }}"
                 >
                     Edit
                 </a> 
                 
                 <!-- Edit User Modal -->
<div id="editUserModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit User</h2>
        <form id="editUserForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" id="edit_user_id">
            <div>
                <label>Email:</label>
                <input type="email" name="email" id="edit_email">
            </div>
            <div>
                <label>Username:</label>
                <input type="text" name="username" id="edit_username">
            </div>
            <div>
                <label>Password:</label>
                <input type="password" name="password" id="edit_password" placeholder="Leave blank to keep current password">
            </div>
            <div>
                <label>Role:</label>
                <select name="role" id="edit_role">
                    <option value="" disabled selected hidden>-- Select Role --</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div>
                <label>Photo:</label>
                <input type="file" name="photo" id="edit_photo" accept="image/*">
                <div style="margin-top: 10px;">
                    <img id="edit_photo_preview" src="#" alt="Image Preview" style="display: none; max-width: 120px; border-radius: 6px;">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
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
