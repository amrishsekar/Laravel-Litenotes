<?php

namespace App\Http\Controllers;

use id;
use App\Models\note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class noteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $userId = Auth::id();
        // FETCHING ALL NOTES THOSE ARE RECENTLT ADDED AND UPDATED IN THE DATABASE:~
        // $notes = note::where('user_id', $userId)->latest('updated_at')->paginate(3);

        $notes = note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(3);
        return view('notes.index')->with('notes', $notes);

        // // Showing all data:~
        //     $notes->each(function($note){
        //         dump($note->title);
        //     });

        // dd($notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);
        
        note::create([
            'uuid' => Str::uuid(),
            'user_id'=> Auth::id(),
            'title'=>$request->title,
            'text'=>$request->text
        ]);
        return to_route('notes.index');
        // dd($request);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        else{
            return view('notes.show')->with('note', $note);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        
        return view('notes.edit')->with('note',$note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        else{
            $request->validate([
                'title' => 'required|max:120',
                'text' => 'required'
            ]);
            
            $note->update([
                'title'=>$request->title,
                'text'=>$request->text
            ]);
            return to_route('notes.show', $note);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(note $note)
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        } 
    
        $note->delete();        
    
        return to_route('notes.index');
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // $search = $request['search'];

        // if ($search != '') {
            // $notes = note::where('title', 'LIKE', "%$search%")->get();
            dd($request);
        // }
    
        // return view('notes.index')->with('notes', $notes);
    }
}

