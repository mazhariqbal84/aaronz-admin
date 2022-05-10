<?php

namespace App\Http\Controllers\Properties;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties\Feature;
use App\Models\Properties\Icon;
use App\Models\Admin\Settings\Language;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
class FeatureController extends Controller
{
    //TODO: For Loading Aminites Index Page
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $features = Feature::orderBy('id', 'DESC')->where('lang_id',1)->get();
            return Datatables::of($features)
            ->addIndexColumn()
            ->addColumn('status', function($features){
                    if($features->status == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$features->id.'">
                    <input type="hidden" name="status" value="'.$features->status.'">
                    <a id="change_status" data-id="'.$features->id.'" class="btn btn-icon btn-light btn-hover-success btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Active">
                    <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Unlock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <mask fill="white">
                                <use xlink:href="#path-1"/>
                            </mask>
                            <g/>
                            <path d="M15.6274517,4.55882251 L14.4693753,6.2959371 C13.9280401,5.51296885 13.0239252,5 12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L14,10 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C13.4280904,3 14.7163444,3.59871093 15.6274517,4.55882251 Z" fill="#000000"/>
                        </g>
                    </svg></span>
                    </a>
                    ';
                }
                else
                {
                    return '
                    <input type="hidden" name="id" value="'.$features->id.'">
                    <input type="hidden" name="status" value="'.$features->status.'">
                    <a id="change_status" data-id="'.$features->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Not Active">
                    <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <mask fill="white">
                            <use xlink:href="#path-1"/>
                        </mask>
                        <g/>
                        <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"/>
                    </g>
                    </svg></span>
                    </a>
                    ';
                }
            })
            ->addColumn('action', function ($features){
                    return '
                     <a href="'.route('manage-properties.property-settings.features.edit', ['id' => $features->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                     <span class="svg-icon svg-icon-md svg-icon-primary">
                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                        </g>
                        </svg>
                    </span>
                    </a>
                    <input type="hidden" name="id" value="'.$features->id.'">
                   <a id="delete_language" data-id="'.$features->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                   <span class="svg-icon svg-icon-md svg-icon-danger">
                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                           <rect x="0" y="0" width="24" height="24"></rect>
                           <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                           <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                       </g>
                   </svg>
                   </span>
                   </a>
                    ';
            })
            ->rawColumns(['action', 'status'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
        return view('properties.features.index');
    }

    //loading create Feature
    public function create(){
        $languages = Language::where('status',1)->get();
        return view('properties.features.create', compact('languages'));
    }

     //loading create Feature
    public function edit($id){
        $languages = Language::where('status',1)->get();
        $feature = Feature::where('id',$id)->first();
        for($i = 1; $i < count($languages) ; $i++)
        {
            $checkLanguage = Feature::where(['parent_id' => $id, 'lang_id' => $languages[$i]['id']])->first();
            if(is_null($checkLanguage))
            {
                $ftchr = new Feature;
                $ftchr->name = '';
                $ftchr->lang_id=$languages[$i]['id'];
                $ftchr->parent_id=$id;
                $ftchr->save();
            }
        }
        $storedData=Feature::where(['parent_id'=>$id])->get();
        return view('properties.features.edit', compact('feature','languages','storedData'));
    }

     //for creating Feature
    public function create_process(Request $request){
      //return $request->all();
      $languages = Language::where('status',1)->get();
      //checking the title of Feature is exits or not
      $checkFeatureTitle = Feature::where('name',$request->title_english)->first();
      //returning the error if Feature title exists
      if(!is_null($checkFeatureTitle))
      {
        return 'title';
      }
    //create new Feature here
    $feature = new Feature;
    $feature->name = $request->title_english;
    $feature->lang_id=1;
    $feature->parent_id=0;
    $feature->save();
    $parent_id=$feature->id;
    Feature::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
    //CRAETEING OTHER LANGUAGES RECORDS//
    $languages_id = explode (",",$request->languages);
    $feature_titles = explode (",",$request->feature_titles);
    for($i=1; $i <count($languages_id) ; $i++ )
    {
        $feature = new Feature;
        $feature->name = $feature_titles[$i];
        $feature->lang_id=$languages_id[$i];
        $feature->parent_id=$parent_id;
        $feature->save();
    }
    return 'true';
    }


    //for Updating slider
    public function edit_process(Request $request){
       // return $request->all();
      $languages = Language::where('status',1)->get();
      $checkfeatureTitle = Feature::where('name',$request->title_english)->first();
      //returning the error if feature title exists
      if(!is_null($checkfeatureTitle)){
          if($checkfeatureTitle->id != $request->id){
            return 'title';
          }
        }
    //Updating Feature here
    $feature = Feature::find($request->id);
    $feature->name = $request->title_english;
    $feature->update();

    $languages_id = explode (",",$request->languages);
    $feature_titles = explode (",",$request->feature_titles);
    // $descriptions = explode (",",$request->descriptions);

    for($i=1; $i <count($languages_id) ; $i++ )
    {
        $nav = Feature::where(['lang_id'=>$languages_id[$i],'parent_id'=>$request->id])->first();
        $nav->name = $feature_titles[$i];
        $nav->lang_id=$languages_id[$i];
        $nav->parent_id=$request->id;
        $nav->update();
    }
    return 'true';
    }
     //TODO:for changing status
     public function change_status(Request $request){
        $ctype = Feature::where('id', $request->id)->first();

        if ($ctype->status == 1) {
            Feature::where('parent_id', $request->id)->update(['status' => 0]);
        } else {
            Feature::where('parent_id', $request->id)->update(['status' => 1]);
        }

        echo $ctype->status;
    }
     //TODO:for delete Amenity
     public function delete(Request $request)
     {
          Feature::where('parent_id', $request->id)->delete();

     }
}
