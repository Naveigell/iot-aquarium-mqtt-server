<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = ['temperature', 'ph'];

    /**
     * Generates a single random data entry by calling the singleRandomData method and then creating a new record with it.
     */
    public function createSingleRandomDataFromLatestDate()
    {
        $latest = Detail::latest()->first();

        $data = $this->singleRandomData();
        $data['created_at'] = $latest->created_at->addSeconds(5)->toDateTimeString();
        $data['updated_at'] = $latest->updated_at->addSeconds(5)->toDateTimeString();

        return Detail::insert($data);
    }

    /**
     * Generates a random set of data including temperature, ph level, created_at, and updated_at timestamps.
     *
     * @return array The randomly generated data set.
     */
    public function singleRandomData()
    {
        return [
            'temperature' => round($this->randomFloat() * 20, 2),
            'ph'          => round($this->randomFloat() * 20, 2),
            'created_at'  => now()->toDateTimeString(),
            'updated_at'  => now()->toDateTimeString(),
        ];
    }

    /**
     * Generates a random float value between 0.1 and 1.
     *
     * @return float The randomly generated float value.
     */
    private function randomFloat()
    {
        $value = (float) rand() / (float) getrandmax();

        // don't give numbers less than 0.1
        return max(0.1 , $value);
    }
}
