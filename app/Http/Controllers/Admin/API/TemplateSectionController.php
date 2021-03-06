<?php

namespace App\Http\Controllers\Admin\API;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\TemplateSection;
use Log;

class TemplateSectionController extends Controller
{
	public function store(Request $request)
    {

    	//Log::info($request);

    	$user = Auth::user();

    	if ($request['section_id']) {

    		$templateSection = TemplateSection::find($request['section_id']);

			if ($request['section_title']) {
				if ($request['section_title'] != $templateSection->section_title) {
					$this->validate($request, [
                	'section_title' => 'filled|unique:template_sections,section_title,NULL,id,template_id,'.$request['template_id'].'' 
            		]); 
					$templateSection->section_title = $request['section_title'];
				}
			}
			if ($request['section_description']) $templateSection->description = $request['section_description'];

			$templateSection->save();
    	}
    	else {

    		$this->validate($request, [
                'section_title' => 'required|unique:template_sections,section_title,NULL,id,template_id,'.$request['template_id'].''
            ]); 

            $templateSection = TemplateSection::create([
                'section_title' => $request['section_title'],
                'template_id' => $request['template_id'],
                'order' => $request['order'],
                'created_by_user_id' => $user->id,
                'updated_by_user_id' => $user->id,
            ]);
    	}

    	return $templateSection;

    }
}
