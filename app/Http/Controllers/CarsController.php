<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Product;
use App\Models\Headquater;
use Illuminate\Http\Request;
use App\Http\Requests\CreateValidationRequest;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$cars = Car::all();

        //$cars = Car::where('name','Audi')->get();

        //$cars = Car::where('name','Audi')->firstorFail();

        //print_r(Car::where('name','Audi')->count());
        //print_r(Car::all()->count());
        //print_r(Car::sum('founded'));
        //print_r(Car::avg('founded'));


        //pagination two ways: 

        //query builder
        //$cars = DB::table('cars')->paginate(4);

        //eloquent way
        $cars = Car::paginate(3);

        return view('cars.index',
        [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cars.create');
  
    }

    /**
     * Store a newly created resource in storage.
     */
    
    //public function store(CreateValidationRequest $request)
    public function store(Request $request)
    {
        //IMAGES
        //Methods we can use on $request
            //guessExtension()
            //getMimeType()
            //store()
            //asStore()
            //storePublicly()
            //move()
            //getClientOriginalName()
            //getClientMimeType()
            //guessClientExtension()
            //getSize()
            //getError()
        // $test = $request->file('image')->getSize();
        // dd($test);




        $newImageName = time() . '-' . $request->name . '.' .
        $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

       





        // dd('ok');

                /**
                    * First approach.
                */
        /** 
         *$car = new Car;
         *$car->name = $request->input('name');
         *$car->founded = $request->input('founded');
         *$car->description = $request->input('description');
         *$car->save();
        */ 

                /**
                        * Second approach.
                */

        $request->validate([
            'name'=> 'required|unique:cars',
            'founded'=> 'required|integer|min:0|max:2021',
            'description'=> 'required',
            
        ]);



        //$request->validated();

        //dd($request->all());

        //If its valid, it will proceed
        //if invalid, throws a ValidationException
        $car = Car::create([
            'name' => $request->input('name'),
            'founded' =>$request->input('founded'),
            'description' =>$request->input('description'),
            'image_path' => $newImageName
        ]);

        //REQUEST ALL INPUT FIELDS
        $test = $request->all();


        //EXCEPT METHOD
        //$test = $request->except('_token');
        //$test = $request->only(['_token', 'name']);
        //$test = $request->only('_token');


        //Has method
        //$test = $request->has('founded');
        // if($request->has('founded'))
        // {
        //     dd('Founded has been found!');
        // }


        //Current Path
        // if ($request->is('cars')) 
        // {
        //     dd('endpoint is cars!');
        // }

        
        //Current Path
        // if ($request->method('post')) 
        // if ($request->isMethod('post')) 
        // {
        //     dd('Method is post!');
        // }


        //Show URL
        //dd($request->url());

        //Show IP address
        // dd($request->ip());

        // dd($test);

        return redirect('/cars');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //dd($id);
        $car = Car::find($id);

        // $hq = $car->headquater;
        // dd($hq);


        // $car = Headquater::find($id);
        // var_dump($car);

        // dd($car->engines);

        //var_dump($car->productionDate);

        //var_dump($car->products);

        $products = Product::find($id);
        //print_r($products);

        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      
        // $car = Car::find($id)->first();
        //dd($car);

        $car = Car::find($id);
        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateValidationRequest $request, string $id)
    {
         // $request->validate([
        //     'name'=> 'required|unique:cars',
        //     'founded'=> 'required|integer|min:0|max:2021',
        //     'description'=> 'required'
        // ]);

        $request->validated();

        $car = Car::where('id', $id)
                ->update([
                'name' => $request->input('name'),
                'founded' =>$request->input('founded'),
                'description' =>$request->input('description')
        ]);

        return redirect('/cars');
    }






    /**
     * Remove the specified resource from storage.
     */
            /**
                * FIRST APPROACH
             */
    // public function destroy(string $id)
    // {
        
    //    // dd($id);
    //     $car = Car::find($id);

    //     $car->delete();

    //     return redirect('/cars');
    // }


             /**
                * SECOND APPROACH
             */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect('/cars');
    }
}
