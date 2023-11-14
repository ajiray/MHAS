<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\AcceptedAppointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class AppointmentController extends Controller
{
    public function bookAppointment(Request $request) {
        $incomingFields = $request->validate([
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'appointment_type' => 'required',
            'appointment_reason' => 'required'
        ]);
    
        $appointmentDateTime = Carbon::parse($incomingFields['appointment_date'] . ' ' . $incomingFields['appointment_time']);
        $currentDateTime = now();
    
        // Check if the appointment time is in the past or less than 30 minutes from now
        if ($appointmentDateTime <= $currentDateTime || $currentDateTime->diffInMinutes($appointmentDateTime) < 30) {
            return redirect()->back()->with('error', 'Please select an appointment time that is at least 30 minutes from now.');
        }

        $existingAppointment = Appointment::where('user_id', auth()->id())->first();

    if ($existingAppointment) {
        return redirect()->back()->with('one', 'You can only book one appointment at a time.');
    }
    
        $appointmentData = [
            'date' => strip_tags($incomingFields['appointment_date']),
            'time' => strip_tags($incomingFields['appointment_time']),
            'type' => strip_tags($incomingFields['appointment_type']),
            'reason' => strip_tags($incomingFields['appointment_reason']),
            'user_id' => auth()->id(),
        ];
    
        Appointment::create($appointmentData);
        return redirect('/appointment')->with('success', 'Success! Your appointment has been booked.');
    }
    
public function cancelAppointment(Appointment $appointment) {
    $appointment->delete();
    
    return redirect('/appointment')->with('delete', 'Success! The appointment has been cancelled');
}

public function understandAppointment(Appointment $appointment) {
    $appointment->delete();
    
    return redirect('/appointment')->with('understand', 'Thank you for your understanding.');
}

public function acceptAppointment(Appointment $appointment) {
    // Check for time conflicts
    $existingAppointments = Appointment::where('date', $appointment->date)
        ->where('status', 'approved')
        ->get();

    $proposedStart = Carbon::parse($appointment->date . ' ' . $appointment->time);
    $proposedEnd = $proposedStart->copy()->addHour(); // Assuming appointments are 1 hour long

    foreach ($existingAppointments as $existing) {
        $existingStart = Carbon::parse($existing->date . ' ' . $existing->time);
        $existingEnd = $existingStart->copy()->addHour();

        if ($proposedStart < $existingEnd && $proposedEnd > $existingStart) {
            // There's a time conflict
            $appointment->update(['status' => 'declined (Conflict of Schedule)']);

            $appointment->save();

            return redirect()->back()->with('decline', 'This appointment has been declined due to a time conflict.');
        }
    }

    // If no conflict, mark the appointment as approved
    $appointment->update(['status' => 'approved']);
    $appointment->save();

    // Store the accepted appointment in the 'accepted_appointments' table
    $acceptedAppointment = new AcceptedAppointment;
    $acceptedAppointment->user_id = $appointment->user_id;
    $acceptedAppointment->appointment_id = $appointment->id;
    $acceptedAppointment->save();

    return redirect()->back()->with('success', 'Appointment has been approved successfully.');
}


public function declineAppointment(Appointment $appointment) {
    
    $reason = request('reason'); // Get the reason from the form
    $appointment->update(['status' => 'declined (' . $reason . ')']);
    
    return redirect('/adminappointment')->with('decline', 'Success! The appointment has been declined with reason: ' . $reason);
}


public function markAsDone($appointment)
{
    $appointment = Appointment::find($appointment);

    if ($appointment) {
        $appointment->deleteWithAcceptedAppointments();
        return redirect('/adminappointment')->with('delete', 'Success! The appointment is done');
    } else {
        // Handle the case where the appointment doesn't exist
    }
}



}
