<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Throwable;
use DB;

class ResourceController extends Controller
{
    protected $moduleId;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function formValidationRequest()
    {
        return '';
    }

    public function defaultRequest()
    {
        return 'Illuminate\Http\Request';
    }

    public function viewFolder()
    {
        return '';
    }

    public function moduleName()
    {
        return '';
    }

    public function indexUrl()
    {
        return env('SYSTEM_PREFIX', '/system') . '/' .  $this->moduleName();
    }


    public function renderView($viewFile, $data)
    {
        $data['indexUrl'] = $this->indexUrl();
        $data['title'] = $data['title'] ?? $this->moduleName() ?? 'Your title is missing.';
        if (isset($data['items'])) {
            $data[$this->moduleName()] = $data['items'];
            unset($data['items']);
        }
        if (isset($data['item'])) {
            $data[$this->moduleName()] = $data['item'];
            unset($data['item']);
        }
        return view($this->viewFolder() . '.' . $viewFile, $data)->render();
    }

    /**
     * Show a list of all resources.
     * GET resources.
     */
    public function index(Request $request)
    {
        try {
            $data = $this->service->indexPageData($request);
            return $this->renderView('index', $data);
        } catch (Throwable $throwable) {
            return redirect()->back()->withErrors(['alert-danger' => 'Server error.'])->withInput($request->all());
        }
    }

    /**
     * Render a form to be used for creating a new resource.
     * GET resources/create.
     */
    public function create()
    {
        $request = $this->defaultRequest();
        $request = app()->make($request);
        try {
            $data = $this->service->createPageData($request);
            $data['title'] = 'Add ' . $this->moduleName();
            return $this->renderView('create', $data);
        } catch (Throwable $throwable) {
            return redirect()->back()->withErrors(['alert-danger' => 'Server error.']);
        }
    }

    /**
     * Create/save a new resource.
     * POST resources.
     */
    public function store()
    {
        if (!empty($this->formValidationRequest())) {
            $request = $this->formValidationRequest();
        } else {
            $request = $this->defaultRequest();
        }
        $request = app()->make($request);
        try {
            $this->service->store($request);
            return redirect($this->indexUrl())->withErrors(['alert-success' => 'Successfully created.']);
        } catch (Throwable $throwable) {
            return redirect()->back()->withInput($request->all())->withErrors(['alert-danger' => 'Server error.']);
        }
    }

    /**
     * Render a form to update an existing resource.
     * GET resources/:id/edit.
     */
    public function edit($id)
    {
        $request = $this->defaultRequest();
        $request = app()->make($request);
        try {
            $data = $this->service->editPageData($request, $id);
            return $this->renderView('edit', $data);
        } catch (Throwable $throwable) {
            return redirect()->back()->withErrors(['alert-danger' => 'Server error.']);
        }
    }

    public function show($id)
    {
        try {
            $data['user'] = $this->service->itemByIdentifier($id);
            $data['title'] = $this->moduleName() . ' Detail';
            return $this->renderView('show', $data);
        } catch (Throwable $throwable) {
            return redirect($this->getUrl())->withErrors(['alert-danger' => 'Server error.']);
        }
    }

    /**
     * Update resource details.
     * PUT or PATCH resources/:id.
     */
    public function update($id)
    {
        if (!empty($this->formValidationRequest())) {
            $request = $this->formValidationRequest();
        } else {
            $request = $this->defaultRequest();
        }
        $request = app()->make($request);
        try {
            $this->service->update($request, $id);
            return redirect($this->indexUrl())->withErrors(['alert-success' => 'Successfully updated.']);
        } catch (Throwable $throwable) {
            return redirect()->back()->withErrors(['alert-danger' => 'Server error.']);
        }
    }

    /**
     * Delete a resource with id.
     * DELETE resources/:id.
     */
    public function destroy($id)
    {
        try {
            $request = app()->make($this->defaultRequest());
            $userDeleteResponse = $this->service->delete($request, $id);
            if (isset($userDeleteResponse['alert-danger'])) {
                return redirect($this->indexUrl())->withErrors(['alert-danger' => $userDeleteResponse['alert-danger']]);
            }
            return redirect($this->indexUrl())->withErrors(['alert-success' => 'Successfully deleted.']);
        } catch (Throwable $throwable) {
            return redirect()->back()->withErrors(['alert-danger' => 'Delete failed.']);
        }
    }
}
