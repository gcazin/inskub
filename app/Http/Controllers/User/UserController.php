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
        $posts = Post::where('user_id', $id)->take(5)->get();
        $formations = $user->formations();
        return view('user.profile', compact('user', 'posts', 'formations'));
    }

    public function follower($id)
    {
        $user = User::find($id);
        return view('user.partials.followers-list', compact('user'));
    }

    public function following($id)
    {
        $user = User::find($id);
        return view('user.partials.followings-list', compact('user'));
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

    public function storeAbout(Request $request)
    {
        $user = $this->auth->user();
        $user->about = $request->get('about');
        $user->save();

        return redirect()->route('user.profile', $this->auth->id());
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

        if($request->has('avatar')) {
            $avatarName = $user->id . '_avatar' . time() . '.' . request()->avatar->getClientOriginalExtension();
            $user->avatar = $avatarName;
            Storage::putFileAs('avatars', $request->file('avatar'), $avatarName);
        } else {
            $user->avatar = $this->auth->user()->avatar;
        }
        $user->last_name = $request->input('last_name');
        $user->first_name = $request->input('first_name');
        $user->email = $request->input('email');

        if($request->filled('password')) {
            $request->validate([
                'last_name' => ['string', 'max:25'],
                'first_name' => ['string', 'max:25'],
                'email' => ['string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'password' => ['string', 'min:8', 'confirmed'],
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $user->password = bcrypt($request->password);
        } else {
            $request->validate([
                'last_name' => ['string', 'max:25'],
                'first_name' => ['string', 'max:25'],
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
