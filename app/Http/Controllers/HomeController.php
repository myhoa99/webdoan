<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index()
    {
        $id = Auth::id();
        $recipes = DB::table('recipes')->count();
        $categories = DB::table('categories')->count();
        $cuisines = DB::table('cuisines')->count();
        $users = DB::table('users')->count();
        $pendingRecipes = DB::table('recipes')
            ->where('status', '=', '1')
            ->count();
        $approvedRecipes = DB::table('recipes')
            ->where('status', '=', '2')
            ->count();
        $disapprovedRecipes = DB::table('recipes')
            ->where('status', '=', '3')
            ->count();
        $topFiveRecipes = Recipe::orderBy('noOfLikes','DESC')->limit(5)->get();
        $mostActiveUsers = User::withCount('recipes as recipeCount')->where('users.id', '!=', $id)->orderBy('recipeCount','DESC')->limit(5)->get();
        return view('dashboard', compact('recipes', 'categories', 'cuisines', 'users', 'pendingRecipes', 'approvedRecipes', 'disapprovedRecipes', 'topFiveRecipes', 'mostActiveUsers'));
    }
}
