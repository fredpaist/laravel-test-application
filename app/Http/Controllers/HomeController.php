<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitorRequest;
use App\Sectors;
use App\Visitor;

class HomeController extends Controller
{
    public function home()
    {
        $data_id = session()->get('saved_id');
        $data = Visitor::find($data_id);

        $sectors = Sectors::with('children')
            ->where('parent_id', NULL)
            ->get();

        $selected = $data ? $data->sectors()->pluck('sector_id')->toArray() : [];
        $sectorsOuput = Sectors::getSectorOutputs($sectors, $selected);

        return view('home')
            ->with('sectors', $sectorsOuput)
            ->with('saved', $data);
    }

    public function save(VisitorRequest $request)
    {
        $request->processRequest();
        return redirect()->back();
    }
}
