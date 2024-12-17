<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;

class UserMissionController extends Controller
{
    /**
     * List all missions for the authenticated user.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $missions = Mission::where('user_id', $user->id)->get();

        return response()->json([
            'missions' => $missions,
        ]);
    }



    /**
     * Verify a mission's code.
     */
    public function verifyCode(Request $request, $id)
    {
        $validated = $request->validate([
            'code' => 'required|string',
        ]);

        $mission = Mission::find($id);

        if (!$mission) {
            return response()->json(['message' => 'Mission not found'], 404);
        }

        if ($mission->code === $validated['code']) {
            $mission->update(['code_verify' => true]);

            return response()->json([
                'message' => 'Code verified successfully.',
                'mission' => $mission,
            ]);
        }

        return response()->json(['message' => 'Invalid code.'], 400);
    }
}
