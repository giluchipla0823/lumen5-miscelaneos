<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DatatablesHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DemoController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function index()
    {
        $collection = collect([
            [
                'id' => 1,
                'name' => 'Gino Luiggi'
            ],
            [
                'id' => 2,
                'name' => 'Juan Carlos'
            ]
        ]);

        $json = DataTables::of($collection)->make();

        return $this->successResponse(DatatablesHelper::makeResponse($json));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

}
