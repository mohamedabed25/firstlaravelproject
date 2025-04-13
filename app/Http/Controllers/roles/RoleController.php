<?php

// app/Http/Controllers/Roles/RoleController.php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // عرض جميع الأدوار
    public function index()
    {
        // جلب البيانات المقسمة باستخدام paginate
        $roles = Role::paginate(10); // سيعرض 10 عناصر في الصفحة

        return view('roles.index', compact('roles')); // تمرير البيانات إلى الـ View
    }

    // عرض صفحة إضافة دور جديد
    public function create()
    {
        return view('roles.create'); // عرض صفحة إضافة الدور
    }

    // تخزين الدور الجديد
    public function store(Request $request)
    {
        // التحقق من المدخلات
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        // إنشاء الدور
        Role::create(['name' => $request->name]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    // عرض الدور
    public function show(Role $role)
    {
        // return view('roles.show', compact('role'));
    }

    // عرض صفحة تعديل الدور
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // تحديث الدور
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    // حذف الدور
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }
}
