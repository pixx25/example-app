<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page.
     *
     * This method is responsible for rendering the "welcome" view,
     * which serves as the landing page for the application.
     *
     * @return \Illuminate\View\View
     */
    public function welcome()
    {
        // Render and return the 'welcome' view
        return view('welcome');
    }
}
