<?php

namespace App\Http\Controllers\Api\Admin\Currency;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Currency\UpdateCurrencyRequest;
use App\Http\Requests\Admin\Visit\StoreVisitRequest;
use App\Http\Requests\Admin\Visit\UpdateVisitRequest;
use App\Http\Resources\Admin\Currency\CurrencyIndexResource;
use App\Http\Resources\Admin\Visit\VisitIndexResource;
use App\Http\Resources\Admin\Visit\VisitShowResource;
use App\Models\Currency;
use App\Models\CurrencyPrice;
use App\Models\User;
use App\Models\Visit;
use App\Support\FileUploader;
use App\Traits\ApiResponder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $base_currency_id = 3;
        $currencies = CurrencyPrice::where('base_currency_id', $base_currency_id)->get();
        return $this->respondResource(CurrencyIndexResource::collection($currencies));
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
        return $this->respondResource(new CurrencyIndexResource(CurrencyPrice::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurrencyRequest $request, string $id)
    {

        $currency = CurrencyPrice::findOrFail($id);
        $data = $request->except('icon_target_currency');

        if ($request->hasFile('icon_target_currency')) {
            $image = (new FileUploader())->save($request->icon_target_currency, 'currencies');
            $currency->Target_currency->update([
                'icon' => $image
            ]);
        }
        $currency->update($data);
        return $this->respondResource(new CurrencyIndexResource($currency->fresh()));
    }

    /**
     * Remove the specified resource from storage.
     */
}
