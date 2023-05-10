<?php

namespace Database\Factories;

use App\Models\JournalEntry;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JournalEntry>
 */
class JournalEntryFactory extends Factory
{
    protected $model = JournalEntry::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => 1,
            'user_id' => function () {
                return User::all()->random()->id;
            },
            'entry' => $this->faker->paragraph(3),
            'created_at' => '2023-05-09 18:57:56',
            'updated_at' => '2023-05-09 18:57:56'
        ];
    }
}
