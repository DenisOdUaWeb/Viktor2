<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;

class CreateCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app-commands:create-company {name}';//{phone=N/A} ; // OR {phone?} // it will make phone optional 
                                                            //BUT YOU NEED TO REMOVE IF FROM THE HANDLER (if phone optional)
    /**                                                     //if ($this->confirm(...
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating a new Company ("name" and "phone" (phone optional))';

    /**
     * Execute the console command.
     */
    public function handle() // we will make template of the new company and put it in the DB
    {
        // based on our Company Model

        $phone = $this->ask("What is th company phone number?");
        if ($this->confirm("are you sure the phone is .$phone. ?")){
            $company = Company::create([
                "name" => $this->argument('name'),
                'Phone' => $phone,
                ]
               
            );
        }
       
        $this->info("COMPANY WAS CREATED INFO INFO ");
        $this->warn("this is WARNING EXAMPLE");
        $this->error("This is an ERROR EXAMPLE ");

    }
}
