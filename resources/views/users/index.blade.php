@extends("admin.layout.master")

@section('title', 'Home')

@section('content')


{{-- start container (this for adminlte design) --}}
<div class="table-container"> 
    
    <div class="table-header"> 

        <button class="btn btn-primary" onclick="openModal()">+ Create User</button>

        <!-- Modal for Create User --> 
        <div id="createUserModal" class="modal" style="display:none;"> {{-- this for the back ground of the popup --}}   {{-- id for modal to use it into ajax for open and close , class for acting as popup modal --}}
            <div class="modal-content" >
                <span class="close" onclick="closeModal()">&times;</span> {{-- this for the close button --}}
                <h2>Create User</h2>   {{-- this for the title of the popup --}}
                <form id="createUserForm" enctype="multipart/form-data"> {{-- this for the form of the popup  , enctype="multipart/form-data" to deal with photos  --}}
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
                        <label>Password:</label>
                        <input type="password" name="password" id="password">
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
    // Pass Laravel-specific variables to JavaScript file for ajax handling  CreateUser.js
    window.usersSearchUrl = "{{ route('users.index') }}";
    window.usersStoreUrl = '{{ route('users.store') }}';
</script>
<script src="{{ asset('dist/js/users/CreateUser.js') }}"></script>

@endsection
