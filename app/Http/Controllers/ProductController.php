<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\ProductCategory;

use \Carbon\Carbon;

use DataTables;
use Validator;
use Image;
use File;
use Storage;


class ProductController extends Controller
{
    function __construct(
        Product $product,
        ProductCategory $productCategory
    ){
        $this->product = $product;
        $this->productCategory = $productCategory;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->product->get();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('product', function($row){
                                return '<img src='.Storage::disk('s3')->url($row->product_image_cover).' class="me-2 avatar-xl rounded-circle"><b class="text-primary">'.$row->product_code.'</b> - '.$row->product_name;
                            })
                            ->addColumn('product_price', function($row){
                                return 'Rp. '.number_format($row->product_price,2,',','.');
                            })
                            ->addColumn('product_description', function($row){
                                return Str::words($row->product_description,50,'....');
                            })
                            ->addColumn('status', function($row){
                                switch ($row->status) {
                                    case 'Active':
                                        return '<span class="badge badge-green">Aktif</span>';
                                        break;
                                    case 'Inactive':
                                        return '<span class="badge badge-red">Tidak Aktif</span>';
                                        break;

                                    default:
                                        # code...
                                        break;
                                }
                            })
                            ->addColumn('action', function($row){
                                $btn = '<div class="d-flex flex-wrap gap-2">';
                                $btn .=     '<button type="button" class="btn btn-green btn-sm" onclick="detail(`'.$row->id.'`)">';
                                $btn .=         '<i class="ri-eye-line me-1"></i> Detail';
                                $btn .=     '</button>';
                                $btn .=     '<button type="button" class="btn btn-yellow btn-sm" onclick="edit(`'.$row->id.'`)">';
                                $btn .=         '<i class="ri-edit-line align-middle me-1"></i> Edit';
                                $btn .=     '</button>';
                                $btn .=     '<button type="button" class="btn btn-red btn-sm delete" data-id='.$row->id.'>';
                                $btn .=         '<i class="ri-delete-bin-line align-middle me-1"></i> Delete';
                                $btn .=     '</button>';
                                $btn .= '</div>';

                                return $btn;
                            })
                            ->rawColumns(['action','product_description','product','status'])
                            ->make(true);
        }

