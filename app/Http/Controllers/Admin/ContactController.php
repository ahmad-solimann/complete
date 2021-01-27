<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $contacts =  Contact::find(1);
        return view('users.Contact.index',compact('contacts'));
    }
    public function edit($id){
        $contact = Contact::find($id);
        return view('users.Contact.edit',compact('contact'));
    }
    public function update(Request $request , $id){
        $contact = Contact::find($id);
        $contact->update($request->only(['phone','email','address','facebook','twitter','linked_in','instagram']));
        return redirect(route('contacts.index'));
    }

}
