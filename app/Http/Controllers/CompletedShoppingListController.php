<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingListPost;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingList as ShoppingListModel;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    /**
     * 
     * shopping list
     * @return \Illuminate\View\View
     */
    public function list()
    {
        return view('shopping_list.list', ['list' => $list]);
    }
}