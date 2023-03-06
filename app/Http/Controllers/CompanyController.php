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
     * Display a listing of companies
     */
    public function index()
    {
        $model = $this->model->paginate(10);
        return view('companies.index', [
            'model' => $model
        ]);
    }

    /**
     * Show the form for creating a company.
     */
    public function create()
    {
        return view('companies.form');
    }

    /**
     * Store a newly created company
     */
    public function store(CompanyRequest $request)
    {
        if ($request->hasFile('file')) {
            $request['logo'] = $this->fileService->upload($request->file);
        }
        $this->model->create($request->all());
        return redirect()->route('companies.index')->with('message', 'Record added successfully');
    }

    /**
     * Display the specified company.
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
     * Show the form for editing the specified company.
     */
    public function edit(string $id)
    {
        $model = $this->model->find($id);
        if(!$model)
        {
            abort(404);
        }
        return view('companies.form',compact('model'));
    }

    /**
     * Update the specified company in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = $this->model->find($id);
        $model->update($request->all());
        return redirect()->route('companies.index')->with('message', 'Record updated successfully');

    }

    /**
     * Remove the specified company from storage.
     */
    public function destroy(string $id)
    {
        $model = $this->model->findorFail($id);
        unlink($model->storage_path);
        $model->delete();
        return redirect()->route('companies.index')->with('message', 'Company deleted successfully.');
    }
}
