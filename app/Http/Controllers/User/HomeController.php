<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index() {
    $loggedIn = true;
    $menus = array(
        array(
            'label' => 'Home',
            'href' => '#'
        ),
        array(
            'label' => 'Books',
            'href' => '#'
        ),
    );

    return view('pages.user.home', array(
        'loggedIn' => $loggedIn,
        'menus' => $menus
    ));
}  
}
