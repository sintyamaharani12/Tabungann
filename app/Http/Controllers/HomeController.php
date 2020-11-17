<?php

namespace App\Http\Controllers;

use App\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Alfa6661\AutoNumber\AutoNumberTrait;

class HomeController extends Controller
{

    public function index()
    {
       return view('tabungann.index');

    }
    public function create()
    {
        return view('tabungann.create');
    }
    public function store()
    {
        $activity = tabungann::create($this->validateRequest());
        $this->storeImage($tabungann);
        return redirect()->back()->with(['success' => 'Activity berhasil dibuat' ]);
    }
    private function validateRequest(){
        return tap(request()->validate([
            'Nama'          => 'required',
            'email'         =>  'required',
            'level'         =>  'required',
            'option'        =>  'required',

        ]), function(){
            if(request()->hasFIle('images')){
                request()->validate([
                    'images'  => 'file|image|max:5000',
                ]);
            }
        });
    }
    private function storeImage($activity){
        if(request()->has('images')){
            $activity->update([
                'images' => request()->images->store('uploads','public'),
            ]);
            $image = Image::make(public_path('storage/'. $tabungann->images))->fit(300,300,null, 'top-left');
            $image->save();
        }
    }
    public function edit($id)
    {
        $tabungan = tabungann::findOrFail($id);
        return view("backend.tabungann.edit", compact('tabungann'));
    }
    public function update(tabungann $tabungann)
    {
        $tabungann->update($this->validateRequest());
        $this->storeImage($tabungann);
        return redirect()->back()->with(['success' => 'berhasil diedit' ]);
    }
    public function destroy()
    {
        //
    }
}