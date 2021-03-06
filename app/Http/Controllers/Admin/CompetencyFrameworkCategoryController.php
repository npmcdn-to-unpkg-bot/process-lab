<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\CompetencyFrameworkCategory;
use Log;

class CompetencyFrameworkCategoryController extends Controller
{
	public function store(Request $request)
    {
    	if ($request['category_id'])
    	{
    		$category = CompetencyFrameworkCategory::find($request['category_id']);

			if ($request['category'] != $category->category) {
    			$this->validate($request, [
					'category' => 'required|filled|unique:competency_framework_categories,category,NULL,framework_id'
            	]);
            }

            if ($request['category']) $category->category = $request['category'];

            $category->save();
    	}
    	else
    	{
	    	$this->validate($request, [
            	'category' => 'required|filled|unique:competency_framework_categories,category,NULL,framework_id'
        	]);  
            
        	$user = auth()->user(); 
            
        	$category = CompetencyFrameworkCategory::create([
            	'category' => $request['category'],
            	'framework_id' => $request['framework_id'],
            	'created_by_user_id' => $user->id,
            	'updated_by_user_id' => $user->id
        	]);   
        }   

        return $category;     
    }

    public function retrieve(Request $request)
    {

        $categories = CompetencyFrameworkCategory::all()->sortBy('category');

        return $categories;
    }

    public function destroy(Request $request) {
        $category = CompetencyFrameworkCategory::find($request['category_id']);
        $category -> delete(); //should be soft delete 

        return response()->json(['success' => 'category deleted.'], 200); 
    }
}
