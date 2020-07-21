<?php

namespace App\Http\Controllers\API\Controllers\User;

use App\Http\Controllers\API\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Auth\User as UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * @return JsonResponse
     */
    public function index($id): JsonResponse
    {
        $user = User::findOrFail($id);
        $posts = Post::where('user_id', $id)->take(5)->get();
        $formations = $user->formations();

        return $this->success([
            'user' => $user,
            'posts' => $posts,
            'formations' => $formations
        ], 200);
    }

    /**
     * Retourne la liste de ce qui suivent l'utilisateur
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function follower($id): JsonResponse
    {
        $followers = User::find($id)->followers;

        return $this->success($followers, 200);
    }

    /**
     * Retourne la liste des personnes suivis de l'utilisateur
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function following($id): JsonResponse
    {
        $followings = User::find($id)->followings;

        return $this->success($followings, 200);
    }

    /*
     * Changer la description de l'utilisateur
     */
    public function storeAbout(Request $request): JsonResponse
    {
        $user = $this->auth->user();
        $user->about = $request->get('about');
        $user->save();

        return $this->success('La description à bien été modifiée.', 200);
    }

    /**
     * Mise à jour du profil
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
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

        return $this->success('Votre compte à bien été mis à jour.', 200);
    }

}
