<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Category;

class verifyCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $categori_Id= $request->input("categori_Id");
        $category= Category::find($categori_Id);

        if(!$categori_Id){
            return redirect()->back()->with("error","Invalid Category");
        }

        return $next($request);
    }
}
