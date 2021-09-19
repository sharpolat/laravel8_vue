<?php

namespace App\Http\Controllers;

use App\Models\JobApply;
use Illuminate\Http\Request;

class JobApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = JobApply::latest()->paginate(10);
        return view('jobApply.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('jobApply.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:15|min:3',
            'message' => 'required|max:1000|min:3',
            'file_path' => 'required|mimes:csv,txt,xlx,xls,pdf,doc,docx|max:2048',
        ]);
        $fileModel = new JobApply();
        
        if($request->file()) {
            $images = $request->file('file_path');
            $fileName = time().'_'.$request->file_path->getClientOriginalName();
            $filePath = 'uploads';
            $images->move($filePath, $fileName);
            $fileModel->file_path = $fileName;
        }

        $fileModel->name = $request->name;
        $fileModel->email = $request->email;
        $fileModel->message = $request->message;
        $fileModel->save();
        if($fileModel) {
            return back()->withSuccess('обновления прошли успешно')->withInput();
        }
        else {
            return back()->withErrors(['msg'=>'Ошибка'])
                         ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = JobApply::find($id)->delete();
        return back();
    }
}
