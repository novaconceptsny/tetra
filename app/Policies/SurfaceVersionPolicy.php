<?php

namespace App\Policies;

use App\Models\SurfaceVersion;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurfaceVersionPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, SurfaceVersion $surfaceVersion): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, SurfaceVersion $surfaceVersion): bool
    {
        //
    }

    public function delete(User $user, SurfaceVersion $surfaceVersion): bool
    {
        //
    }

    public function restore(User $user, SurfaceVersion $surfaceVersion): bool
    {
        //
    }

    public function forceDelete(
        User $user,
        SurfaceVersion $surfaceVersion
    ): bool {
        //
    }
}
