<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Redirect,Response;
use DataTables;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Zip;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(request()->ajax()) {
            $model = Product::select('id','title','product_code','description');
            return DataTables::eloquent($model)
                ->addColumn('title', function(Product $product) {
                    return  $product->title;
                })
                ->addColumn('product_code', function(Product $product) {
                    return  $product->product_code;
                })
                ->addColumn('description', function(Product $product) {
                    return  $product->description;
                })
                ->addColumn('action', 'dataTables.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
    }

    return view('products.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        foreach($request->title as $k => $p){
            //dd($request['title'][$k]);
            $productId = $request['productId'][$k];
          Product::updateOrCreate(['id' => $productId],
                ['title' => $request['title'][$k], 'product_code' => $request['product_code'][$k], 'description' => $request['description'][$k]]);
        }
        $product=Product::all();

    return Response::json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $where = array('id' => $id);
    $product  = Product::where($where)->first();

    return Response::json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $product = Product::where('id',$id)->delete();

    return Response::json($product);
    }
    public function exportProduct(){
        return Excel::download(new ProductExport, 'Products.xlsx');
        // Excel::store(new ProductExport,'Products.xlsx');
        // return 'done';
    }
    public function exportProductPDF(){
        //$product= Product::all();
        $pdf = PDF::loadView('exports.products', [
            'products' => Product::all()
        ]);
        return $pdf->download('product-list.pdf');
    }
    public function downloadZipProductPDF(){
        $pdf = PDF::loadView('exports.products', [
            'products' => Product::all()
        ]);
        $directory= 'ProductZip/';
        if(!Storage::exists($directory)){
            Storage::makeDirectory($directory);
        }
        Storage::put($directory.'product.pdf', $pdf->output());
        // $zip = Zip::create('Productzip.zip');
        // $zip->add(public_path().'/ProductZip');
        // $zip->close();
        //$zip = Zip::create('Productzip.zip');
        $files = glob(storage_path().'/app/ProductZip');
        Zip::create('Productzip.zip')->add($files)->close();
    }
    public function all_User()
    {
        $users= User::all();
        return response()->json($users, 200);
        // return '<h1>hrllo this is test api</h1>';
    }
}
