<?php

namespace App\Http\Controllers\Api\Admin\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\StoreBannerRequest;
use App\Http\Requests\Admin\Banner\UpdateBannerRequest;
use App\Http\Resources\Admin\Banner\BannerIndexResource;
use App\Models\Banner;
use App\Support\FileUploader;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banners =  Banner::query()
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where('title_ar', 'like', '%' . $request->search . '%')
                    ->orWhere('title_en', 'like', '%' . $request->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $this->respondResource(BannerIndexResource::collection($banners));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = (new FileUploader())->save($request->file('image'), 'banners');
        }
        $banner = Banner::create($data);
        return $this->respondResource(new BannerIndexResource($banner));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        //
        $banner = Banner::findOrFail($id);
        return $this->respondResource(new BannerIndexResource($banner));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, string $id)
    {
        $data = $request->validated();
        $banner = Banner::findOrFail($id);

        if ($request->hasFile('image')) {
            $data['image'] = (new FileUploader())->save($request->file('image'), 'banners');
        }
        $banner->update($data);
        return $this->respondResource(new BannerIndexResource($banner));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $banner = Banner::findOrFail($id);
        $banner->delete();
        return $this->respondWithSuccess('Banner deleted successfully');
    }
}
