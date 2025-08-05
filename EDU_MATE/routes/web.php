<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\CustomUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Availability;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/register', function () {
    return view('register');
});

Route::get('/register/student', function () {
    return view('register-student');
});

Route::get('/register/tutor', function () {
    return view('register-tutor');
});

Route::post('/register/student', function (Request $request) {
    CustomUser::create([
        'role' => 'student',
        'name' => $request->name,
        'email' => $request->email,
        'class' => $request->class,
        'bio' => $request->bio,
        'password' => bcrypt($request->password),
    ]);
    return redirect('/')->with('success', 'Student registered successfully!');
});

Route::post('/register/tutor', function (Request $request) {
    CustomUser::create([
        'role' => 'tutor',
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'bio' => $request->bio,
        'password' => bcrypt($request->password),
    ]);
    return redirect('/')->with('success', 'Tutor registered successfully!');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/login/student', function () {
    return view('login-student');
});

Route::get('/login/tutor', function () {
    return view('login-tutor');
});

Route::post('/login/student', function (Request $request) {
    $user = \App\Models\CustomUser::where('email', $request->email)->where('role', 'student')->first();

    if ($user && Hash::check($request->password, $user->password)) {
        Session::put('user', $user);
        return redirect('/profile');
    } else {
        return back()->with('error', 'Invalid credentials');
    }
});

Route::post('/login/tutor', function (Request $request) {
    $user = \App\Models\CustomUser::where('email', $request->email)
        ->where('role', 'tutor')
        ->first();

    if ($user && Hash::check($request->password, $user->password)) {
        Session::put('user', $user);

        $existingAvailability = Availability::where('tutor_id', $user->id)->exists();

        if ($existingAvailability) {
            return redirect('/profile'); // Already set → go to profile
        } else {
            return redirect('/tutor/set-availability'); // New tutor → set availability
        }
    } else {
        return back()->with('error', 'Invalid credentials');
    }
});

Route::get('/profile', function () {
    $user = Session::get('user');

    if ($user->role === 'student') {
        $bookings = \App\Models\Booking::where('student_id', $user->id)
            ->with('tutor') // so we can show tutor name/email
            ->get();

        return view('student-profile', compact('user', 'bookings'));
    }

    // ... Tutor profile can be handled separately
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('/');
});


// Edit profile page
Route::get('/profile/edit', function () {
    if (!Session::has('user')) return redirect('/login');
    $user = Session::get('user');
    return view('edit-profile', compact('user'));
});

Route::post('/profile/edit', function (Request $request) {
    $user = \App\Models\CustomUser::find(Session::get('user')->id);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->bio = $request->bio;

    if ($user->role === 'student') {
        $user->class = $request->class;
    } elseif ($user->role === 'tutor') {
        $user->subject = $request->subject;

        // Handle Availability Update
        $timeSlot = $request->anytime ? 'Anytime' : $request->start_time . ' - ' . $request->end_time;

        $availability = Availability::where('tutor_id', $user->id)->first();
        if ($availability) {
            $availability->update(['time_slot' => $timeSlot]);
        } else {
            Availability::create([
                'tutor_id' => $user->id,
                'time_slot' => $timeSlot
            ]);
        }
    }

    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();
    Session::put('user', $user);

    return redirect('/profile')->with('success', 'Profile updated!');
});
Route::get('/search-tutors', function (Request $request) {
    if (!Session::has('user') || Session::get('user')->role !== 'student') {
        return redirect('/login');
    }

    $subject = $request->input('subject');

    $tutors = \App\Models\CustomUser::where('role', 'tutor')
                ->where('subject', 'LIKE', "%$subject%")
                ->get();

    return view('search-results', compact('tutors', 'subject'));
});

Route::post('/add-tutor', function (Request $request) {
    if (!Session::has('user') || Session::get('user')->role !== 'student') {
        return redirect('/login');
    }

    DB::table('student_tutor')->insert([
        'student_id' => Session::get('user')->id,
        'tutor_id' => $request->tutor_id,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return back()->with('success', 'Tutor added successfully!');
});
Route::get('/view-all-tutors', function () {
    if (!Session::has('user') || Session::get('user')->role !== 'student') {
        return redirect('/login');
    }

    $tutors = \App\Models\CustomUser::where('role', 'tutor')->get();
    return view('view-all-tutors', compact('tutors'));
});

Route::get('/tutor/set-availability', function () {
    $user = Session::get('user');
    if (!$user || $user->role !== 'tutor') return redirect('/login');

    return view('set-availability');
});

Route::post('/tutor/set-availability', function (Request $request) {
    $user = Session::get('user');
    if (!$user || $user->role !== 'tutor') return redirect('/login');

    $timeSlot = $request->anytime ? 'Anytime' : $request->start_time . ' - ' . $request->end_time;

    Availability::create([
        'tutor_id' => $user->id,
        'time_slot' => $timeSlot
    ]);

    return redirect('/profile')->with('success', 'Availability saved!');
});

Route::get('/view-all-tutors', function () {
    $tutors = \App\Models\CustomUser::with('availability') // 🔥 add this
        ->where('role', 'tutor')
        ->get();

    return view('view-all-tutors', compact('tutors'));
});

Route::get('/book-tutor/{tutor_id}', function ($tutor_id) {
    $tutor = \App\Models\CustomUser::with('availability')->find($tutor_id);
    return view('book-tutor', compact('tutor'));
});

Route::post('/book-tutor', function (Request $request) {
    $request->validate([
        'start_time' => 'required',
        'end_time' => 'required',
    ]);

    // STEP 1: Convert input times to timestamps
    $start = strtotime($request->start_time);  // e.g. "10:00" => timestamp
    $end = strtotime($request->end_time);      // e.g. "12:00" => timestamp

    // STEP 2: Calculate duration in hours
    $duration = ($end - $start) / 3600;

    // STEP 3: Check if duration is between 1 and 2 hours
    if ($duration < 1 || $duration > 2) {
        return back()->with('error', 'You can only book for 1 or 2 hours.');
    }

    // STEP 4: Save booking to database
    $student_id = Session::get('user')->id;
    \App\Models\Booking::create([
        'student_id' => $student_id,
        'tutor_id' => $request->tutor_id,
        'booked_time_start' => $request->start_time,
        'booked_time_end' => $request->end_time,
    ]);

    return redirect('/profile')->with('success', 'Booking confirmed!');
});
Route::post('/update-profile', function (Request $request) {
    $user = CustomUser::find(Session::get('user')->id);

    // Update basic fields
    $user->name = $request->name;
    $user->email = $request->email;
    $user->bio = $request->bio;

    if ($user->role === 'student') {
        $user->class = $request->class;
    } elseif ($user->role === 'tutor') {
        $user->subject = $request->subject;
    }

    // Handle password change
    if (!empty($request->password)) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    // Update session
    Session::put('user', $user);

    // Handle tutor availability
    if ($user->role === 'tutor') {
        $time_slot = $request->has('anytime') ? 'Anytime' : $request->start_time . ' - ' . $request->end_time;

        Availability::updateOrCreate(
            ['user_id' => $user->id],
            ['time_slot' => $time_slot]
        );
    }

    return redirect('/profile')->with('success', 'Profile updated!');
});


Route::get('/edit-profile', function () {
    $user = Session::get('user');

    return view('edit-profile', compact('user'));
});
