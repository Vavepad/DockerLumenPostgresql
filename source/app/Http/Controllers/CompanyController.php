<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class CompanyController extends BaseController
{

    public function list()
    {
        $user = \Auth::user();
        return Company::query()->orderBy("created_at", "DESC")->where("user_id", $user->id)->get();
    }

    public function company($id)
    {
        return Company::findOrFail($id);
    }

    public function create(Request $request)
    {
        $user = \Auth::user();
        // в задаче не стояла информация о технических требований данных полей
        $this->validate($request, [
            'title' => 'required|min:3|max:255',
            'phone' => 'required|min:10|max:15',
            'description' => 'required|min:3|max:65555',
        ]);
        try {
            return Company::create([
                "title" => $request->get('title'),
                "phone" => $request->get('phone'),
                "description" => $request->get('description'),
                "user_id" => $user->id,
            ]);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
