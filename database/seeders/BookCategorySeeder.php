<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Ausgaben
            ['name' => 'Lebensmittel', 'type' => 'expense', 'description' => 'Einkäufe, Restaurants, etc.'],
            ['name' => 'Wohnen', 'type' => 'expense', 'description' => 'Miete, Strom, Wasser, etc.'],
            ['name' => 'Transport', 'type' => 'expense', 'description' => 'Öffentlicher Verkehr, Auto, etc.'],
            ['name' => 'Freizeit', 'type' => 'expense', 'description' => 'Hobbys, Unterhaltung, etc.'],
            ['name' => 'Gesundheit', 'type' => 'expense', 'description' => 'Medikamente, Arztbesuche, etc.'],
            ['name' => 'Kleidung', 'type' => 'expense', 'description' => 'Kleidung, Schuhe, etc.'],
            ['name' => 'Kinder', 'type' => 'expense', 'description' => 'Schule, Spielzeug, etc.'],
            ['name' => 'Sonstiges', 'type' => 'expense', 'description' => 'Andere Ausgaben'],
            
            // Einnahmen
            ['name' => 'Gehalt', 'type' => 'income', 'description' => 'Haupteinkommen'],
            ['name' => 'Nebenjob', 'type' => 'income', 'description' => 'Zusätzliches Einkommen'],
            ['name' => 'Geschenke', 'type' => 'income', 'description' => 'Erhaltene Geschenke'],
            ['name' => 'Sonstiges', 'type' => 'income', 'description' => 'Andere Einnahmen'],
        ];

        foreach ($categories as $category) {
            BookCategory::create($category);
        }
    }
}