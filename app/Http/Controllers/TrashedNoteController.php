<?php

namespace App\Http\Controllers;

use App\Models\note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashedNoteController extends Controller
{
    public function index()
    {
        $notes = note::whereBelongsTo(Auth::user())->onlyTrashed()->latest('updated_at')->paginate(3);
        return view('notes.index')->with('notes', $notes);
    }

    public function show(note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        else{
            return view('notes.show')->with('note', $note);
        }
    }

    public function restore(note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        else{
            $note->restore();
        }
        return to_route('trashed.index')->with('success', 'Note restored successfully');
    }

    public function destroy(note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        else{
            $note->forceDelete();
        }
        return to_route('trashed.index')->with('success', 'Note Deleted successfully');
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function search(Request $request)
    // {
        // $search = $request['search'];

        // if ($search != '') {
            // $notes = note::where('title', 'LIKE', "%$search%")->get();
            // dd($request);
        // }
    
        // return view('notes.index')->with('notes', $notes);
    // }
}
