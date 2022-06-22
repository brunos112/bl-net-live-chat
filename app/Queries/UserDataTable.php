<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserDataTable.
 */
class UserDataTable
{
    /**
     * @param array $input
     * 
     * @return Builder
     */
    public function get($input = [])
    {
        $users = User::with(['roles']);
        $users->when(
            isset($input['filter_user']),
            function (Builder $q) use ($input) {
                if ($input['filter_user'] == User::FILTER_ARCHIVE) {
                    $q->onlyTrashed();
                }
                if ($input['filter_user'] == User::FILTER_ALL) {
                    $q->withTrashed();
                }
                if ($input['filter_user'] == User::FILTER_ACTIVE) {
                    $q->where('is_active', '=', 1);
                }
                if ($input['filter_user'] == User::FILTER_INACTIVE) {
                    $q->where('is_active', '=', 0);
                }
            }
        )->where('id', '!=', getLoggedInUserId());
        $users = $users->select(['photo_url', 'id', 'name', 'email', 'phone', 'privacy', 'is_active', 'deleted_at']);

        return $users;
    }
}
