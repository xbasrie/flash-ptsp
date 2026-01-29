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
        return $user->hasRole(['super admin', 'admin kepegawaian']);
    }

    public function view(User $user, Submission $submission): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian']);
    }

    public function update(User $user, Submission $submission): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian']);
    }

    public function delete(User $user, Submission $submission): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian']);
    }

    public function restore(User $user, Submission $submission): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian']);
    }

    public function forceDelete(User $user, Submission $submission): bool
    {
        return $user->hasRole(['super admin', 'admin kepegawaian']);
    }
}
