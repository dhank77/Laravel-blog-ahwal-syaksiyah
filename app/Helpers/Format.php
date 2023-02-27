<?php

use App\Models\Artikel;
use App\Models\Master\Kategori;
use App\Models\Master\Komponen;
use App\Models\Master\Menu;
use Illuminate\Support\Str;

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

function get_5artikel($slug)
{
    $artikel = Artikel::with('kategori')->where("slug", "!=", $slug)->latest()->limit(5)->get();
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