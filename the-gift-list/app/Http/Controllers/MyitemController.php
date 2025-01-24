<?php

namespace App\Http\Controllers;

use App\Models\Myitem;
use App\Models\Mylist;
use Illuminate\Http\Request;

class MyitemController extends Controller
{

    public function deleteItem(Mylist $list, Myitem $item) {
        if (auth()->user()->id === $list['user_id'] && $item->list_id === $list->id) {
            // Delete current items associated with the list
            $item->delete();
        }

        return redirect("/edit-list/{$list->id}");
    }

    
    public function addItemToList(Mylist $list, Request $request) {

        $incomingFields = $request->validate([
            'name' => 'required',
            'item_url' => 'required',
        ]);

        //Dont allow to store code - strip tags
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['item_url'] = strip_tags($incomingFields['item_url']);
        // Prepend "http://" if the URL doesn't start with a scheme
        if (!preg_match('/^https?:\/\//', $incomingFields['item_url'])) {
            $incomingFields['item_url'] = 'http://' . $incomingFields['item_url'];
        }
        //match "list_id" to the id of the list in mylists table
        $incomingFields['list_id'] = $list->id;
        //Insert fields into DB
        Myitem::create($incomingFields);
        return redirect("/edit-list/{$list->id}");
    }
}
