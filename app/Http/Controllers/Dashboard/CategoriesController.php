<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{
    //
        //Read
        public function index()
    {
        $categories=Category::leftJoin('categories as parents','parents.id' , '=' , 'categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name'
        ]) //بتنفذ جملة الاستعلام
        // ->whereNull('categories.parent_id')
        ->orderBy('id')
        ->get();
        $title= 'Categories';
        return view('dashboard.categories.index', compact('title','categories'));
    }

        //Trash
        public function trash()
        {
            $categories=Category::onlyTrashed()->latest('deleted_at')->get();
            return view('dashboard.categories.trash',compact('categories'));
        }

        //Create
        public function create()
        {
            $categories = Category::orderBy('name')->get();
              return view('dashboard.categories.create',[
                'parents'=>$categories,
                'category'=> new Category()
            ]);
        }

        // second code for store method
        // public function store(Request $request)
        // {
        //     $rules = $this->role(null);
        //     $request->validate($rules);
        
        //     $data = $request->except('image');
        
        //     if ($request->hasFile('image')) {
        //         $file = $request->file('image');
        //         if (!$file->isValid()) {
        //             throw ValidationException::withMessages([
        //                 'image' => 'File corrupted! ',
        //             ]);
        //         }
        //         $data['image'] = $this->upload($file);
        //     }
        
        //     $category = Category::create($data);
        
        //     return redirect()
        //         ->route('dashboard.categories.index')
        //         ->with('success', "Category ($category->name) Created");
        // }


        public function store(Request $request)
        {
            $rules=$this->role(null);
            $request->validate($rules);

            $data=$request->except('image');

            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $data['image']= $this->upload($file);
            }

            // $data['slug']=Str::slug($data['name']);

            $category=Category::create($data);
            
        session()->flash('alert-type', $category ? "success" : "danger"); 
         session()->flash('message',$category ? "Create Successfully" : "Create falid");
         return redirect() ->back();
        //  ->route('dashboard.categories.index') ;
        //  ->with('success' , "Catgory ($category->name) Created");
        }

        //Update two function
        public function edit ($id)
        {
            $category=Category::withTrashed()->findOrFail($id);
            if($category==null)
            {
                abort(404);
            }
            $parents=Category::where('id','<>',$id)
                ->orderBy('name')
                ->get();
            return view('dashboard.categories.edit',compact('category','parents'));
        }

        public function update (Request $request,$id)
        {
            $rules=$this->role(null);
            $request->validate($rules);

            $category=Category::withTrashed()->findOrFail($id);
            $data = $request->except('image');
            // $data['slug']= Str::slug($data['name']);

            $old_image =$category->image;
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $data['image']= $this->upload($file);
            }
            $category->update($data);
            if($old_image && $old_image =! $category->image){
                Storage::disk('uploads')->delete($old_image);
            }
            session()->flash('alert-type', $category ? "info" : "danger"); 
            session()->flash('message',$category ? "update Successfully" : "update falid");
            return redirect()->back();
            // ->route('dashboard.categories.index')
            //  ->with('success' , "Catgory ($category->name) Updated");
        }

        //Delete
        public function destroy ($id)
        {
            $category=Category::withTrashed()->findOrFail($id);
            if( $category->trashed()){
                $category->forceDelete();
                // if($category->image)
                // {
                //     /* Storage user libary facad */
                //      Storage::disk('uploads')->delete($category->image);
                // }
            } else{
                $category->delete();
            }
            return redirect()
            ->route('dashboard.categories.index')
             ->with('success' , "Catgory ($category->name) Deleted");
        }


        protected function role($id = 0)
        {
            return [
                'name'=>[
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('categories','name')->ignore($id ,'id'),
                ] ,
                'parent_id'=>'nullable|int|exists:categories,id',
                'description'=>'nullable|string|min:5',
                'image'=>'nullable|image',
            ];
        }

        protected function upload(UploadedFile $file) // code update and store
        {

            if($file->isValid())
            {
                return $file->store('thumbnails',[
                    'disk'=> 'uploads'
                ]);
            }
            else
            {
                throw ValidationException::withMessages([
                    'image'=>'File corrupted! ' ,
                ]);
            }
        }

        public function restore(Request $request , $id)
        {
            $category=Category::onlyTrashed()->findOrFail($id); // لما استخدم فايند اور فيل فانا بدي ابحث في العناصر المحذوفة فقط
            $category->restore();
            return redirect()
                ->route('dashboard.categories.index')
                 ->with('success' , "Catgory ($category->name) Restored");
        }
}
