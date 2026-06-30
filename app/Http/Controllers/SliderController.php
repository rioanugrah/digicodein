<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

use \Carbon\Carbon;

use DataTables;
use Validator;
use Image;
use File;
use Storage;

class SliderController extends Controller
{
    function __construct(
        Slider $slider
    ){
        $this->slider = $slider;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->slider->get();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('images', function($row){
                                return '<img src='.Storage::disk('s3')->url($row->images).' width="400">';
                            })
                            ->addColumn('updated_at', function($row){
                                return $row->updated_at->format('Y-m-d H:i:s');
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
                                $btn .=     '<button type="button" class="btn btn-green btn-sm" data-id='.$row->id.'>';
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
                            ->rawColumns(['action','images','status'])
                            ->make(true);
        }

        return view('admin.sliders.index');
    }

    public function simpan(Request $request)
    {
        $rules = [
            'title' => 'required|unique:slider',
            'images' => 'required|mimes:jpg|max:2048',
            'status' => 'required',
        ];

        $messages = [
            'title.required' => 'Judul Wajib Diisi',
            'images.required' => 'Upload Slider Wajib Diisi',
            'images.mimes' => 'Upload Slider Menggunakan Ekstensi .jpg',
            'images.max' => 'Ukuran Upload Slider Max 2MB',
            'status.required' => 'Status Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){
            $input = $request->all();

            if ($request->file('images')) {
                $fileImages = $request->file('images');
                $tujuanUploadImages = 'digicodein/slider';
                $imgImages = Image::make($fileImages->path());
                $imgImages = $imgImages->encode('webp', 30);
                $fileNameImages = 'slider_'.Carbon::now()->format('dmYHis').'_'.rand(1000,9999).'.webp';

                Storage::disk('s3')->putFileAs($tujuanUploadImages, $fileImages, $fileNameImages);
                Storage::disk('s3')->setVisibility($tujuanUploadImages."/".$fileNameImages,"public");
                Storage::disk('s3')->url($tujuanUploadImages."/".$fileNameImages);
                $resultImages = $tujuanUploadImages.'/'.$fileNameImages;

            }else{
                $resultImages = '-';
            }

            $input['images'] = $resultImages;

            $saveSlider = $this->slider->create($input);

            if ($saveSlider) {
                $message_title="Berhasil !";
                $message_content= "Slider ".$input['title']." Berhasil Dibuat";
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
}
