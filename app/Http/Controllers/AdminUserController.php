<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User as UserModel;

class AdminUserController extends Controller
{
    /**
     * 
     * select users.id, users.name, count(*) from users
     * left join completed_shopping_lists on users.id = completed_shopping_lists.user_id
     * group by  users.id
     * @return \Illuminate\View\View
     */
    public function list()
    {
        $group_by_column = ['users.id', 'users.name'];
        $list = UserModel::select($group_by_column)
                         ->selectRaw('count(completed_shopping_lists.id) AS item_num')
                         ->leftJoin('completed_shopping_lists', 'users.id', '=', 'completed_shopping_lists.user_id')
                         ->groupBy($group_by_column)
                         ->orderBy('users.id')
                         ->get();
        return view('admin.user.list', ['list' => $list]);
    }
}