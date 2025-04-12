// this line is a function to open modal using the id defined in blade 
function openModal() {
    $('#createUserModal').fadeIn();
}

// this line is a function to close modal using the id defined in blade 
function closeModal() {
    // اقفل المودال 
    $('#createUserModal').fadeOut(300);
    // امسح الداتا اللي فيه بعد تحويله من جي كويري اوبجكت  ل هتمل فورم 
    $('#createUserForm')[0].reset();  
    // اخف الصورة اللي فيها الملف اللي حطها المستخدم لو اتحطت 
    $('#photo-preview').hide();
    // اخف الرسايل اللي فيها خطا قبل ما تفتح الفورم تاني 
    $('.error-message').remove();
    $('#modal-title').text('Create User');
    $('#form-submit-btn').text('Create');
    $('#user_id').val('');

}



// EDIT modal
function openEditModal() {
    $('#editUserModal').fadeIn();
}
function closeEditModal() {
    $('#editUserModal').fadeOut(300);
    $('#editUserForm')[0].reset();
    $('#edit_photo_preview').hide();
    $('.error-message').remove();
}

    $(document).on('click', '#createUserModal', function(event) {
        if ($(event.target).is('#createUserModal') ) {
            closeModal();
            
        }
    });

    $(document).on('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    }); 


// استنى لحد ما الصفحة كلها تخلص تحميل (DOM جاهز)، وبعد كده نفذ اللي جوا.
$(document).ready(function () {               
    
    //  ده بيراقب النموذج (form) اللي الـ id بتاعه هو createUserForm.
    //  لما المستخدم يضغط على زر "Create" أو يعمل Submit، الكود اللي جوا هيشتغل.
    $('#createUserForm').on('submit', function (e) {
        // بيمنع المتصفح من السلوك الافتراضي للنموذج (اللي هو يبعته ويريفرش الصفحة).
        e.preventDefault();
        // ده بينضف أي رسائل خطأ ظهرت قبل كده في الصفحة 
        $('.error-message').remove();
        // بننشئ كائن جديد من نوع FormData، وده بياخد البيانات كلها من النموذج
        var formData = new FormData(this);

        $.ajax({
            url: window.usersStoreUrl, 
            type: 'POST',
            data: formData,
            processData: false, // لا يقوم بتحويل البيانات إلى شكل سترنج وهو غير مناسب لارسال الصور 
            contentType: false,  // خلّي المتصفح هو اللي يحدّد نوع البيانات عشان نعرف نهندل الفايلات 

            // "لما السيرفر نفسه هو اللي يرد بنجاح، شغّل الكود ده، واديني البيانات اللي رجعت في المتغير response"
            success: function (response) { 
                // لما الكونتروللر بتاعك يرجع ترو في الريسبونس اعمل اللي جوا الفنكشن 
                if (response.success) {
                    //  اقفل المودال 
                    closeModal();
                    // اعرض بوب اب النجاح 
                    Swal.fire({
                        icon: 'success',
                        title: 'User Created Successfully!',
                        text: 'The new user has been added to the system.',
                        confirmButtonText: 'OK'
                    });
                    // بنحول الفورم من جي كويري اوبجكت ل فورم هتمل اقدر اتعامل معاها وامسح الداتا اللي فيها 
                    $('#createUserForm')[0].reset(); 

                    // خزن مسار الصوره في المتغير فوتو لو الصوره اتبعتت ولو متبعتتش استخدم الديفولت 
                    var photo = response.user.photo? `/storage/${response.user.photo}`: `dist/assets/img/avatar5.png`;
                    // خزن الرول في متغير لو الرول موجود في الريسبونس استخدمه ولو  مش موجود استخدم الديفولت اللي هو يوزر 
                    var role = response.user.role ?? 'User'; 

                    var newUserRow = `
                        <tr>
                            <td>${response.user.id}</td>
                            <td>${response.user.username}</td>
                            <td>${response.user.email}</td>
                            <td><img src="${photo}" alt="User Photo" width="50"></td>
                            <td> <span class="role-badge role-${role}">${role}</span> </td>
                            <td>
                                <a href="#" class="btn btn-edit">Edit</a>
                                <form action="/users/${response.user.id}" method="POST" class="inline" id="delete-user-form-${response.user.id}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    `;
                    $('#data-table tbody').prepend(newUserRow);
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'the response back with false ',
                        confirmButtonText: 'OK'
                    });
                }
            },
            // لو السيرفر رجّع رد فشل (status code 4xx أو 5xx مثلا) ,xhr هو كائن الـ XMLHttpRequest اللي فيه كل تفاصيل الخطأ
            error: function (xhr) {
                // 422 ده الكود اللي Laravel بيرجعه لما الـ validation يفشل 
                if (xhr.status === 422) {
                    //  ده كائن فيه كل الحقول اللي فيها أخطاء.
                    var errors = xhr.responseJSON.errors;
                    // عشان تحذف الرسايل اللي ظهرت قبل كده
                    $('.error-message').remove();
                    // لووب عشان تعرض رسايل الخطا تحت كل خانه 
                    $.each(errors, function (field, messages) {
                        var errorMessage = `<div class="error-message">${messages[0]}</div>`;
                        $('#' + field).after(errorMessage);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong. Please try again!',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });


    // For image preview
    $('#photo').on('change', function (event) {
        const file = event.target.files[0];
        const preview = $('#photo-preview');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.attr('src', e.target.result);
                preview.show();
            };
            reader.readAsDataURL(file);
        } else {
            preview.hide();
            preview.attr('src', '#');
        }
    });
});




// for search and pagnation and serch work into all links 

$(document).ready(function () {
    $('#table-search').on('keyup', function () {
        let query = $(this).val();
        fetchUsers(`${window.usersSearchUrl}?search=${query}`);
    });

    function fetchUsers(url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#users-data').html(data);
            },
            error: function (xhr, status, error) {
                console.error("XHR:", xhr);
                console.error("Status:", status);
                console.error("Error:", error);
            }
        });
    }
    
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let query = $('#table-search').val();
        let pageUrl = $(this).attr('href');

        if (query.length > 0) {
            pageUrl += `&search=${query}`;
        }

        fetchUsers(pageUrl);
    });


});



