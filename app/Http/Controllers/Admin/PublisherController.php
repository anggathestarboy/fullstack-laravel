<?php

namespace App\Http\Controllers\Admin;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::paginate(5);

        return view('pages.admin.publisher', [
            'publishers' => $publishers
        ]);
    }

    public function store(PublisherRequest $request)
    {
        $data = [
            'publisher_name' => $request->input('publisher_name'),
            'publisher_description' => $request->input('publisher_description'),
        ];

        $operation = Publisher::create($data);

        if ($operation) {
            return redirect()->route('admin.publisher')->with('success', 'Successfully created publisher data');
        } else {
            return redirect()->route('admin.publisher')->with('error', 'Failed to create publisher data');
        }
    }

    public function update(PublisherRequest $request, string $publisher_id)
    {
        $data = [
            'publisher_name' => $request->input('publisher_name'),
            'publisher_description' => $request->input('publisher_description'),
        ];

        $operation = Publisher::where('publisher_id', $publisher_id)->update($data);

        if ($operation) {
            return redirect()->route('admin.publisher')->with('success', 'Successfully updated publisher data');
        } else {
            return redirect()->route('admin.publisher')->with('error', 'Failed to update publisher data');
        }
    }

    public function delete(string $publisher_id)
    {
        $operation = Publisher::where('publisher_id', $publisher_id)->delete();

        if ($operation) {
            return redirect()->route('admin.publisher')->with('success', 'Successfully deleted publisher data');
        } else {
            return redirect()->route('admin.publisher')->with('error', 'Failed to delete publisher data');
        }
    }
}