        $data['product_categories'] = $this->productCategory->where('status','Active')->get();
        return view('admin.products.index',$data);
    }

    public function simpan(Request $request)
    {
        $rules = [
            'product_name' => 'required|unique:product',
            'product_description' => 'required',
            'product_quantity' => 'required',
            'product_price' => 'required',
            'product_image_cover' => 'required',
            'product_link' => 'required',
            'product_link_description' => 'required',
            'status' => 'required',
        ];

        $messages = [
            'product_name.required' => 'Nama Produk Wajib Diisi',
            'product_name.unique' => 'Produk '.$request->product_name.' Sudah Ada',
            'product_description.required' => 'Produk Deskripsi Wajib Diisi',
            'product_quantity.required' => 'Stok Produk Wajib Diisi',
            'product_price.required' => 'Harga Produk Wajib Diisi',
            'product_image_cover.required' => 'Gambar Cover Produk Wajib Diisi',
            'product_link.required' => 'Produk Link Wajib Diisi',
            'product_link_description.required' => 'Produk Link Deskripsi Wajib Diisi',
            'status.required' => 'Status Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){
            $input['id'] = Str::uuid()->toString();
            $input['slug'] = Str::slug($request->product_name);
            $input['product_code'] = rand(10000,99999);
            $input['product_category_id'] = $request->product_category_id;
            $input['product_name'] = $request->product_name;
            $input['product_description'] = $request->product_description;
            $input['product_quantity'] = $request->product_quantity;
            $input['product_price'] = $request->product_price;
            $input['product_link'] = $request->product_link;
            $input['product_link_description'] = $request->product_link_description;
            $input['status'] = $request->status;

            if ($request->file('product_image_cover')) {
                $fileCover = $request->file('product_image_cover');
                $tujuanUploadCover = 'digicodein/product/'.$input['product_code'];
                $imgCover = Image::make($fileCover->path());
                $imgCover = $imgCover->encode('webp', 30);
                $fileNameCover = 'product_'.Carbon::now()->format('dmY_His').'_'.rand(1000,9999).'.webp';

                Storage::disk('s3')->putFileAs($tujuanUploadCover, $fileCover, $fileNameCover);
                Storage::disk('s3')->setVisibility($tujuanUploadCover."/".$fileNameCover,"public");
                Storage::disk('s3')->url($tujuanUploadCover."/".$fileNameCover);
                $resultProductImageCover = $tujuanUploadCover.'/'.$fileNameCover;

            }else{
                $resultProductImageCover = '-';
            }

            $input['product_image_cover'] = $resultProductImageCover;

            $saveProduct = $this->product->create($input);

            if ($saveProduct) {
                $message_title="Berhasil !";
                $message_content= "Produk ".$input['product_name']." Berhasil Dibuat";
                $message_type="success";
                $message_succes = true;

                $array_message = array(
                    'success' => $message_succes,
                    'message_title' => $message_title,
                    'message_content' => $message_content,
                    'message_type' => $message_type,
                );

                return response()->json($array_message);
            }
        }

        return response()->json(
            [
                'success' => false,
                'error' => $validator->errors()->all()
            ]
        );

    }

    public function detail($id)
    {
        $product = $this->product->find($id);

        if (empty($product)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Produk Tidak Ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ]);

    }

    public function update(Request $request)
    {
        $rules = [
            'product_name' => 'required',
            'product_description' => 'required',
            'product_link' => 'required',
            'product_link_description' => 'required',
            'product_quantity' => 'required',
            'product_price' => 'required',
            // 'product_image_cover' => 'required',
            'status' => 'required',
        ];

        $messages = [
            'product_name.required' => 'Nama Produk Wajib Diisi',
            // 'product_name.unique' => 'Produk '.$request->product_name.' Sudah Ada',
            'product_description.required' => 'Deskripsi Produk Wajib Diisi',
            'product_link.required' => 'Produk Link Wajib Diisi',
            'product_link_description.required' => 'Produk Link Deskripsi Produk Wajib Diisi',
            'product_quantity.required' => 'Stok Produk Wajib Diisi',
            'product_price.required' => 'Harga Produk Wajib Diisi',
            // 'product_image_cover.required' => 'Gambar Cover Produk Wajib Diisi',
            'status.required' => 'Status Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){
            $product = $this->product->find($request->edit_id);

            $input['product_category_id'] = $request->product_category_id;
            $input['product_name'] = $request->product_name;
            $input['product_description'] = $request->product_description;
            $input['product_link'] = $request->product_link;
            $input['product_link_description'] = $request->product_link_description;
            $input['product_quantity'] = $request->product_quantity;
            $input['product_price'] = $request->product_price;
            $input['status'] = $request->status;

            if ($request->file('product_image_cover')) {
                Storage::disk('s3')->delete($product->product_image_cover);

                $fileCover = $request->file('product_image_cover');
                $tujuanUploadCover = 'digicodein/product';
                $imgCover = Image::make($fileCover->path());
                $imgCover = $imgCover->encode('webp', 30);
                $fileNameCover = $product->product_code.'_'.Carbon::now()->format('dmY_His').'_'.rand(1000,9999).'.webp';

                Storage::disk('s3')->putFileAs($tujuanUploadCover, $fileCover, $fileNameCover);
                Storage::disk('s3')->setVisibility($tujuanUploadCover."/".$fileNameCover,"public");
                Storage::disk('s3')->url($tujuanUploadCover."/".$fileNameCover);
                $resultProductImageCover = $tujuanUploadCover.'/'.$fileNameCover;
            }else{
                $resultProductImageCover = $product->product_image_cover;
            }

            $input['product_image_cover'] = $resultProductImageCover;

            $product->update($input);

            if ($product) {
                $message_title="Berhasil !";
                $message_content= "Produk ".$input['product_name']." Berhasil Diupdate";
                $message_type="success";
                $message_succes = true;

                $array_message = array(
                    'success' => $message_succes,
                    'message_title' => $message_title,
                    'message_content' => $message_content,
                    'message_type' => $message_type,
                );

                return response()->json($array_message);
            }
        }

        return response()->json(
            [
                'success' => false,
                'error' => $validator->errors()->all()
            ]
        );
    }

    public function delete(Request $request)
    {
        // dd($request->all());

        $product = $this->product->find($request->id);

        if (empty($product)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Produk Tidak Ditemukan'
            ]);
        }

        Storage::disk('s3')->delete($product->product_image_cover);

        $product->delete();

        $message_title="Berhasil !";
        $message_content= "Produk ".$product->product_name." Berhasil Dihapus";
        $message_type="success";
        $message_succes = true;

        $array_message = array(
            'success' => $message_succes,
            'message_title' => $message_title,
            'message_content' => $message_content,
            'message_type' => $message_type,
        );

        return response()->json($array_message);
    }
}
