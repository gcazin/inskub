<?php

namespace App\Http\Repository;

use App\Helpers\helpers;
use App\Models\User;
use function App\Helpers\remove_accent;
use function App\Helpers\removeAccent;

class UserRepository
{
    /**
     * @var \App\Models\User
     */
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function avatarPath(int $id)
    {
        $part = static fn($attribut) => removeAccent(strtolower(trim(substr($attribut, 0, 1))));

        $user = $this->user->find($id);
        if ($user->avatar === "user.jpg" || $user->avatar === null) {
            return "https://avatars.dicebear.com/v2/initials/{$part($user->first_name)}{$part($user->last_name)}.svg?options[fontSize]=40";
        }
        return self::find($id)->avatar;
    }
}
