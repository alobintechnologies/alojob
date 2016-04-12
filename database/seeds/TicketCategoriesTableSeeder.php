<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\TicketCategory;

class TicketCategoriesTableSeeder extends Seeder {

    public function run()
    {
        $categories = ['Uncategorized', 'General', 'Support', 'Sales', 'Issue', 'Task'];

        foreach ($categories as $category) {
            TicketCategory::create(['title' => $category, 'account_id' => 1]);
        }
    }

}
