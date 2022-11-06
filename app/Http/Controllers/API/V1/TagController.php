<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    protected $service = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Service $service)
    {
        $this->middleware('auth:api');
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->service->latest()->paginate(10);

        return $this->sendResponse($tags, 'Tags list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $tags = $this->service->get(['name', 'id']);

        return $this->sendResponse($tags, 'Tags list');
    }


    /**
     * Store a newly created resource in storage.
     *
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $service = $this->service->create([
            'name' => $request->get('name')
        ]);

        return $this->sendResponse($service, 'Service Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $service = $this->service->findOrFail($id);

        $service->update($request->all());

        return $this->sendResponse($service, 'Service Information has been updated');
    }
}
