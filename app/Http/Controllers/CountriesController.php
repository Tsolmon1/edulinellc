<?php namespace App\Http\Controllers;

use App\Country;
use App\School;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;

class CountriesController extends Controller {

	public function __construct()
    {
    	$this->middleware('auth', ['except' => ['show']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$countries = Country::all();
		// dd($countries);
		return view('countries.index', compact('countries'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('countries.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$country = Country::findOrFail($id);
		$schools = Country::findOrFail($id)->schools()->orderBy('rank')->get();
		$articles = Category::findOrFail($id+6)->articles()->orderBy('created_at')->get();

		return view('countries.show', compact('country', 'articles','schools'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$country = Country::findOrFail($id);

        return view('countries.edit', compact('country'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CountryRequest $request, $id)
	{
		$country = Country::findOrFail($id);

		$country->update($request->all());

		return redirect('countries');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}