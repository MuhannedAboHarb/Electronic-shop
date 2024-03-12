<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
        $this->middleware(['verified'])->except(['index' , 'show']);
     }


    public function index()
    {
        //
        $products=Product::all();
        return view('dashboard.products.index', [
            'products'=> $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.products.create', [
            'product'=> new Product(),
                        'availabillties' => Product::availabillties(), 
            'status_options' =>Product::statusOptions()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $role = $this->role(null);
        
        $request->validate($role);
        

        // image

        $data = $request->except('image');
        // $data['slug']= Str::slug($data['name']);

        if($request->hasFile('image'))
        {
            $data['image'] = $this->upload($request->file('image'));
        }



        $product=Product::create($data);

        return redirect()
            ->route('dashboard.products.index')
            ->with('success',"Product ($product->name) Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product=Product::findOrFail($id);
        return view('dashboard.products.show',[
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product=Product::findOrFail($id);
        return view('dashboard.products.edit',[
            'product' => $product,
            'availabillties' => Product::availabillties(), 
            'status_options' =>Product::statusOptions()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);
    $role = $this->role($product->id); // قم بتمرير معرف المنتج هنا
    $request->validate($role);

    //IMAGE

    $data = $request->except('image');
    // $data['slug']= Str::slug($data['name']);

    if($request->hasFile('image'))
    {
        $data['image'] = $this->upload($request->file('image'));
    }

    $old_image = $product->image ;
    $product->update($data);

    if($old_image && $old_image != $product->image)
    {
        Storage::disk('uploads')->delete($old_image);
    }

    return redirect()
    ->route('dashboard.products.index')
    ->with('success',"Product ($product->name) Updated");
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product=Product::withTrashed()->findOrFail($id);

        if($product->trashed())
        {
            $product->forceDelete();
            // if($product->image)
            // {
            //     Storage::disk('uploads')->delete($product->image);
            // }
        }
        else
        {
        $product->delete();
        }


        return redirect()
        ->route('dashboard.products.index')
        ->with('success',"Product ($product->name) Deleted");
    }

    public function trash()
    {
        $product= Product::onlyTrashed()->get();
        return view('dashboard.products.trash', [
            'products'=> $product
        ]);
        
    }


    public function restore(Request $request,string $id)
    {
        //
        $product=Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()
        ->route('dashboard.products.index')
        ->with('success',"Product ($product->name) Restored");
    }

    public function role($productId)
{
    return [
        'name' => 'required|string|max:255',
        'category_id' => 'required|int|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'compare_price' => 'nullable|numeric|gt:price',
        'status' => 'in:active,draft,archived',
        'availabillty' => 'in:in-stock,out-of-stock,back-order',
        'quantity' => 'nullable|int|min:0',
        'sku' => 'nullable|string|unique:products,sku,' . $productId,
        'barcode' => 'nullable|string|unique:products,barcode',
        'image' => 'nullable|image',
    ];
}

//Illuminate\Http\UploadedFile

    public function upload(UploadedFile $file)
    {
        $path = $file->store('thumbnails', ['disk' => 'uploads']);

        if (!$path) {
            throw new \Exception('Failed to upload the file.');
        }

        return $path;
    }



}
