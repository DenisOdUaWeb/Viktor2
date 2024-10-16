<?php

use App\Models\Company;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');//same as describe

Artisan::command("app-commands:clean", function(){
    $this->info('Cleaning in procces ;\)  !');
    //dd(Company::whereDoesntHave('customers')->get());
    Company::whereDoesntHave('customers')->
    get()->
    each(function($company){
        $company->delete();

        $this->warn('Deleted: '.$company->name.' !');
    });
 })->describe('Cleans up unused companies');//same as purpose