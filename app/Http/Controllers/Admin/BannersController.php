<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $banners = Banner::all();


        return view('admin.widgets.banners.banners', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.widgets.banners.newBanner');
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

        $image->move(public_path('/images/banners'), $image_name);

        $banner_created = Banner::create([
            'title' => $request->title,
            'paragraph' => $request->paragraph,
            'button' => $request->button,
            'link' => $request->link,
            'image_name' => $image_name,
            'type' => $request->type,
        ]);

        if ($banner_created) {

            return ['success' => 'Banner sauvgarder avec succès.'];
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
        $banner = Banner::where('id', $id)->first();

        return view('admin.widgets.banners.newBanner', compact('banner'));
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

            $image->move(public_path('/images/banners'), $image_name);


            $old_image_name = Banner::where('id', $id)->pluck('image_name');

            if (File::exists(public_path("/images/banners/" . $old_image_name[0]))) {

                File::delete(public_path("images/banners/" . $old_image_name[0]));
            }


            $banner_updated = Banner::where('id', $id)->update(
                [
                    'title' => $request->title,
                    'paragraph' => $request->paragraph,
                    'button' => $request->button,
                    'link' => $request->link,
                    'image_name' => $image_name,
                    'type' => $request->type,
                ]
            );
        } else {

            $banner_updated = banner::where('id', $id)->update(
                [
                    'title' => $request->title,
                    'paragraph' => $request->paragraph,
                    'button' => $request->button,
                    'link' => $request->link,
                    'type' => $request->type,
                ]
            );
        }

        if ($banner_updated) {
            return ['success' => 'Mise à jour du Banner avec succès.'];
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
        $banner_deleted = Banner::where('id', $id)->delete();


        if ($banner_deleted) {
            return ['success' => 'Un Banner a été supprimer avec succès.'];
        } else {

            return ['error' => "Échec de la suppression, réessayer plus tard!"];
        }
    }
}
