<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserPreferenceUpdateRequest;

class UserPreferenceController extends Controller
{
    public function show() {
        return response()->json([
            'preferences' => Auth::user()->preferences ?? ['categories' => [], 'providers' => []],
        ]);
    }

    public function update(UserPreferenceUpdateRequest $request) {
        $validated = $request->validate([
            'categories' => 'array',
            'providers' => 'array',
        ]);

        $user = Auth::user();
        $user->preferences = $validated;
        $user->save();

        return response()->json(['message' => 'Preferences updated successfully', 'preferences' => $user->preferences]);
    }

}
