<?php

namespace App\Http\Controllers;

use App\Models\Mylist;
use Illuminate\Http\Request;

class MylistController extends Controller
{

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
        return redirect('my-lists');
    }

    public function showEditScreen(Mylist $list) {
        if (auth()->user()->id !== $list['user_id']) {
            return redirect('/dashboard');
        }

        return view('edit-list', ['list' => $list]);
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
}
