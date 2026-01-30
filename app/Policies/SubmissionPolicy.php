<?php

namespace App\Policies;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubmissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian', 'admin bimas', 'admin zawa', 'admin kub']);
    }

    public function view(User $user, Submission $submission): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian', 'admin bimas', 'admin zawa', 'admin kub']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian', 'admin bimas', 'admin zawa', 'admin kub']);
    }

    public function update(User $user, Submission $submission): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian', 'admin bimas', 'admin zawa', 'admin kub']);
    }

    public function delete(User $user, Submission $submission): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian', 'admin bimas', 'admin zawa', 'admin kub']);
    }

    public function restore(User $user, Submission $submission): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian', 'admin bimas', 'admin zawa', 'admin kub']);
    }

    public function forceDelete(User $user, Submission $submission): bool
    {
        return $user->hasRole(['super admin']);
    }
}
