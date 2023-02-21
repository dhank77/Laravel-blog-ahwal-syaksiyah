<?php

use App\Models\Master\Menu;

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

function dmyhi($tanggal)
{
    return date("d-m-Y H:i", strtotime($tanggal));
}

function get_menu()
{
    return Menu::whereNull('parent_id')->get();
}

function get_child_menu($id)
{
    return Menu::where('parent_id', $id)->get();
}