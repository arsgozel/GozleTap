<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string|max:255',
        ]);
        $q = $request->q ?: null;

        $objs = Contact::when($q, function ($query, $q) {
            return $query->where(function ($query) use ($q) {
                $query->orWhere('phone', 'like', '%' . $q . '%');
                $query->orWhere('name', 'like', '%' . $q . '%');
                $query->orWhere('email', 'like', '%' . $q . '%');
                $query->orWhere('received_at', 'like', '%' . $q . '%');
            });
        })
            ->orderBy('id', 'desc')
            ->paginate(50)
            ->withQueryString();

        return view('admin.contacts.index')
            ->with([
                'objs' => $objs,
            ]);
    }

    public function destroy($id)
    {
        $obj = Contact::findOrFail($id);
        $objName = $obj->name;
        $obj->delete();

        return redirect()->back()
            ->with([
                'success' => trans('app.contact') . ' (' . $objName . ') ' . trans('app.deleted') . '!'
            ]);
    }
}
