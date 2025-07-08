<?php

namespace App\Http\Controllers\Api\Admin\Gold;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Visit;
use App\Models\Currency;
use App\Models\GoldPrice;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Models\CurrencyPrice;
use App\Support\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Visit\StoreVisitRequest;
use App\Http\Resources\Admin\Gold\GoldIndexResource;
use App\Http\Requests\Admin\Visit\UpdateVisitRequest;
use App\Http\Resources\Admin\Visit\VisitShowResource;
use App\Http\Resources\Admin\Visit\VisitIndexResource;
use App\Http\Requests\Admin\Currency\UpdateCurrencyRequest;
use App\Http\Requests\Admin\Gold\UpdateGoldRequest;
use App\Http\Resources\Admin\Currency\CurrencyIndexResource;

class GoldController extends Controller
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $base_currency_id = 3;
        $golds = GoldPrice::where('currency_id', $base_currency_id)->get();
        return $this->respondResource(GoldIndexResource::collection($golds));
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
        return $this->respondResource(new GoldIndexResource(GoldPrice::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoldRequest $request, string $id)
    {

        $gold = GoldPrice::findOrFail($id);
        $data = $request->except('icon');

        if ($request->hasFile('icon')) {
            $image = (new FileUploader())->save($request->icon, 'golds');
            $gold->gold->update([
                'icon' => $image
            ]);
        }
        $gold->update($data);
        return $this->respondResource(new GoldIndexResource($gold->fresh()));
    }

    /**
     * Remove the specified resource from storage.
     */
}
