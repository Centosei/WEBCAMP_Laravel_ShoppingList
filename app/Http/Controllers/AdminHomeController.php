<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingListPost;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingList as ShoppingListModel;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    public function top()
    {
        return view('admin.top');
    }
}