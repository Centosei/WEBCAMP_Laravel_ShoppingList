<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;
use Illuminate\Support\Facades\Auth;

class CompletedShoppingListController extends Controller
{
    protected function listbuilder()
    {
        return CompletedShoppingListModel::where('user_id', Auth::id())
                     ->orderBy('name', 'ASC')
                     ->orderBy('created_at', 'DESC');
    }
    /**
     * 
     * shopping list
     * @return \Illuminate\View\View
     */
    public function list()
    {
        $per_page = 3;
        $list = $this->listbuilder()
                     ->paginate($per_page);
        return view('shopping_list.completed_list', ['list' => $list]);
    }
}