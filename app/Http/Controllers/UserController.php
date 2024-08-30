<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //$users = User::all(); // Получаем всех пользователей из базы данных
        $users = User::paginate(6); // Добавлено постраничное разделение
        return response()->json($users); // Возвращаем список пользователей в формате JSON
    }

    public function store(Request $request)
    {

        try {
            // Создание пользователя
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // Возврат успешного JSON-ответа
            return response()->json(['success' => 'User added successfully.'], 201);
        } catch (\Exception $e) {
            // Логирование ошибки и возврат JSON-ответа с ошибкой
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to add user.'], 500);
        }
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:8',
//        ]);
//
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => bcrypt($request->password), // Хэшируем пароль
//        ]);
//
//        //return response()->json($user, 201); // Возвращаем созданного пользователя
//        // Возвращение успешного ответа в формате JSON
//        return response()->json(['success' => 'User added successfully.'], 201);
    }
}
