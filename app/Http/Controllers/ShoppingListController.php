<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingListPost;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingList as ShoppingListModel;

class ShoppingListController extends Controller
{
    /**
     * 
     * 
     * 
     */
    protected function listbuilder()
    {
        return ShoppingListModel::select('created_at', 'name')
                     ->where('user_id', Auth::id())
                     ->orderBy('name', 'ASC');
    }
     
    /**
     * 
     * shopping list
     * @return \Illuminate\View\View
     */
    public function list()
    {
        $per_page = 5;
        $list = $this->listbuilder()
                     ->paginate($per_page);
        return view('shopping_list.list', ['list' => $list]);
    }
    
    /**
     * authenticate login request
     * 
     */
    public function register(ShoppingListPost $request)
    {
        // validation
        $datum = $request->validated();
        // id
        $datum['user_id'] = Auth::id();
        // auth
        try
        {
            $r = ShoppingListModel::create($datum);
        }
        catch(\Throwable $e)
        {
            echo $e->getMessage();
            exit;
        }
        $request->session()->flash('front.list_register_success', true);
        return redirect('/shopping_list/list');
    }
}