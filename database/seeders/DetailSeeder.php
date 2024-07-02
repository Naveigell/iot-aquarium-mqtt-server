<?php

namespace Database\Seeders;

use App\Models\Detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = now();

        // generate a big list of details, each with 1000 items
        foreach (range(1, 50) as $_) {
            $details = [];

            foreach (range(1, 1000) as $item) {
                $seconds = $date->addSeconds(5)->format('Y-m-d H:i:s');

                $details[] = [
                    "temperature" => round($this->randomFloat() * 20, 2),
                    "ph"          => round($this->randomFloat() * 14, 2),
                    "created_at"  => $seconds,
                    "updated_at"  => $seconds,
                ];
            }

            // insert the list of details
            Detail::insert($details);
        }
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
