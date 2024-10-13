<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;
//use App\Mail\WelcomeNewUserMail;
use Illuminate\Support\Facades\App;
//use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Events\NewCustomerHasRegistredEvent;

class CustomersController extends Controller
{
    public function __costruct()
    {
        $this->middleware('auth');
    }
    public function index() //Customer $customer not working (not that data, no name in view, only ID?)
    {
        // LANGUAGES TESTING 
        App::setLocale('en');  //use Illuminate\Support\Facades\App;

        $activeCustomers = Customer::active()->get(); // like this or -> with scope from Model 
        $inactiveCustomers = Customer::where('active', 0)->get(); // like this
        //dd($activeCustomers);
        //its optional -> we can use all or something like from above
        
        //$customers = Customer::all(); // instead of this better use bellow
        //select * from `companies` where `companies`.`id` = 1 limit 1
        //this will make LESS query (only ine if thehre is only one company)
        //select * from `companies` where `companies`.`id` in (1, 6, 7, 8, 9, 10) 
        //$customers = Customer::with('company')->get();//its making grouping query
        $customers = Customer::with('company')->paginate(15);//same but pagination 
        return view('customers/index', [
            'ourActiveCustomers' => $activeCustomers,
            'ourInactiveCustomers' => $inactiveCustomers,
            'customers' => $customers,

        ]);
    }

    public function create()
    {
        $companies = Company::all();
        $customer = new Customer();
        //$customer->active = '1';  // better to do it(set default value) inside Customer Model 

        return view('customers/create', [
            'companies' => $companies,
            'customer' => $customer,
        ]);

    }
    public function store()
    {
        //POLICY 
        $this->authorize('create', Customer::class); // authorize as Admin to add Customer 

        //$data = request()->validate([
            //'name' => 'required | min:3| max:50 ',
           // 'email' => 'required | email',
           // 'active' => 'required',
           // 'company_id' => 'required'
        //]);
        //instead of above // $this->validateRequest()
        //dd("customer->email");
        //$customer = new Customer();
        //$customer->name = request('name');
        //$customer->email = request('email'); //Customer::crate($data); //instead of all these lines
        //$customer->active = request('active');
        //$customer->save();
        // !!!! insted of (above) all these customer .... = request we can just use create method
        

        $customer = Customer::create($this->validateRequest());//NOT same asas below
        //$customer = new Customer();
        //$customer->create($this->validateRequest());
        $this->storeImage($customer); // if image (update customer )


           // $customer->update([
               // 'image2' => 'imagePath',
               // "name" => 'NAME asd',
                //'soething' => 'asdas',
            //]); 
            // EVENTS:
        event(new NewCustomerHasRegistredEvent($customer));

        //NewCustomerHasRegistredEvent::dispatch($customer);

        //sending welcome new user email
        //Mail::to($customer->email)->send(new WelcomeNewUserMail());
        //dd($customer->email);
        //echo something to the window (EVENT let say)
        //register to Newsletter
        //dump ('Register to newletter'); //we put it in listener (RegisterCustomerToNewsletter)
           
        //Slack notification to Admin (you v=can see it if redirect comited)
        //dump ('Slack message here');  //we put it in listener(NotifyAdminViaSlack)

        //return back();
        //dd(request('name'));
         //   dd('sdfsfd');
        //return redirect('customers');
    }

    public function show(Customer $customer, $slug)
    {
        //$customer = Customer::find($customer);   /// THIS NOT GOOD (WILL MAKE ERROR IF NOT FOUND) OR ->
        //$customer = Customer::where('id', $customer)->firstOrFail();  // OR THIS but better routes MOdel binding (Customer $customer)
        //dd($customer);
        return view('/customers/show',[
            'customer' => $customer,
            'slug' => $slug,
        ]);
    }

    public function edit(Customer $customer)
    {
        $companies = Company::all();
        return view('/customers/edit',[
            'customer' => $customer,
            'companies' => $companies,
        ]);
    }

    public function update(Customer $customer)
    {
        //$data = request()->validate([
          //  'name' => 'required | min:3| max:50 ',
          //  'email' => 'required | email',
          //  'active' => 'required',
          //  'company_id' => 'required',

        //]);

        //$customer->update($data);
        $customer -> update($this->validateRequest());

        $this->storeImage($customer); // if image (update customer )

        //$customer->update([
           // "image" => 'imagePath2',
           // "name" => 'NAME asd2',
        //]); 

        return redirect('customers/'.$customer->id);
    }

    public function destroy(Customer $customer)
    {
        //policy
        //403 THIS ACTION IS UNAUTHORIZED.
        $this->authorize('delete', $customer); // only Admin 
        //403 THIS ACTION IS UNAUTHORIZED.

        $customer->delete();

        return redirect('customers');
    }

    /**
     * Summary of validateRequest
     * @return array
     */
    private function validateRequest()
    {

         
           return request()->validate([ //OLWAYS REQUIRED
                'name' => 'required | min:3| max:50',
                'email' => 'required | email',
                'active' => 'required',
                'company_id' => 'required',
                'image' => "sometimes | image | mimes:jpeg,png,jpg,gif,svg | max:2048",
           ]);             // SOMETIMES so not actualy REQIURED (nullable() in migration) 
          
        // TAP METHOD BELOW
        /*
         return tap(  // lesson 39 / 12 minute (tap method )
            request()->validate([
                'name' => 'required | min:3| max:50',
                'email' => 'required | email',
                'active' => 'required',
                'company_id' => 'required',
                'image' => "required|image",
            ]),
            function (){
                if(request()->has('image')){
                    //dd(request()->image);
                    request()->validate([
                        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);
                }
            }
        );
        */
        //dd($validatedData);
        //return $validatedData; // no need cause the tap() method return and call the closure
    }

    private function storeImage($customer) //if image update customer
    {
        if(request()->hasFile('image')){
            request()->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imagePath = request('image')->store('uploads', 'public');
            //$customer->update([
              //  'image' => "$imagePath",
            //]);
            $customer->update([
                //'name' => $imagePath,
                'image' => $imagePath,
                //'email' => $imagePath,
                //'image' => 'IMAGE',
            ]);
            //$customer->update([
               // 'image' => $imagePath,
           // ]);
            //dd($imagePath, $customer);

            // CROPING IMAGE   WITH IMAGE EINTERVENTION PACAGE
            //use Intervention\Image\Facades\Image;
            //take image , crop  (size 300px, 300px) with fit() method
            
            
            $image = Image::make(public_path('storage/' . $customer->image)) -> fit(300, 300);
            //$image = Image::make(public_path('storage/' . $customer->image)) -> crop(300, 300);
            //also you can use the crop method insted fit 
            //fit(300, 300, null , 'top-left'); // how too fit the image (center is default)
            //then save it back  
            $image -> save();
            //dd($customer->image, $imagePath);
        }
    }
}

/*
$data = request()->validate([
            'caption' => 'required',
            //'image' => ['required', 'image'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200, 1200); // important " "
        $image->save();


        // \App\Models\Post::create($data);
        //auth()->user()->posts()->create($data);
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
*/