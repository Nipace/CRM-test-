<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    protected $model;

    protected $fileService;

    public function __construct(Company $model, FileService $fileService)
    {
        $this->model = $model;
        $this->fileService = $fileService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = $this->model->get();
        return view('companies.index', [
            'model' => $model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $request['logo'] = $this->fileService->upload($request->file);
        }
        $this->model->create($request->all());
        return redirect()->route('companies.index')->with('message', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = $this->model->find($id);

        if (!$model) {
            abort(404);
        }

        return view('companies.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = $this->model->find($id);
        if(!$model)
        {
            abort(404);
        }
        return view('companies.create',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = $this->model->find($id);
        $model->update($request->all());
        return redirect()->route('companies.index')->with('message', 'Record updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     * This method also shows example for route model binding
     */
    public function destroy(string $id)
    {
        $model = $this->model->findorFail($id);
        $model->delete();
        return redirect()->route('companies.index')->with('message', 'Company deleted successfully.');
    }
}
