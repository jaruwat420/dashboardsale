<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\DataTables\UserActivitiesDataTable;
use App\Models\User;
use App\Models\UserActivities;
use Illuminate\Support\Facades\Auth;



class HistoryController extends Controller
{
    //  History
    public function index (UserActivitiesDataTable $dataTable)
    {
        return $dataTable->render('admin.history.index');
    }

    // insert log history copy url
    // public function copyUrl (Request $request) {

    //     UserActivities::create([
    //         'user_id' => Auth::id(),
    //         'user_name' => Auth::user()->name,
    //         'action' => 'copy',
    //         'ip_address' => $request->ip(),
    //         'user_agent' => $request->userAgent(),
    //     ]);
    //     return response(['status' => 'success', 'message' => 'Create Links Successfully.']);
    // }
}
