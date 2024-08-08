<?php

namespace Tests\Unit;

use App\Models\HolidayPlan;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HolidayPlanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_a_holiday_plan()
    {
        $data = [
            'title' => 'Beach Vacation',
            'description' => 'A fun trip to the beach.',
            'date' => '2024-08-15',
            'location' => 'Miami, FL',
            'participants' => json_encode(['John Doe', 'Jane Doe']),
        ];

        $holidayPlan = HolidayPlan::query()->create($data);

        $this->assertDatabaseHas('holiday_plans', $data);
        $this->assertEquals('Beach Vacation', $holidayPlan['title']);
        $this->assertEquals('A fun trip to the beach.', $holidayPlan['description']);
    }

    /** @test */
    public function update_a_holiday_plan()
    {
        $holidayPlan = HolidayPlan::query()->create([
            'title' => 'Beach Vacation',
            'description' => 'A fun trip to the beach.',
            'date' => '2024-08-15',
            'location' => 'Miami, FL',
            'participants' => ['John Doe', 'Jane Doe']
        ]);

        $holidayPlan->update([
            'title' => 'Mountain Retreat',
            'location' => 'Aspen, CO',
        ]);

        $this->assertDatabaseHas('holiday_plans', [
            'title' => 'Mountain Retreat',
            'location' => 'Aspen, CO',
        ]);
    }

    public function delete_a_holiday_plan(){
        $holidayPlan = HolidayPlan::query()->create();

        $holidayPlan->delete();

        $this->assertDeleted($holidayPlan);
    }

    /** @test */
    public function requires_a_valid_date_format()
    {
        $this->expectException(QueryException::class);

        HolidayPlan::query()->create([
            'title' => 'Invalid Date Test',
            'description' => 'Testing date validation.',
            'date' => 'invalid-date',
            'location' => 'Unknown',
        ]);
    }

}
