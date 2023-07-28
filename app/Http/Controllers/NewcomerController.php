<?php

namespace App\Http\Controllers;

use App\Models\Newcomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewcomerEmail;
use Illuminate\Support\Facades\Validator;

class NewcomerController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'surname' => 'required|string',
            'othername' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'phonenumber' => 'required|string',
            'marital_status' => 'required|string',
            'age_bracket' => 'required|string',
            'occupation' => 'required|string',
            'nationality' => 'required|string',
            'visitable' => 'boolean',
            'state_of_residence' => 'required|string',
            'nearest_bus_stop' => 'required|string',
            'house_address' => 'required|string',
            'special_message' => 'required|string',
            'prayer_request' => 'required|string',
            'email' => 'required|email|unique:newcomers',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Handle image upload
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePicturePath = $profilePicture->store('profile_pictures', 'public');
        }

        // Create a new Newcomer instance
        $newcomer = NewComer::create([
            'title' => $request->input('title'),
            'surname' => $request->input('surname'),
            'othername' => $request->input('othername'),
            'gender' => $request->input('gender'),
            'phonenumber' => $request->input('phonenumber'),
            'marital_status' => $request->input('marital_status'),
            'age_bracket' => $request->input('age_bracket'),
            'occupation' => $request->input('occupation'),
            'nationality' => $request->input('nationality'),
            // 'visitable' => false,
            // 'visitable' => $request->input('visitable'),
            'state_of_residence' => $request->input('state_of_residence'),
            'nearest_bus_stop' => $request->input('nearest_bus_stop'),
            'house_address' => $request->input('house_address'),
            'special_message' => $request->input('special_message'),
            'prayer_request' => $request->input('prayer_request'),
            'email' => $request->input('email'),
            'profile_picture' => basename($profilePicturePath),
        ]);

        return response()->json($newcomer, 201);
    }

    public function index()
    {
        $newcomers = Newcomer::all();

        return response()->json($newcomers);
    }

    public function show($id)
    {
        $newcomer = Newcomer::findOrFail($id);

        return response()->json($newcomer);
    }

    public function update(Request $request, $id)
    {
        $newComer = NewComer::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'surname' => 'required|string',
            'othername' => 'nullable|string',
            'gender' => 'required|in:Male,Female',
            'phonenumber' => 'required|string',
            'marital_status' => 'required|string',
            'age_bracket' => 'required|string',
            'occupation' => 'required|string',
            'nationality' => 'required|string',
            'visitable' => 'boolean',
            'state_of_residence' => 'required|string',
            'nearest_bus_stop' => 'required|string',
            'house_address' => 'required|string',
            'special_message' => 'nullable|string',
            'prayer_request' => 'nullable|string',
            'email' => 'required|email',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Handle image upload
        $profilePicturePath = $newComer->profile_picture;
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePicturePath = $profilePicture->store('profile_pictures', 'public');
        }

        $newComer->update([
            'title' => $request->input('title'),
            'surname' => $request->input('surname'),
            'othername' => $request->input('othername'),
            'gender' => $request->input('gender'),
            'phonenumber' => $request->input('phonenumber'),
            'marital_status' => $request->input('marital_status'),
            'age_bracket' => $request->input('age_bracket'),
            'occupation' => $request->input('occupation'),
            'nationality' => $request->input('nationality'),
            'visitable' => $request->input('visitable'),
            'state_of_residence' => $request->input('state_of_residence'),
            'nearest_bus_stop' => $request->input('nearest_bus_stop'),
            'house_address' => $request->input('house_address'),
            'special_message' => $request->input('special_message'),
            'prayer_request' => $request->input('prayer_request'),
            'email' => $request->input('email'),
            'profile_picture' => basename($profilePicturePath),
        ]);

        return response()->json($newComer, 200);
    }

    public function destroy($id)
    {
        $newcomer = Newcomer::findOrFail($id);
        $newcomer->delete();
        $this->index();
        return response()->json(null, 204);
    }

    public function sendSingleEmail(Request $request, $id)
    {
        $message = $request->input('message');
        $newcomer = Newcomer::findOrFail($id);
        Mail::to($newcomer->email)->send(new NewcomerEmail($newcomer, $message));
        return response()->json(['message' => 'Email sent successfully']);
    }

    public function sendBulkEmail(Request $request)
    {
        $message = $request->input('message');

        $newComers = NewComer::all();

        foreach ($newComers as $newComer) {
            Mail::to($newComer->email)->send(new NewComerEmail($newComer, $message));
        }

        return response()->json(['message' => 'Email sent successfully']);
    }

    public function search($email){
        return Newcomer::where('email','like','%'.$email.'%')->get();
    }
}
