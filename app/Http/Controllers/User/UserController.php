<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\User as UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * Instance Auth
     *
     * @var AuthManager
     */
    protected AuthManager $auth;

    /**
     * Instance User
     *
     * @var UserRepository
     */
    protected UserRepository $user;

    /**
     * Constructor
     *
     * @param UserRepository $user
     * @param AuthManager $auth
     */
    public function __construct(UserRepository $user, AuthManager $auth)
    {
        $this->user = $user;
        $this->auth = $auth;
        $this->middleware('auth');
    }

    /**
     * Page de profil
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::all()->where('user_id', $id);
        return view('user.profile', compact('user', 'posts'));
    }

    /**
     * Page "Options"
     *
     * @return Factory|View
     */
    public function options()
    {
        $user = $this->auth->user();
        return view('user.options', compact('user', $user));
    }

    /**
     * Page "Mon compte"
     *
     * @return Factory|View
     */
    public function edit(): View
    {
        $user = $this->auth->user();
        return view('user.edit', compact('user', $user));
    }

    /**
     * Mise à jour du profil
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = $this->user->findOrFail($this->auth->user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if($request->has('avatar')) {
            $avatarName = $user->id . '_avatar' . time() . '.' . request()->avatar->getClientOriginalExtension();
            $user->avatar = $avatarName;
            Storage::putFileAs('avatars', $request->file('avatar'), $avatarName);
        } else {
            $user->avatar = $this->auth->user()->avatar;
        }

        if($request->filled('password')) {
            $request->validate([
                'name' => ['string', 'max:25', 'unique:users,name,'. $user->id],
                'email' => ['string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'password' => ['string', 'min:8', 'confirmed'],
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $user->password = bcrypt($request->password);
        } else {
            $request->validate([
                'name' => ['string', 'max:25', 'unique:users,name,'. $user->id],
                'email' => ['string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }

        $user->save();

        return redirect()->route('user.edit')->with('success','Votre compte à bien été mis à jour');
    }

    public function destroy($id)
    {

    }

}
