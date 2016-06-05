<?php

use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0; $i<10; $i++) {
            $invoiceId = DB::table('invoices')->insertGetId([
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            for($items=0; $items<rand(1,4); $items++) {
                DB::table('invoice_items')->insert([
                    'invoice_id' => $invoiceId,
                    'description' => $faker->sentence(4),
                    'price' => round(rand(10, 1000), 2),
                    'quantity' => round(rand(1, 5)),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
