<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\app\Models\ContactEntry;

/**
 * @phpstan-ignore-next-line
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Blog\app\Models\ContactEntry>
 */
class ContactEntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<ContactEntry>
     */
    protected $model = ContactEntry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        ];
    }
}
