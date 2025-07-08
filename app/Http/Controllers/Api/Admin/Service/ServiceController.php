<?php

namespace App\Http\Controllers\Api\Admin\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\StoreServiceRequest;
use App\Http\Requests\Admin\Service\UpdateServiceRequest;
use App\Http\Resources\Admin\ServiceIndexResource;
use App\Http\Resources\Admin\ServiceShowResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::query()
            ->when(request()->has('search'), function ($query) {
                $query->where('name_ar', 'like', '%' . request()->search . '%')
                    ->orWhere('name_en', 'like', '%' . request()->search . '%')
                    ->orWhere('short_desc_ar', 'like', '%' . request()->search . '%')
                    ->orWhere('short_desc_en', 'like', '%' . request()->search . '%')
                    ->orWhere('long_desc_ar', 'like', '%' . request()->search . '%')
                    ->orWhere('long_desc_en', 'like', '%' . request()->search . '%');

            })
            ->paginate(10);

        return $this->respondResource(ServiceIndexResource::collection($services));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $request->validated();

        $data = $request->except(['main_image', 'interior_image']);
        $data['main_image'] = (new \App\Support\FileUploader())->save($request->file('main_image'), 'services');
        $data['interior_image'] = (new \App\Support\FileUploader())->save($request->file('interior_image'), 'services');

        $service = Service::create($data);

        return $this->respondResource(new ServiceShowResource($service));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $service = Service::findOrFail($id);
        return $this->respondResource(new ServiceShowResource($service));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, string $id)
    {

        $service = Service::findOrFail($id);
        $data = $request->except(['main_image', 'interior_image']);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = (new \App\Support\FileUploader())->save($request->file('main_image'), 'services');
        }

        if ($request->hasFile('interior_image')) {
            $data['interior_image'] = (new \App\Support\FileUploader())->save($request->file('interior_image'), 'services');
        }

        $service->update($data);

        return $this->respondResource(new ServiceShowResource($service));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return $this->respondWithSuccess('Service deleted successfully');
    }
    public function restore (string $id)
    {
        $service = Service::withTrashed()->findOrFail($id);
        $service->restore();
        return $this->respondWithSuccess('Service restored successfully');
    }

    public function trashed()
    {
        $trashedServices = Service::onlyTrashed()->paginate(10);
        return $this->respondResource(ServiceIndexResource::collection($trashedServices));
    }
}
