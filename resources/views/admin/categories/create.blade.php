<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex  p-2 m-2 ">
                <a href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">All Categories</a>
            </div>

            <div class="md:grid w-full  md:gap-6 p-2 py-4">
                <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">

                    <div class="overflow-hidden w-full shadow sm:rounded-md">
                        <div class="px-4 py-5 w-full sm:p-6 bg-slate-100">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-  sm:col-span-4 ">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" name="name" id="name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-400 @enderror">
                                    @error('name')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6   sm:col-span-4">
                                    <label for="image" class="block text-sm font-medium text-gray-700">
                                        image</label>
                                    <input type="file" name="image" id="image"
                                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white duration-30 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('image') border-red-400 @enderror">
                                    @error('image')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6  sm:col-span-4">
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="description" rows="3"
                                        class="@error('description') border-red-400 @enderror mt-1 block w-full rounded-md border-gray-300 shadow-sm  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                    @error('description')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class=" px-2 py-3 mt-4  p-4text-right sm:px-4">
                                <button type="submit"
                                    class="px-4 py-2 rounded-md  bg-indigo-500  text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Store</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>
