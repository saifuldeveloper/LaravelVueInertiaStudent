<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ListSectionsRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\List_;

class SectionsController extends Controller
{

    public function __invoke(ListSectionsRequest $request){
        $sections = Section::where('class_id' , $request->class_id)->get();
        return SectionResource::collection($sections);

    }
}
