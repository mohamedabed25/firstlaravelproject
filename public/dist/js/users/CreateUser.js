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

    $('#user_id').val('');

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
                    fetchUsers(window.usersSearchUrl);

                    // اعرض بوب اب النجاح
                    Swal.fire({
                        icon: 'success',
                        title: 'User Created Successfully!',
                        text: 'The new user has been added to the system.',
                        confirmButtonText: 'OK'
                    });
                    // بنحول الفورم من جي كويري اوبجكت ل فورم هتمل اقدر اتعامل معاها وامسح الداتا اللي فيها
                    $('#createUserForm')[0].reset();
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


    // For image preview in create modal
    // اول ما المستخدم يجي يختار ويغير  صوره اعمل اللي جوا الفنكشن دي
    $('#photo').on('change', function (event) {
        // يجيب اول صوره اختارها المستخدم ويحطها في المتغير ده
        const file = event.target.files[0];
        // بيخزن العنصر  بال اي دي بتاعه  اللي الصوره دي هتتعرض فيه ويحطه في المتغير ده
        const preview = $('#photo-preview');
        // لو الفايل عباره عن فايل والنوع بتاعه  صوره اعمل اللي جوا

            //  هنا بننشئ كائن جديد من FileReader
            const reader = new FileReader();
            // بعد ما الريدر يخلص قرايه الفايل اعمل اللي جوا الفنكشن
            reader.onload = function (ereader) {
                // حط القيمه  اللي جايه من الريدر  في الصفه اللي اسمها src
                preview.attr('src', ereader.target.result);
                //  اظهر العنصر اللي هنعرض فيه الصوره
                preview.show();
            };
            // اعرض الصوره
            reader.readAsDataURL(file);


    });
});




// for search and pagnation serch into all links



// لما الصفحة تخلص تحميل بالكامل، ابدأ شغّل الكود اللي جوه
$(document).ready(function () {
    // كل مرة المستخدم يكتب حرف في مربع البحث (id="table-search")، يشتغل الحدث ده
    $('#table-search').on('keyup', function () {
        // بنجيب النص اللي المستخدم كتبه في مربع البحث ونخزنه في متغير اسمه query
        // this تعود علي العنصر اللي  اللي انا باعت الاي دي بتاعه
        let query = $(this).val();
        // ابعت القيمه اللي اللي اتخزنت في الفايربل وابعتها للفنكشن fetchUsers
        fetchUsers(`${window.usersSearchUrl}?search=${query}`);
    });

    // هنبعت اجاكس ريكويست للسيرفر ب اللينك والداتا اللي
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

    // عند الضغط علي اي a جوا ال pagnation  شغل اللي جوا الفنكشن
    $(document).on('click', '.pagination a', function (e) {
        // تجنب الباجنيشن العادي عند الضغط علي اللينك
        e.preventDefault();
        // خزن  القيمه اللي بتيجي من الخانه  table-search وحطها في المتغير ده
        let query = $('#table-search').val();
        //  .attr('href')  معناها: هات قيمة الـ href بتاعة الرابط. وخزنها في المتغير ده
        let pageUrl = $(this).attr('href');

        if (query.length > 0) {
            pageUrl += `&search=${query}`;
        }
        //  pageUrl شغل الفنكشن اللي بتبعت اجاكس ريكويست للسيرفر علي ال بالسيرش اللي المستخدم كتبه
        fetchUsers(pageUrl);
    });


});


//  FOR DELETE USER USING AJAX
$(document).off('submit', '.delete-form').on('submit', '.delete-form', function (e) {
    e.preventDefault(); // امنع الإرسال التقليدي

    Swal.fire({
        title: 'Are you sure?',
        text: "This user will be deleted permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            let form = $(this);
            let url = form.attr('action'); // الرابط من action في الفورم
            let row = form.closest('tr');  // صف الجدول

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: form.find('input[name="_token"]').val()
                },
                success: function (response) {
                    // إزالة الصف من الجدول
                    row.remove();

                    // عرض إشعار النجاح
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted Successfully',
                        text: 'The user has been removed from the list.',
                        confirmButtonText: 'OK'
                    });
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'An Error Occurred',
                        text: 'The user could not be deleted. Please try again.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });



});
