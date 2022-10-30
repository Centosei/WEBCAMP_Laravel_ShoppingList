<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CompletedShoppingListController extends Controller
{
    /**
     * 
     * shopping list
     * @return \Illuminate\View\View
     */
    public function list()
    {
        return view('shopping_list.completed_list');
    }
}