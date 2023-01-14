<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex  p-2 m-2 ">
                <a href="{{ route('admin.tables.index') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">All Tabls</a>
            </div>

            <div class="md:grid w-full  md:gap-6 p-2 py-4">
                <form action="{{ route('admin.tables.update', $table->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="overflow-hidden w-full shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 w-full sm:p-6 bg-slate-100">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-  sm:col-span-4 ">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $table->name }}"
                                        class="@error('name') border-red-400 @enderror mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('name')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6  sm:col-span-4">
                                    <label for="guest_number" class="block text-sm font-medium text-gray-700">Guest
                                        Number</label>
                                    <input type="number" name="guest_number" id="guest_number" rows="3"
                                        value="{{ $table->guest_number }}"
                                        class="@error('guest_number') border-red-400 @enderror mt-1 block w-full rounded-md border-gray-300 shadow-sm  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></input>
                                    @error('guest_number')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-6  sm:col-span-4">
                                <label for="status"class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status"
                                    class="@error('status') border-red-400 @enderror rounded-lg w-full mt-2">
                                    @foreach ($status as $key => $value)
                                        <option class="rounded-lg" @selected($table->status == $key)
                                            value="{{ $key }}">{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6  sm:col-span-4">
                                <label for="location"class="block text-sm font-medium text-gray-700">Location
                                </label>
                                <select id="location" name="location"
                                    class="@error('status') border-red-400 @enderror rounded-lg w-full mt-2">
                                    @foreach ($locations as $key => $value)
                                        <option class="rounded-lg" @selected($table->location == $key)
                                            value="{{ $key }}">{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location')
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
