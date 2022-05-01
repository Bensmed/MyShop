<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Settings::where('id', 1)->first();

        return view('admin.settings.settings', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('ss');
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
        //
    }

    public function saveGeneralSettings(Request $request)
    {

        $general_settings_updated = Settings::where('id', 1)->update(
            [
                'website_title' => $request->title,
                'email' => $request->email,
                'address' => $request->address,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'website_description' => $request->description,
            ]
        );

        if ($general_settings_updated) {
            return ['success' => 'Mise à jour avec succès.'];
        } else {

            return ['error' => "Échec de la mise à jour, réessayer plus tard!"];
        }
    }

    public function saveSocialSettings(Request $request)
    {

        $social_settings_updated = Settings::where('id', 1)->update(
            [
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,

            ]
        );

        if ($social_settings_updated) {
            return ['success' => 'Mise à jour avec succès.'];
        } else {

            return ['error' => "Échec de la mise à jour, réessayer plus tard!"];
        }
    }


    public function saveMoreSettings(Request $request)
    {

        $more_settings_updated = Settings::where('id', 1)->update(
            [
                'currency' => $request->currency,
                'facebook_pixel' => $request->facebook_pixel,
            ]
        );

        if ($more_settings_updated) {
            return ['success' => 'Mise à jour avec succès.'];
        } else {

            return ['error' => "Échec de la mise à jour, réessayer plus tard!"];
        }
    }

    public function saveColorsSettings(Request $request)
    {
        $colors_updated = Settings::where('id', 1)->update(
            [
                'primary_color' => $request->primary,
                'hover_color' => $request->hover,
                'transparent_color' => $request->transparent,
            ]
        );


        if ($colors_updated) {
            return ['success' => 'Mise à jour avec succès.'];
        } else {

            return ['error' => "Échec de la mise à jour, réessayer plus tard!"];
        }
    }

    public function saveLogoSettings(Request $request)
    {

        $logo_updated = $favicon_updated = false;

        if ($request->logo_changed) {
            $this->validate($request, [
                'logo' => 'required|image|mimes:jpeg,png,jpg,svg'
            ]);

            $image = request()->file('logo');
            $logo_name = $image->getClientOriginalName();
            $logo_name = time() . '_' . $logo_name;

            $image->move(public_path('/images/Logo'), $logo_name);

            $old_logo_name = Settings::where('id', 1)->pluck('logo');

            if (File::exists(public_path("/images/Logo/" . $old_logo_name[0]))) {

                File::delete(public_path("/images/Logo/" . $old_logo_name[0]));
            }

            $logo_updated = Settings::where('id', 1)->update(
                [
                    'logo' => $logo_name,
                ]
            );
        }

        if ($request->favicon_changed) {
            $this->validate($request, [
                'favicon' => 'required|image|mimes:jpeg,png,jpg,svg'
            ]);

            $image = request()->file('favicon');
            $favicon_name = $image->getClientOriginalName();
            $favicon_name = time() . '_' . $favicon_name;

            $image->move(public_path('/images/Logo'), $favicon_name);

            $old_favicon_name = Settings::where('id', 1)->pluck('logo');

            if (File::exists(public_path("/images/Logo/" . $old_favicon_name[0]))) {

                File::delete(public_path("/images/Logo/" . $old_favicon_name[0]));
            }

            $favicon_updated = Settings::where('id', 1)->update(
                [
                    'favicon' => $favicon_name,
                ]
            );
        }

        if ($logo_updated !== false || $favicon_updated !== false) {
            return ['success' => 'Mise à jour avec succès.'];
        } else {

            return ['error' => "Échec de la mise à jour, réessayer plus tard!"];
        }
    }

    public function getAboutEditor()
    {

        $coded_content = PageContent::where('page_name', 'about')->first()->content;

        $content = base64_decode($coded_content);

        return view('admin.others.about', compact('content'));
    }


    public function updateAboutPage(Request $request)
    {

        $encoded = base64_encode($request->content);

        $about_updated = PageContent::where('page_name', 'about')->update([
            'content' => $encoded
        ]);

        if ($about_updated) {
            return ['success' => 'Mise à jour avec succès.'];
        } else {
            return ['error' => "Échec de la mise à jour, réessayer plus tard!"];
        }
    }


    public function getSecurityEditor()
    {

        $coded_content = PageContent::where('page_name', 'security')->first()->content;

        $content = base64_decode($coded_content);

        return view('admin.others.security', compact('content'));
    }


    public function updateSecurityPage(Request $request)
    {

        $encoded = base64_encode($request->content);

        $security_updated = PageContent::where('page_name', 'security')->update([
            'content' => $encoded
        ]);

        if ($security_updated) {
            return ['success' => 'Mise à jour avec succès.'];
        } else {
            return ['error' => "Échec de la mise à jour, réessayer plus tard!"];
        }
    }
}
