<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::orderBy('created_at', 'desc');
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        $users = $query->paginate(15)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form', ['user' => new User, 'editing' => false]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,member',
            'phone'    => 'nullable|string|max:50',
            'position' => 'nullable|string|max:100',
            'is_active'=> 'boolean',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data['password']  = Hash::make($data['password']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('photo')) {
            $data['profile_photo_path'] = $this->storeUpload($request->file('photo'), 'profile-photos');
        }

        User::create($data);
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', ['user' => $user, 'editing' => true]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required','email', Rule::unique('users','email')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'required|in:admin,member',
            'phone'    => 'nullable|string|max:50',
            'position' => 'nullable|string|max:100',
            'is_active'=> 'boolean',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('photo')) {
            if ($user->profile_photo_path) {
                $this->deleteUpload($user->profile_photo_path);
            }
            $data['profile_photo_path'] = $this->storeUpload($request->file('photo'), 'profile-photos');
        }

        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }
        if ($user->profile_photo_path) {
            $this->deleteUpload($user->profile_photo_path);
        }
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function toggleActive(User $user)
    {
        if ($user->id === auth()->id()) {
            return response()->json(['error' => 'Cannot deactivate your own account.'], 403);
        }
        $user->update(['is_active' => !$user->is_active]);
        return response()->json(['is_active' => $user->is_active]);
    }
}
