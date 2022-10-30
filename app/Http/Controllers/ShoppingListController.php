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
     * 
     * 
     */
    protected function listbuilder()
    {
        return ShoppingListModel::where('user_id', Auth::id())
                     ->orderBy('name', 'ASC');
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
    
    /**
     *  find item
     */
    protected function getShoppingListModel($shopping_list_id)
    {
        $item = ShoppingListModel::find($shopping_list_id);
        if ($item === null) {
            return null;
        }
        if ($item->user_id !== Auth::id()) {
            return null;
        }
        //
        return $item;
    }
    
    
    /**
     * delete item from shopping list
     * 
     */
    public function delete(Request $request, $shopping_list_id)
    {
        $item = $this->getShoppingListModel($shopping_list_id);
        var_dump($item);
        die();
        if ($item !== null) {
            $item->delete();
            $request->session()->flash('front.list_delete_success', true);
        }
        return redirect('/shopping_list/list');
    }
}