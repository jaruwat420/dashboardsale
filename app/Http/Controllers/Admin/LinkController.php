<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\LinksDataTable;
use App\Models\Links;
use App\Http\Requests\Admin\LinkUpdateRequest;

class LinkController extends Controller
{
    // Index
    public function index (LinksDataTable $dataTable) {
        return $dataTable->render('admin.link.index');
    }

    // Link Create
    public function linkCreate(Request $request) {
        try {
            $linkUrl = $request->link_url;
            $link = new Links();
            $link->url = $linkUrl;
            $link->status = 1;
            $link->save();

            return response(['status' => 'success', 'message' => 'Create Links Successfully.']);
        } catch (\exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Get DataTable
    public function getLink (Request $request) {
        $link = Links::all();
        return response(['status' => 'success', 'message' => 'Get Links Successfully.', 'data' => $link]);
    }

    // Link Edit
    public function linkEdit (Request $request, $id) {
        $link = Links::findOrFail($id);
        return view ('admin.link.edit', compact('link'));
    }

    // Link Update
    public function linkUpdate (LinkUpdateRequest $request, $id) {

        $link = Links::findOrFail($id);
        $link->url = $request->link_url;
        $link->status = $request->status;
        $link->save();

        toastr('Update Link Successfully.', 'success');
        return to_route('admin.link');
    }

    // Link Destroy
    public function linkDestroy (Request $request, $id) {
        try {
            $link = Links::findOrFail($id);
            $link->delete();

            return response(['status' => 'success', 'message' => 'Delete Link Successfully.']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }

    }
}
