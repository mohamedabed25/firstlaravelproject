// for edit user



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




$(document).on('click', '#editUserModal', function(event) {
    if ($(event.target).is('#editUserModal') ) {
        closeEditModal();

    }
});

$(document).on('keydown', function(event) {
    if (event.key === "Escape") {
        closeEditModal();
    }
});

// لما المستخدم يضغط على زر Edit
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();

    // عبّي البيانات من الزر داخل المودال
    $('#edit_user_id').val($(this).data('id'));
    $('#edit_username').val($(this).data('username'));
    $('#edit_email').val($(this).data('email'));
    $('#edit_email').val($(this).data('email'));
    $('#edit_phone').val($(this).data('phone'));
    $('#edit_role').val($(this).data('role'));
    $('#edit_password').val(''); // بنسيب الباسورد فاضي دايمًا

    // الصورة هنا خزنها في المتغير ده
    const photo = $(this).data('photo');
    // بعدين اعرض الصوره في edit_photo_preview
    $('#edit_photo_preview').attr('src', photo).show();

    //   بعد ما تعمل كل ده  افتح  المودال بقي
    openEditModal();
});


// لما الفورم بتاع التعديل يتم إرساله (يعني المستخدم يضغط "Update")، شغّل الفنكشن دي.
$(document).on('submit', '#editUserForm', function (e) {

    e.preventDefault();
    $('.error-message').remove();

    var formData = new FormData(this);
    let userId = $('#edit_user_id').val();
    //  اللينك ده بيتقرا في الكونترولر علي انه ابديت
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
                fetchUsers(window.usersSearchUrl);
                Swal.fire({
                    icon: 'success',
                    title: 'User Updated Successfully!',
                    text: 'The user information has been updated.',
                    confirmButtonText: 'OK'
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


function fetchUsers(url) {
    $.ajax({
        url: url,
        type: 'GET',
        // في حاله ان السيرفر رد بنجاح خد الداتا اللي راجعه من الكونترولر وحطها في users-data
        success: function (data) {
            $('#users-data').html(data);
        },
        //  في حالها الايرور اعرض الاخطاء في الكونسل عشان نعرف نتعامل معاها
        error: function (xhr, status, error) {
            console.error("XHR:", xhr);
            console.error("Status:", status);
            console.error("Error:", error);
        }
    });
}




// image preview for edit
// بدل ده
// $('#edit_photo').on('change', function (event) {

// الفايدة هي أنه بيستطيع التعامل مع العناصر اللي هتتضاف بعد تحميل الصفحة. استخدم ده 
$(document).on('change', '#edit_photo', function (event) {
    const file = event.target.files[0]; // الصورة اللي المستخدم اختارها
    const preview = $('#edit_photo_preview');

    // ✅ شيل القديمة (بغض النظر عن وجود جديدة ولا لأ)
    preview.attr('src', '#').hide();

    // ✅ لو المستخدم اختار صورة
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.attr('src', e.target.result).show();
        };

        reader.readAsDataURL(file);
    }
});

