<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\RoleSwapRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request){
        $roles = Role::all();
        $query = User::query()->with('role');

        //SEARCH BY NAME (q)
        $query->when($request->filled('q'), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->q . '%');
        });

        //SEARCH BY ROLE (role)
        $query->when($request->filled('role'), function ($query) use ($request) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('id', $request->role);
            });
        });

        //RUN
        $users = $query->orderBy('role_id', 'asc')->latest()->paginate(4)->withQueryString();

        return view('profile.index', ['users' => $users, 'roles' => $roles]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request){
        $user = $request->user();
        $addresses = $user->shipping_addresses()->where('active', true)->latest()->paginate(3);

        return view('profile.edit', ['user' => $user, 'addresses' => $addresses]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) 
            $user->email_verified_at = null;

        if ($request->hasFile('image')) {
            $path = ImageService::squareAndResize($request->file('image'), "users/{$user->id}", '1.webp', 512, $user->profile_imageRoute);
            $user->update(['profile_imageRoute' => $path]);
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->disable();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function roleswap(RoleSwapRequest $request, User $user) {
        $user->role_id = $request->role_id;
        $user->save();

        return back();
    }
}