// for edit user
// لما المستخدم يضغط على زر Edit
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();

    // عبّي البيانات من الزر داخل المودال
    $('#edit_user_id').val($(this).data('id'));
    $('#edit_username').val($(this).data('username'));
    $('#edit_email').val($(this).data('email'));
    $('#edit_role').val($(this).data('role'));
    $('#edit_password').val(''); // بنسيب الباسورد فاضي دايمًا

    // الصورة
    const photo = $(this).data('photo');
    $('#edit_photo_preview').attr('src', photo).show();

    // افتح المودال
    openEditModal();
});


$('#editUserForm').on('submit', function (e) {
    e.preventDefault();
    $('.error-message').remove();

    var formData = new FormData(this);
    let userId = $('#edit_user_id').val();
    let url = `/users/${userId}`;

    formData.append('_method', 'PUT');

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success) {
                closeEditModal();

                Swal.fire({
                    icon: 'success',
                    title: 'User Updated Successfully!',
                    text: 'The user information has been updated.',
                    confirmButtonText: 'OK'
                });

                // جهز الصورة والرول
                var photo = response.user.photo ? `/storage/${response.user.photo}` : `dist/assets/img/avatar5.png`;
                var role = response.user.role ?? 'User';

                var updatedRow = `
                    <tr>
                        <td>${response.user.id}</td>
                        <td>${response.user.username}</td>
                        <td>${response.user.email}</td>
                        <td><img src="${photo}" width="50"></td>
                        <td><span class="role-badge role-${role}">${role}</span></td>
                        <td>
                            <a href="#" class="btn btn-edit"
                               data-id="${response.user.id}"
                               data-username="${response.user.username}"
                               data-email="${response.user.email}"
                               data-role="${role}"
                               data-photo="${photo}">
                               Edit
                            </a>
                            <form action="/users/${response.user.id}" method="POST" class="inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                    </tr>
                `;

                // استبدل الصف القديم بالجديد
                $('#data-table tbody tr').each(function () {
                    if ($(this).find('td:first').text() == userId) {
                        $(this).replaceWith(updatedRow);
                    }
                });
            }
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                $.each(errors, function (field, messages) {
                    var errorMessage = `<div class="error-message">${messages[0]}</div>`;
                    $('#edit_' + field).after(errorMessage);
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    confirmButtonText: 'OK'
                });
            }
        }
    });
});



$('#edit_photo').on('change', function (event) {
    const file = event.target.files[0];
    const preview = $('#edit_photo_preview');

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.attr('src', e.target.result);
            preview.show();
        };
        reader.readAsDataURL(file);
    } else {
        preview.hide();
        preview.attr('src', '#');
    }
});
