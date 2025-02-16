<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * This method retrieves a paginated list of users from the database,
     * sorts them by the latest created, and prepares the data for the view.
     * It also calculates the total number of users and the current page
     * for pagination purposes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::latest()->paginate(15);
        $title = 'User Data';
        $usersCount = User::count();
        $currentPage = $users->currentPage();
        $totalPages = $users->lastPage();
        $orderIn = 'created_at';
        $orderBy = 'desc';
        return view('panel.user.index', compact('title', 'users', 'usersCount', 'currentPage', 'totalPages', 'orderBy', 'orderIn'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.user.create', [
            'title' => 'Create New User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created user in storage.
     *
     * This method validates the incoming request data for creating a new user,
     * including email, name, password, and password confirmation. If validation
     * passes, a new user is created and saved to the database. The password is
     * hashed for security. After successful creation, the user is redirected back
     * with a success message.
     *
     * @param Request $request The incoming request containing user data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a status message.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|min:5|max:255',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $newUser = new User([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        $newUser->save();

        return back()->with([
            'status' => 'success',
            'message' => 'Succsssful created user'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit User';
        $user = User::findOrFail($id);

        return view('panel.user.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|email',
            'position' => 'required',
        ]);

        $user = User::findOrFail($id);

        // Cek apakah nama atau email berubah dan tidak sama dengan nama atau email user lain
        if ($request->name !== $user->name) {
            $request->validate([
                'name' => 'unique:users,name',
            ]);
            $user->name = $request->name;
        }

        if ($request->email !== $user->email) {
            $request->validate([
                'email' => 'unique:users,email',
            ]);
            $user->email = $request->email;
        }

        if ($request->position !== 'user') {
            $user->syncRoles($request->position);
            $newRole = Role::findByName($request->position);
            $newPermissions = $newRole->permissions;
            $user->syncPermissions($newPermissions);
        }

        $user->save();

        return back()->with([
            'status' => 'success',
            'message' => 'Successful create new user'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return back()->with([
            'status' => 'success',
            'message' => 'Succsssful deleted user'
        ]);
    }

    public function editPassword($id)
    {
        $user = User::findOrFail($id);
        return view('panel.user.reset-password', compact('user'));
    }

    public function updateUserPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password'
        ]);

        $user = User::findOrFail($id);

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with([
            'status' => 'success',
            'message' => "Berhasil memperbarui user password dengan nama: $user->name"
        ]);
    }

    public function deleteSelected(Request $request)
    {
        $userIds = $request->input('user_ids');
        if ($userIds) {

            User::whereIn('id', $userIds)->delete();
            return back()->with([
                'status' => 'success',
                'message' => "Successful deleted users"
            ]);
        }

        return back()->with([
            'status' => 'success',
            'message' => "No users selected for deletiion"
        ]);
    }

    public function search(Request $request)
    {
        $orderIn = $request->query('orderIn') ? $request->query('orderIn') : 'created_at';
        $orderBy = $request->query('orderBy') ? $request->query('orderBy') : 'desc';
        $search = $request->query('search') ? $request->query('search') : '';
        $role = $request->query('role') ? $request->query('role') : 'all';

        // Query dasar untuk pengguna dengan kriteria pencarian
        $query = User::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhere('updated_at', 'like', '%' . $search . '%');
            });
        });

        // Filter berdasarkan peran
        if ($role !== 'all') {
            if ($role === 'user') {
                // Cari pengguna yang tidak memiliki peran admin atau staff
                $query->whereDoesntHave('roles', function ($query) {
                    $query->whereIn('name', ['admin']);
                });
            } else {
                // Cari pengguna dengan peran spesifik
                $query->role($role);
            }
        }

        // Hitung total pengguna yang sesuai dengan kriteria pencarian
        $usersCount = $query->count();
        // Dapatkan pengguna dengan pagination
        $users = $query->orderBy($orderIn, $orderBy)->paginate(15);
        $currentPage = $users->currentPage();
        $totalPages = $users->lastPage();
        return view('partials.users-table', compact('users', 'usersCount', 'currentPage', 'totalPages', 'orderBy', 'orderIn'));
    }
}
