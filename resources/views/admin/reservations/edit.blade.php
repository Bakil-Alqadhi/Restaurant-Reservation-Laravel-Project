<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex  p-2 m-2 ">
                <a href="{{ route('admin.reservations.index') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">All Reservations</a>
            </div>

            <div class="md:grid w-full  md:gap-6 p-2 py-4">
                <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="overflow-hidden w-full shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 w-full sm:p-6 bg-slate-100">
                            {{-- <div class="grid grid-cols-6 gap-6"> --}}
                            <div class="col-span-6  sm:col-span-4 ">
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First
                                    Name</label>
                                <input type="text" name="first_name" id="first_name"
                                    value="{{ old('first_name', $reservation->first_name) }}"
                                    class="@error('first_name') border-red-400 @enderror mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('first_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 mt-3 sm:col-span-4 ">
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last
                                    Name</label>
                                <input type="text" name="last_name" id="last_name"
                                    value="{{ old('last_name', $reservation->last_name) }}"
                                    class="@error('last_name') border-red-400 @enderror mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('last_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- </div> --}}
                            <div class="col-span-6 mt-3 sm:col-span-4">
                                <label for="email"class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $reservation->email) }}"
                                    class="@error('email') border-red-400 @enderror mt-1 block w-full rounded-md border-gray-300 shadow-sm  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('email')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 mt-3 sm:col-span-4 ">
                                <label for="tel_number" class="block text-sm font-medium text-gray-700">Phone
                                    Number</label>
                                <input type="text" name="tel_number" id="tel_number"
                                    value="{{ old('tel_number', $reservation->tel_number) }}"
                                    class="@error('tel_number') border-red-400 @enderror mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('tel_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 mt-3 sm:col-span-4">
                                <label for="res_time"class="block text-sm font-medium text-gray-700">Reservation
                                    Date</label>
                                <input type="datetime-local" name="res_time" id="res_time"
                                    value="{{ old('res_time', $reservation->res_time) }}"
                                    class="@error('res_time') border-red-400 @enderror mt-1 block w-full rounded-md border-gray-300 shadow-sm  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('res_time')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 mt-3 sm:col-span-4">
                                <label for="guest_number" class="block text-sm font-medium text-gray-700">Guest
                                    Number</label>
                                <input type="number" name="guest_number" id="guest_number" rows="3"
                                    value="{{ old('guest_number', $reservation->guest_number) }}"
                                    class="@error('guest_number') border-red-400 @enderror mt-1 block w-full rounded-md border-gray-300 shadow-sm  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></input>
                                @error('guest_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 mt-3 sm:col-span-4">
                                <label for="table_id"class="block text-sm font-medium text-gray-700">Table</label>
                                <select id="table_id" name="table_id"
                                    class="@error('table_id') border-red-400 @enderror rounded-lg w-full mt-2">
                                    @foreach ($tables as $table)
                                        <option class="rounded-lg" @selected($reservation->table_id == $table->id)
                                            value="{{ $table->id }}">{{ $table->name }}
                                            ({{ $table->guest_number }} Guests)
                                        </option>
                                    @endforeach
                                </select>
                                @error('table_id')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class=" px-2 py-3 mt-4  p-4text-right sm:px-4">
                                <button type="submit"
                                    class="px-4 py-2 rounded-md  bg-indigo-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>
