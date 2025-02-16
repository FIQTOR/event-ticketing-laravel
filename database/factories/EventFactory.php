<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * EventFactory is a factory class for creating instances of the Event model.
 * It extends the base Factory class provided by Laravel.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = \App\Models\Event::class;

    /**
     * Define the model's default state.
     *
     * This method returns an array of default values for the Event model's attributes.
     * The attributes include:
     * - title: A random sentence with 3 words.
     * - description: A random paragraph of text.
     * - address: A random address.
     * - organizer: A random sentence with 1 word, representing the organizer's name.
     * - price: A random integer between 10,000 and 100,000, representing the event's price.
     * - event_date: A random date between now and one year in the future, formatted as 'Y-m-d'.
     * - layouts: A JSON-encoded string representing the layout categories for the event.
     * - thumbnail: A random image URL with specified dimensions (600x200).
     *
     * @return array The default state for the Event model.
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'address' => $this->faker->address,
            'organizer' => $this->faker->sentence(1),
            'price' => $this->faker->numberBetween(10000, 100000),
            'event_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'layouts' => '["cat 1", "cat 2"]',
            'thumbnail' => $this->faker->imageUrl(600, 200),
        ];
    }
}
