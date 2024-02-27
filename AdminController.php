<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $data=User::orderby('id','desc',)->paginate(10);
        return view('admin.users', compact('data'));
    }

    public function deleteusers($id)
    {
        $data=User::find($id);
        $data->delete();
        return redirect()->back()->with('success','Data berhasil dihapus!');
    }

    public function editusersview($id)
    {
        $data=User::find($id);
        return view("admin.editusers",compact("data"));
    }

    public function editusers(request $request, $id)
    {
        $data=User::find($id);

        $data->name=$request->name;
        $data->email=$request->email;

        $data->save();

        return redirect()->route('users')->with('success', 'Data berhasil diedit!');
    }
}
