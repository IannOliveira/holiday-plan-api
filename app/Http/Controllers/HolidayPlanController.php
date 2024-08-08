<?php

namespace App\Http\Controllers;

use App\Exceptions\IdNaoEncontradoException;
use App\Http\Requests\HolidayPlanRequest;
use App\Http\Resources\HolidayPlanResource;
use App\Models\HolidayPlan;
use Barryvdh\DomPDF\Facade\Pdf;

class HolidayPlanController extends Controller
{
    public function register(HolidayPlanRequest $request){

        $input = $request->validated();

        $holidayPlan = HolidayPlan::query()->create($input);

        return new HolidayPlanResource($holidayPlan);
    }

    public function index(){
        $holidayPlans = HolidayPlan::query()->paginate(10);
        return HolidayPlanResource::collection($holidayPlans);
    }

    public function show($id){
        $holidayPlan = HolidayPlan::query()->find($id);

        if(!$holidayPlan) {
            throw new IdNaoEncontradoException();
        }

        return new HolidayPlanResource($holidayPlan);
    }

    public function update(HolidayPlanRequest $request, $id){
        $holidayPlan = HolidayPlan::query()->find($id);

        $input = $request->validated();

        if(!$holidayPlan) {
            throw new IdNaoEncontradoException();
        }

        $holidayPlan->fill($input);
        $holidayPlan->save();

        return new HolidayPlanResource($holidayPlan->fresh());
    }

    public function destroy($id){
        $holidayPlan = HolidayPlan::query()->where('id', $id);
        $holidayPlan->delete();

        return response()->json(null, 204);
    }

    public function generatePDF($id){
        $holidayPlan = HolidayPlan::query()->find($id);

        if(!$holidayPlan) {
            throw new IdNaoEncontradoException();
        }

        $pdf = Pdf::loadView('pdf.holidayPlan', compact('holidayPlan'));

        return $pdf->download('holiday_plan.pdf');
    }

}
