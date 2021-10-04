<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    private const PATH = 'admin.banner.';

    public function index() {
        return view(self::PATH . 'index');
    }

    public function edit(Banner $banner) {
        return view(self::PATH . 'edit', ['banner' => $banner]);
    }

    public function create() {
        return view(self::PATH . 'create');
    }

    public function store(Request $request) {
        // dd($request->hasFile('banner_image'));
        $request->validate([
            'banner_image' => 'required|mimes:jpg,png',
            'name' => 'required|string'
        ]);

        $path = storage_path('app/public');

        $image = $request->file('banner_image');

        $filename = uniqid() . '_' . trim($image->getClientOriginalName());

        $image->move($path, $filename);

        Banner::create([
            'name' => $request->name,
            'banner_path' => $filename,
            'is_viewable' => $request->is_viewable ?? false
        ]);

        Session::flash('success', 'Successfully Created Banner!');

        return redirect()->route('admin.banners.index');
    }

    public function update(Request $request, Banner $banner) {

        $banner->update([
            'is_viewable' => $request->is_viewable ?? false,
        ]);

        $request->session()->flash('success', 'Successfully Updated Banner Visibility.');

        return redirect()->route('admin.banners.index');
    }
}
