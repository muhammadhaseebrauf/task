<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use Illuminate\Http\Request;
 
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
        ]);
    
        if ($request->hasFile('logo')) {
            $uploadedFile = $request->file('logo');
            // Error handling for file upload
            if (!$uploadedFile->isValid()) {
                return redirect()->back()->withErrors(['logo' => 'Failed to upload logo.']);
            }
            $filename = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $path = $uploadedFile->storeAs('public/logos', $filename);
            // Store only the filename in the database
            $validatedData['logo'] = $filename;
        }
    
        Company::create($validatedData);
    
        return redirect()->back()->with('success', 'Company added successfully!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
    
        $company->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    
        // Optionally, you can return a response indicating success
        return redirect()->back()->with('success', 'Company information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        // dd($company);
        $company->delete();
        return redirect()->back()->with('success', 'Company deleted successfully.');
    }
}
