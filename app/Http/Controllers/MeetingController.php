<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    /**
     * Créer un créneau de réunion (Professeur uniquement).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'start_at' => 'required|date|after:now',
            'end_at' => 'required|date|after:start_at',
        ]);

        $course = Course::findOrFail($validated['course_id']);

        // Vérifier que le cours appartient bien à ce professeur
        if ($course->user_id !== Auth::id()) {
            abort(403, 'Action non autorisée.');
        }

        Meeting::create([
            'course_id' => $validated['course_id'],
            'teacher_id' => Auth::id(),
            'student_id' => null, // Créneau libre au départ
            'start_at' => $validated['start_at'],
            'end_at' => $validated['end_at'],
            'jitsi_room' => 'Studa_Meeting_' . uniqid() . '_' . rand(1000, 9999),
        ]);

        return redirect()->back()->with('success', 'Créneau de réunion en direct créé avec succès.');
    }

    /**
     * Supprimer un créneau de réunion (Professeur uniquement).
     */
    public function destroy(Meeting $meeting)
    {
        if ($meeting->teacher_id !== Auth::id()) {
            abort(403, 'Action non autorisée.');
        }

        $meeting->delete();

        return redirect()->back()->with('success', 'Réunion supprimée avec succès.');
    }

    /**
     * Réserver un créneau (Étudiant uniquement).
     */
    public function book(Request $request, Meeting $meeting)
    {
        if (Auth::user()->role !== 'student') {
            abort(403, 'Seuls les étudiants peuvent réserver des réunions.');
        }

        if ($meeting->student_id !== null) {
            return redirect()->back()->with('error', 'Ce créneau est déjà réservé.');
        }

        if ($meeting->start_at->isPast()) {
            return redirect()->back()->with('error', 'Ce créneau est déjà passé.');
        }

        $meeting->update([
            'student_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Votre réservation pour cette visioconférence a été enregistrée.');
    }

    /**
     * Annuler une réservation (Étudiant uniquement).
     */
    public function cancel(Meeting $meeting)
    {
        if ($meeting->student_id !== Auth::id()) {
            abort(403, 'Action non autorisée.');
        }

        $meeting->update([
            'student_id' => null,
        ]);

        return redirect()->back()->with('success', 'Votre réservation a été annulée. Le créneau est de nouveau libre.');
    }

    /**
     * Rejoindre la visioconférence Jitsi.
     */
    public function join(Meeting $meeting)
    {
        $user = Auth::user();

        // Vérifier que l'utilisateur fait partie de la réunion
        if ($meeting->teacher_id !== $user->id && $meeting->student_id !== $user->id) {
            abort(403, 'Vous ne faites pas partie de cette réunion.');
        }

        return view('meetings.join', compact('meeting'));
    }
}
