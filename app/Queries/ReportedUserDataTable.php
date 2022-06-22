<?php

namespace App\Queries;

use App\Models\ReportedUser;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserDataTable.
 */
class ReportedUserDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        return ReportedUser::with(['reportedBy', 'reportedTo'])
            ->whereHas('reportedBy')
            ->whereHas('reportedTo')
            ->select('reported_users.*');
    }
}
