<?php

namespace App\Http\Controllers;

use App\Models\Myitem;
use App\Models\Mylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MylistController extends Controller
{

    public function deleteList(Mylist $list) {
        if (auth()->user()->id === $list['user_id']) {
            // Delete all items associated with the list
            $list->items()->delete();
            // Delete the list itself
            $list->delete();
        }

        return redirect('/my-lists');
    }

    public function deleteItem(Mylist $list, Myitem $item) {
        if (auth()->user()->id === $list['user_id'] && $item->list_id === $list->id) {
            // Delete current items associated with the list
            $item->delete();
        }

        return redirect("/edit-list/{$list->id}");
    }

    public function updateList(Mylist $list, Request $request) {
        if (auth()->user()->id !== $list['user_id']) {
            return redirect('/dashboard');
        }

        $incomingFields = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        //Dont allow to store code - strip tags
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);

        //Update in database
        $list->update($incomingFields);
        return redirect('/my-lists');
    }

    public function showEditScreen(Mylist $list) {
        if (auth()->user()->id !== $list['user_id']) {
            return redirect('/dashboard');
        }

        // Fetch all items associated with the current list
        $items = $list->items()->get(); // Using the relationship method

        return view('edit-list', ['list' => $list, 'items' => $items]);
    }

    public function createMylist(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        //Dont allow to store code - strip tags
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        //match id of the current user to the "user_id" field of the list
        $incomingFields['user_id'] = $request->user()->id;
        Mylist::create($incomingFields);
        return redirect('/my-lists');
    }

    public function addItemToList(Mylist $list, Request $request) {

        $incomingFields = $request->validate([
            'name' => 'required',
            'item_url' => 'required',
        ]);

        //Dont allow to store code - strip tags
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['item_url'] = strip_tags($incomingFields['item_url']);
        //match "list_id" to the id of the list in mylists table
        $incomingFields['list_id'] = $list->id;
        //Insert fields into DB
        Myitem::create($incomingFields);
        return redirect("/edit-list/{$list->id}");
    }
}
