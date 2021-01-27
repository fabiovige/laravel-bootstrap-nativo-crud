<?php

namespace LaraDev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaraDev\Property;

class PropertyController extends Controller
{
    public function index()
    {
        //$properties = DB::select("select * from properties");
        $properties = Property::all();

        return view('property.index')->with('properties', $properties);
    }

    public function show($slug)
    {
        //$property = DB::select("select * from properties where slug = ?", [$slug]);
        $property = Property::where('slug', $slug)->get();

        if (!empty($property)) {
            return view('property.show')->with('property', $property);
        } else {
            return redirect()->action('PropertyController@index');
        }
    }

    public function create()
    {
        return view('property.create');
    }

    public function store(Request $request)
    {

        $slug = $this->setName($request->title);

//        $property = [
//            $request->title,
//            $slug,
//            $request->description,
//            $request->rental_price,
//            $request->sale_price,
//        ];
//
//        DB::insert("insert into properties (title, slug, description, rental_price, sale_price) VALUES ( ?, ?, ?, ?, ?)", $property);

        $property = [
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'rental_price' => $request->rental_price,
            'sale_price' => $request->sale_price,
        ];

        Property::create($property);

        return redirect()->action('PropertyController@index');
    }

    public function edit($slug)
    {
        //$property = DB::select("select * from properties where slug = ?", [$slug]);
        $property = Property::where('slug', $slug)->get();

        if (!empty($property)) {
            return view('property.edit')->with('property', $property);
        } else {
            return redirect()->action('PropertyController@index');
        }
    }

    public function update(Request $request, $id)
    {
        $slug = $this->setName($request->title);

//        $property = [
//            $request->title,
//            $slug,
//            $request->description,
//            $request->rental_price,
//            $request->sale_price,
//            $id
//        ];
//
//        DB::update("update properties set title = ?, slug = ?, description = ?, rental_price = ?, sale_price = ? where id = ?", $property);

        $property = Property::find($id);
        $property->title = $request->title;
        $property->slug = $slug;
        $property->sale_price = $request->description;
        $property->rental_price = $request->rental_price;
        $property->sale_price = $request->sale_price;
        $property->save();

        return redirect()->action('PropertyController@index');
    }

    public function destroy($slug)
    {
        //$property = DB::select("select * from properties where slug = ?", [$slug]);
        $property = Property::where('slug', $slug)->get();

        if (!empty($property)) {
            DB::delete('delete from properties where slug = ?', [$slug]);
        }

        return redirect()->action('PropertyController@index');
    }

    private function setName($title)
    {
        $slug = str_slug($title);

        //$properties = DB::select("select * from properties");
        $properties = Property::all();

        $t = 0;
        foreach ($properties as $prop) {
            if (str_slug($prop->title) === $slug) {
                $t++;
            }
        }

        if ($t > 0) {
            $slug = $slug . '-' . $t;
        }

        return $slug;
    }
}
