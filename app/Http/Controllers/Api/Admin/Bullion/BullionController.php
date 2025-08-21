<?php

namespace App\Http\Controllers\Api\Admin\Bullion;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Visit;
use App\Models\Bullion;
use App\Models\Currency;
use App\Models\GoldPrice;
use App\Models\BullionPrice;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Models\CurrencyPrice;
use App\Support\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gold\UpdateGoldRequest;
use App\Http\Requests\Admin\Visit\StoreVisitRequest;
use App\Http\Resources\Admin\Gold\GoldIndexResource;
use App\Http\Requests\Admin\Visit\UpdateVisitRequest;
use App\Http\Resources\Admin\Visit\VisitShowResource;
use App\Http\Resources\Admin\Visit\VisitIndexResource;
use App\Http\Requests\Admin\Bullion\UpdateBullionRequest;
use App\Http\Resources\Admin\Bullion\BullionIndexResource;
use App\Http\Requests\Admin\Currency\UpdateCurrencyRequest;
use App\Http\Resources\Admin\Currency\CurrencyIndexResource;

class BullionController extends Controller
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $base_currency_id = 3;
        $bullions = BullionPrice::where('currency_id', $base_currency_id)->get();
        return $this->respondResource(BullionIndexResource::collection($bullions));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreVisitRequest $request)
    // {
    //     $data = $request->except(['images', 'name', 'phone']);
    //     // dd($data);
    //     $data['day'] = Carbon::parse($request->date_time)->toDateString();
    //     $data['time'] = Carbon::parse($request->date_time)->format('H:i:s');

    //     $user = User::where('phone', $request->phone)->first();
    //     if (!$user) {
    //         $user = User::create([
    //             'name' => $request->name,
    //             'phone' => $request->phone,
    //         ]);
    //     }
    //     $data['user_id'] = $user->id;

    //     $new_visit = Visit::create($data);

    //     if ($request->hasFile('images')) {
    //         foreach ($request->images as $image) {
    //             $newImage = (new FileUploader())->save($image, 'visits');
    //             // dd($newImage);
    //             $new_visit->files()->create([
    //                 'file_path' => $newImage,
    //                 'user_id' => $user->id,

    //             ]);
    //         }
    //     }

    //     return $this->respondResource(
    //         new VisitIndexResource($new_visit->load(['files'])),
    //         ['message' => 'Visit created successfully']
    //     );
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->respondResource(new BullionIndexResource(BullionPrice::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBullionRequest $request, string $id)
    {

        // dd($request->all());
        $bullion = BullionPrice::findOrFail($id);

        $main_bullion = Bullion::findOrFail($bullion->bullion_id);

        $data = $request->except(['icon','percentage_increase']);

        if ($request->hasFile('icon')) {
            $image = (new FileUploader())->save($request->icon, 'bullions');
        }
        $main_bullion->update([
                'icon' => $image ?? $main_bullion->icon,
                'percentage_increase'=> $request->percentage_increase ? $request->percentage_increase :  $main_bullion->percentage_increase,
        ]);
        $bullion->update($data);

        return $this->respondResource(new BullionIndexResource($bullion));
    }

    /**
     * Remove the specified resource from storage.
     */
}
