<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();


        return view('admin.widgets.sliders.sliders', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.widgets.sliders.newSlider');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,svg'
        ]);

        $image = request()->file('image');
        $image_name = $image->getClientOriginalName();
        $image_name = time() . '_' . $image_name;

        $image->move(public_path('/images/sliders'), $image_name);

        $slider_created = Slider::create([
            'title' => $request->title,
            'paragraph' => $request->paragraph,
            'badge' => $request->badge,
            'button' => $request->button,
            'link' => $request->link,
            'image_name' => $image_name,
        ]);

        if ($slider_created) {

            return ['success' => 'Slider sauvgarder avec succès.'];
        } else {

            return ['error' => "Échec de l'enregistrement, réessayer plus tard!"];
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
        $slider = Slider::where('id', $id)->first();

        return view('admin.widgets.sliders.newSlider', compact('slider'));
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
        if ($request->image_changed == 1) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,svg'
            ]);

            $image = request()->file('image');
            $image_name = $image->getClientOriginalName();
            $image_name = time() . '_' . $image_name;

            $image->move(public_path('/images/sliders'), $image_name);


            $old_image_name = Slider::where('id', $id)->pluck('image_name');

            if (File::exists(public_path("/images/sliders/" . $old_image_name[0]))) {

                File::delete(public_path("images/sliders/" . $old_image_name[0]));
            }


            $slider_updated = Slider::where('id', $id)->update(
                [
                    'title' => $request->title,
                    'paragraph' => $request->paragraph,
                    'badge' => $request->badge,
                    'button' => $request->button,
                    'link' => $request->link,
                    'image_name' => $image_name,
                ]
            );
        } else {

            $slider_updated = Slider::where('id', $id)->update(
                [
                    'title' => $request->title,
                    'paragraph' => $request->paragraph,
                    'badge' => $request->badge,
                    'button' => $request->button,
                    'link' => $request->link,
                ]
            );
        }

        if ($slider_updated) {
            return ['success' => 'Mise à jour du Slider avec succès.'];
        } else {

            return ['error' => "Échec de la mise à jour, réessayer plus tard!"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd("ss");
        $slider_deleted = Slider::where('id', $id)->delete();


        if ($slider_deleted) {
            return ['success' => 'Un Slider a été supprimer avec succès.'];
        } else {

            return ['error' => "Échec de la suppression, réessayer plus tard!"];
        }
    }
}
