<?php

namespace App\Http\Controllers;

use App\Models\Regions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegionsController extends Controller
{
    public function getRegions(Request $request)
    {
        return view('regions_list', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }

    public function getRegionsList()
    {
        return response()->json([
            'regions' => Regions::all(),
        ]);
    }

    public function getRegionsAdd(Request $request)
    {
        return view('regions_add', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
        ]);
    }

    public function postRegionsAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'regionName' => 'required|unique:regions,regionName',
            'staticURL' => 'required|unique:regions,staticURL',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        Regions::create([
            'regionName' => $request->regionName,
            'staticURL' => Str::slug($request->staticURL),
        ]);
        return redirect()->route('regions.page');
    }

    public function getRegionsView(Request $request, $staticURL)
    {
        $region = Regions::where('staticURL', $staticURL)->first();
        if (!$region)
        {
            abort(404);
        }
        return view('regions_view', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
            'regionName' => $region->regionName,
            'staticURL' => $region->staticURL,
        ]);
    }

    public function patchRegionsUpdate(Request $request, $staticURL)
    {
        $validator = Validator::make($request->all(), [
            'regionName' => 'required|unique:regions,regionName',
            'staticURL' => 'required|unique:regions,staticURL',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $region = Regions::where('staticURL', $staticURL)->first();
        if (!$region)
        {
            abort(404);
        }
        $region->update([
            'regionName' => $request->regionName,
            'staticURL' => Str::slug($request->staticURL),
        ]);
        return redirect()->route('regions.page');
    }

    public function deleteRegionsDelete($staticURL)
    {
        $region = Regions::where('staticURL', $staticURL)->first();
        if (!$region)
        {
            return response()->json([
                'message' => $staticURL . ' not found'
            ], 404);
        }
        $region->delete();
        return response()->json([
            'message' => 'Delete successfully'
        ]);
    }
}
