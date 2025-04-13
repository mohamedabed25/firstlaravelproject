@extends("admin.layout.master")

@section('page-title', 'users')

@section('content')

{{-- start container (this for adminlte design) --}}
<div class="table-container">

    <div class="table-header">

        <button class="btn btn-primary" onclick="openModal()">+ Create User</button>

        <!-- Modal for Create User -->
        <div id="createUserModal" class="modal" style="display:none;"> {{-- this for the back ground of the popup --}}
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span> {{-- this for the close button --}}
                <h2>Create User</h2> {{-- this for the title of the popup --}}
                <form id="createUserForm" enctype="multipart/form-data"> {{-- this for the form of the popup --}}
                    @csrf
                    <div>
                        <label>Email:</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div>
                        <label>Username:</label>
                        <input type="text" name="username" id="username">
                    </div>

                    <div>
                        <label>phone:</label>
                        <input type="text" name="phone" id="phone">
                    </div>

                    <div>
                        <label>Password:</label>
                        <input type="password" name="password" id="password">
                    </div>

                    <div>
                        <label>Confirm Password:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation">
                    </div>

                    <div>
                        <label>Role:</label>
                        <select name="role" id="role">
                            <option value="" disabled selected hidden>-- Select Role --</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div>
                        <label>Photo:</label>
                        <input type="file" name="photo" id="photo" accept="image/*">
                        <div id="photo-preview-container" style="margin-top: 10px;">
                            <img id="photo-preview" src="#" alt="Image Preview" style="display: none; max-width: 120px; border-radius: 6px;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="search-container">
            <input type="text" id="table-search" class="search-input" placeholder="Search by ID, Name, Email, or Role..." aria-label="Search table">
        </div>
    </div>

    <div id="users-data">
        @include('users.table')
    </div>

    <script>
        // Pass Laravel-specific variables to JavaScript file for ajax handling CreateUser.js
        window.usersSearchUrl = "{{ route('users.index') }}";
        window.usersStoreUrl = '{{ route('users.store') }}';
    </script>
    <script src="{{ asset('dist/js/users/CreateUser.js') }}"></script>
    <script src="{{ asset('dist/js/users/UpdateUser.js') }}"></script>

@endsection
