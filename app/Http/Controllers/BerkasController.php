<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\Master\LokasiFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BerkasController extends Controller
{
    public function index()
    {
        return view('berkas.index');
    }

    function json()
    {
        $download = Download::where('is_public', 0)
            ->select('downloads.id', 'downloads.nama', 'downloads.lokasi_id', 'downloads.is_public', 'downloads.file', 'lokasi_files.nama as lokasi_file')
            ->leftJoin('lokasi_files', 'lokasi_files.id', 'downloads.lokasi_id')
            ->whereNull('pengajar_id')
            ->orderBy('downloads.created_at', 'DESC');

        return DataTables::of($download)
            ->addIndexColumn()
            ->editColumn('tipe', function ($download) {
                $exp = explode('.', $download->file);
                $end = end($exp);

                if ($end == "doc" || $end == "docx") {
                    return '<div class="d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-word-fill text-primary" viewBox="0 0 16 16">
                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.485 6.879l1.036 4.144.997-3.655a.5.5 0 0 1 .964 0l.997 3.655 1.036-4.144a.5.5 0 0 1 .97.242l-1.5 6a.5.5 0 0 1-.967.01L8 9.402l-1.018 3.73a.5.5 0 0 1-.967-.01l-1.5-6a.5.5 0 1 1 .97-.242z"/>
                                </svg>&nbsp;&nbsp; <span class="text-primary">' . $end . '</span>
                            </div>';
                } elseif ($end == "pdf") {
                    return '<div class="d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-pdf-fill text-danger" viewBox="0 0 16 16">
                                    <path d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z"/>
                                    <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z"/>
                                    </svg>&nbsp;&nbsp; <span class="text-danger">' . $end . '</span>
                            </div>';
                } elseif ($end == "jpg" || $end == "jpeg" || $end == "png") {
                    return '<div class="d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-image text-success" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                                </svg>&nbsp;&nbsp; <span class="text-success">' . $end . '</span>
                            </div>';
                } elseif ($end == "ppt" || $end == "pptx") {
                    return '<div class="d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-ppt-fill text-warning" viewBox="0 0 16 16">
                                    <path d="M8.188 10H7V6.5h1.188a1.75 1.75 0 1 1 0 3.5z"/>
                                    <path d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM7 5.5a1 1 0 0 0-1 1V13a.5.5 0 0 0 1 0v-2h1.188a2.75 2.75 0 0 0 0-5.5H7z"/>
                                </svg>
                                &nbsp;&nbsp; <span class="text-warning">' . $end . '</span>
                            </div>';
                } elseif ($end == "xls" || $end == "xlsx") {
                    return '<div class="d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-text-fill text-success" viewBox="0 0 16 16">
                                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                                    </svg>
                                &nbsp;&nbsp; <span class="text-success">' . $end . '</span>
                            </div>';
                }
            })
            ->addColumn('size', function ($download) {
                $filesize = filesize(storage_path("app/public/$download->file"));
                return formatSizeUnits($filesize);
            })
            ->editColumn('lokasi_file', function ($download) {
                if($download->lokasi_file == ""){
                    return "-";
                }else{
                    $nama_lokasi = $download->lokasi_file;
                    return '<a href=' . route("lokasiFile.lihat", $download->lokasi_id) . '>'. $nama_lokasi .'</a>';
                }
            })
            ->addColumn('action', function ($data) {
                $button = '<a href=' . route("berkas.edit", $data->id) . ' class="btn btn-primary btn-sm">Edit</a>';
                $button .= '<a href=' . route("berkas.delete", $data->id) . ' class="btn btn-danger btn-sm swalUmum" onclick="deleted(event)">Hapus</a>';
                return $button;
            })
            ->addColumn('download', function ($data) {
                return '<a href=' . asset("storage/$data->file") . ' class="btn btn-primary btn-sm">Unduh</a>';
            })
            ->rawColumns(['action', 'tipe', 'download', 'lokasi_file'])
            ->make(true);
    }

    public function add()
    {
        $download  = new Download();
        $lokasiFile = LokasiFile::orderBy('nama')->get();
        return view('berkas.add', compact('download', 'lokasiFile'));
    }

    public function edit(Download $download)
    {
        $lokasiFile = LokasiFile::orderBy('nama')->get();
        return view('berkas.add', compact('download', 'lokasiFile'));
    }

    public function delete(Download $download)
    {
        if ($download->file != "") {
            Storage::delete($download->file);
        }
        $cr = $download->delete();
        if ($cr) {
            return redirect()->back()->with('success', 'Berhasil menghapus data');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|string',
            'pengajar_id' => 'nullable',
            'file' => 'max:2048|mimes:png,jpg,jpeg,doc,docx,pdf,xls,xlsx,ppt,pptx',
        ];

        $id = request('id');
        if (!$id) {
            $rules['file'] = "required|max:2048|mimes:png,jpg,jpeg,doc,docx,pdf,xls,xlsx,ppt,pptx";
        }
        $data = request()->validate($rules);
        $data['is_public'] = 0;
        $slug_lokasi = "";
        if (request('lokasi_id') != "") {
            $lokasi = json_decode(request('lokasi_id'), true);
            $data['lokasi_id'] = $lokasi['id'];
            $slug_lokasi = $lokasi['slug'];
        }

        $pengajar_id = request('pengajar_id');
        if (request()->file('file')) {
            if ($id) {
                $img = Download::where('id', $id)->value('file');
                Storage::delete($img);
            }
            if ($pengajar_id != "") {
                $path =  "/uploads" . "/" . $pengajar_id;
            } elseif ($slug_lokasi != "") {
                $path =  "/uploads/berkas" . "/" . $slug_lokasi;
            } else {
                $path = "uploads/berkas";
            }
            $data['file'] = request()->file('file')->storeAs($path, Str::slug(request('nama')) . "-" . date("ymdhis") . "." . request()->file('file')->extension());
        }

        $cr = Download::updateOrCreate(['id' => $id], $data);


        if ($pengajar_id != "") {
            if ($cr) {
                return redirect(route("pengajar.berkas", $pengajar_id))->with('success', 'Berhasil memperbaharui data');
            } else {
                return redirect(route("pengajar.berkas", $pengajar_id))->with('error', 'Gagal memperbaharui data');
            }
        } else {
            if ($cr) {
                return redirect(route("berkas.index"))->with('success', 'Berhasil memperbaharui data');
            } else {
                return redirect(route("berkas.index"))->with('error', 'Gagal memperbaharui data');
            }
        }
    }
}
