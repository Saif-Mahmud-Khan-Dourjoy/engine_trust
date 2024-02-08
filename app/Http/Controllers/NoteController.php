<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function get_notes(Request $request){

        $notes=Note::where('quote_id',$request->quoteId)->get();

        return response()->json(['data'=>$notes]);

    }

    public function create_note(Request $request){
        if(!$request->note){
         return back()->with('error','Please write your Note to add one');
        }else{
            if (Auth::guard('web')->check()) {
                $userId = Auth::guard('web')->user()->id;
                $id = null;
            } else {
                $userId = Auth::guard('businessUser')->user()->user_id;
                $id = Auth::guard('businessUser')->user()->id;
            }

            $note=new Note();
            $note->quote_id=$request->quote_id;
            $note->remark=$request->note;
            $note->added_by_company	=$userId;
            $note->added_by_user=$id;
            $note->save();

            return back()->with('success','Successfully Added Note');
        }
    }
}
