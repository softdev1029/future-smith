<?php

use Illuminate\Database\Seeder;

class StripePlansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stripe_plans')->delete();
        
        \DB::table('stripe_plans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Tribe Leader - Paid after 1 month. One - Off',
                'stripe_id' => 'plan_DeCnck8D3v4yKw',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Tribe Member - Monthly',
                'stripe_id' => 'plan_DeCoJOUOzsz7sk',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Sponsorship',
                'stripe_id' => 'plan_DeCp72cxYGrx9Y',
            ),
        ));
        
        
    }
}