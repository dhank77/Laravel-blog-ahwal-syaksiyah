<?php

use App\Models\Artikel;
use App\Models\FormulirDetail;
use App\Models\Master\Kategori;
use App\Models\Master\Komponen;
use App\Models\Master\Menu;
use Illuminate\Support\Str;

function cleanString($input) {
    $cleanedString = preg_replace('/[^a-zA-Z0-9_]/', '', $input);
    return $cleanedString;
}

function convertTanggalImport($input) {
    if(is_numeric($input)){
        $tgl = ($input - 25569) * 86400;
    }else{
        $tgl = str_replace('/', '-', $input);
        $tgl = strtotime($tgl);
    }
    $tanggal_sk = date('Y-m-d', $tgl);
    return $tanggal_sk;
}

function validateInput($input) {
    $pattern = '/^[a-zA-Z0-9_]+$/';

    if (preg_match($pattern, $input)) {
        return true;
    } else {
        return false;
    }
}

function status($status)
{
    switch ($status) {
        case '1':
            return "<div class='badge rounded-pill bg-primary'>Publish</div>";
        case '0':
            return "<div class='badge rounded-pill bg-secondary'>Draft</div>";

        default:
            break;
    }
}


function bulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function tanggal_indo($date)
{
    $tgl = date('d', strtotime($date));
    $bulan = date('m', strtotime($date));
    $tahun = date('Y', strtotime($date));

    return $tgl . " " . bulan($bulan) . " " . $tahun;
}

function jam_indo($tanggal)
{
    return $tanggal ? date("H:i", strtotime("$tanggal")) : "00:00";
}

function dmyhi($tanggal)
{
    return date("d-m-Y H:i", strtotime($tanggal));
}

function get_menu()
{
    return Menu::whereNull('parent_id')->orderBy('urutan')->get();
}

function get_child_menu($id)
{
    return Menu::where('parent_id', $id)->orderBy('urutan')->get();
}

function get_kategori()
{
    return Kategori::orderBy('nama')->get();
}

function get_kategori_all($id)
{
    $exp = explode(',', $id);
    $send = '';
    foreach ($exp as $key => $value) {
        if ($key == 0) {
            $send = Kategori::where('id', $value)->value('nama');
        } else {
            $send .= ", " . Kategori::where('id', $value)->value('nama');
        }
    }
    return $send;
}

function get_5artikel($slug)
{
    $artikel = Artikel::where('status', 1)
                        ->with('kategori')
                        ->where("slug", "!=", $slug)
                        ->latest()
                        ->limit(4)
                        ->get();
    return $artikel;
}

function get_footer()
{
    return Komponen::where('nama', 'footer')->first();
}

function str_limit($text, $limit = 50)
{
    return Str::limit($text, $limit);
}

function roles()
{
    return auth()->user()->getRoleNames()[0];
}

function getRomawi($bln)
{

    switch ($bln) {
        case 1:
            return "I";
            break;
        case 2:
            return "II";
            break;
        case 3:
            return "III";
            break;
        case 4:
            return "IV";
            break;
        case 5:
            return "V";
            break;
        case 6:
            return "VI";
            break;
        case 7:
            return "VII";
            break;
        case 8:
            return "VIII";
            break;
        case 9:
            return "IX";
            break;
        case 10:
            return "X";
            break;
        case 11:
            return "XI";
            break;
        case 12:
            return "XII";
            break;
    }
}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function convertWordToPdf($link)
{
    $curl = curl_init();

    $link = urlencode($link);
    $url = "https://psg4-word-view.officeapps.live.com/wv/WordViewer/request.pdf?WOPIsrc=http%3A%2F%2Fpsg4-view-wopi%2Ewopi%2Eonline%2Eoffice%2Enet%3A808%2Foh%2Fwopi%2Ffiles%2F%40%2FwFileId%3FwFileId%3D$link&access_token=1&access_token_ttl=0&z=dce785126488e4f952cc69b50e330603d7517b89c1f01bd14796eee9b097a030&type=downloadpdf&useNamedAction=1";
    curl_setopt_array($curl, array(
        CURLOPT_URL => "$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

function jumlahPendaftarFormulir($id){
    return FormulirDetail::where('formulir_id', $id)->count();
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}