<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reservations.index', ['reservations' => Reservation::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = Table::where('status', TableStatus::Available)->get();
        return view('admin.reservations.create', ['tables' => $tables]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request)
    {
        // Reservation::create([
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'email' => $request->email,
        //     'tel_number' => $request->tel_number,
        //     'res_time' => $request->res_time,
        //     'table_id' => $request->table_id,
        //     'guest_number' => $request->guest_number
        // ]);

        //or
        $table = Table::findOrFail($request->table_id);
        if($table->guest_number < $request->guest_number){
            return back()->with('warning', 'Please choose the table base on guests.');
        }

        $request_date = Carbon::parse($request->res_time);
        foreach($table->reservations as $res){
            if($res->res_time->format('Y-m-d') == $request_date->format('Y-m-d')){
                return back()->with('warning', 'This table is reserved for this date.');
            }
        }
        Reservation::create($request->validated());
        return to_route('admin.reservations.index')->with('success', 'Reservation has been created successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $tables = Table::where('status', TableStatus::Available)->get();
        return view('admin.reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationStoreRequest $request, Reservation $reservation)
    {
        $table = Table::findOrFail($request->table_id);
        if($table->guest_number < $request->guest_number){
            return back()->with('warning', 'Please choose the table base on guests.');
        }
        $reservations = $table->reservations->where('id', '!=', $reservation->id)->get();
        $request_date = Carbon::parse($request->res_time);
        foreach($reservations as $res){
            if($res->res_time->format('Y-m-d') == $request_date->format('Y-m-d')){
                return back()->with('warning', 'This table is reserved for this date.');
            }
        }
        $reservation->update($request->validated());
        return to_route('admin.reservations.index')->with('success', 'Reservation has been updated successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('danger', 'Reservation has been deleted successfully! ');

    }
}