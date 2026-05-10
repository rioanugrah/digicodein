<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ProductCategory;

use App\Http\Requests\ProductCategoryStoreRequest;

use DataTables;
use Validator;

class ProductCategoryController extends Controller
{
    function __construct(
        ProductCategory $productCategory
    ){
        $this->productCategory = $productCategory;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->productCategory->get();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('status', function($row){
                                switch ($row->status) {
                                    case 'Active':
                                        return '<span class="badge badge-green">Aktif</span>';
                                        break;
                                    case 'Inactive':
                                        return '<span class="badge bg-danger">Tidak Aktif</span>';
                                        break;

                                    default:
                                        # code...
                                        break;
                                }
                            })
                            ->addColumn('action', function($row){
                                // $btn = '<a class="link-reset fs-20 p-1 text-mute">';
                                // $btn .= '<i class="ri-pencil-line"></i>';
                                // $btn .= '</a>';
                                // $btn .= '<a class="link-reset fs-20 p-1 text-mute">';
                                // $btn .= '<i class="ri-delete-bin-line"></i>';
                                // $btn .= '</a>';
                                $btn = '<div class="d-flex flex-wrap gap-2">';
                                // $btn .=     '<button type="button" class="btn btn-green btn-sm" data-id='.$row->id.'>';
                                // $btn .=         '<i class="ri-eye-line me-1"></i> Detail';
                                // $btn .=     '</button>';
                                $btn .=     '<button type="button" class="btn btn-yellow btn-sm edit" data-id='.$row->id.'>';
                                $btn .=         '<i class="ri-edit-line align-middle me-1"></i> Edit';
                                $btn .=     '</button>';
                                $btn .=     '<button type="button" class="btn btn-red btn-sm delete" data-id='.$row->id.'>';
                                $btn .=         '<i class="ri-delete-bin-line align-middle me-1"></i> Delete';
                                $btn .=     '</button>';
                                $btn .= '</div>';

                                return $btn;
                            })
                            ->rawColumns(['action','icon','status'])
                            ->make(true);
        }
        // dd($data);
        return view('admin.products.category.index');
    }

    public function simpan(Request $request)
    {
        $rules = [
            'category' => 'required|unique:product_category',
            'status' => 'required',
        ];

        $messages = [
            'category.required' => 'Kategori Wajib Diisi',
            'category.unique' => 'Kategori '.$request->category.' Sudah Ada',
            'status.required' => 'Status Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){
            $input['slug'] = Str::slug($request->category);
            $input['category'] = $request->category;
            $input['icon'] = $request->icon;
            $input['status'] = $request->status;

            $saveProductCategory = $this->productCategory->create($input);

            if ($saveProductCategory) {
                $message_title="Berhasil !";
                $message_content= "Kategori ".$input['category']." Berhasil Dibuat";
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
        $data = $this->productCategory->find($id);

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Kategori Tidak Ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'category' => 'required|unique:product_category',
            'status' => 'required',
        ];

        $messages = [
            'category.required' => 'Kategori Wajib Diisi',
            'category.unique' => 'Kategori '.$request->category.' Sudah Ada',
            'status.required' => 'Status Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){
            $input['slug'] = Str::slug($request->category);
            $input['category'] = $request->category;
            $input['status'] = $request->status;
            $updateProductCategory = $this->productCategory->find($request->id)->update($input);


            if ($updateProductCategory) {
                $message_title="Berhasil !";
                $message_content= "Kategori ".$input['category']." Berhasil Diupdate";
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

    public function destroy(Request $request)
    {
        $data = $this->productCategory->find($request->id);

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Kategori Tidak Ditemukan'
            ]);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message_title' => 'Berhasil',
            'message_content' => 'Kategori '.$data->category.' Berhasil Dihapus'
        ]);
    }
}
