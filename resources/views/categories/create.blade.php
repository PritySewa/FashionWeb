@extends('templates.create')
@section('create_content')
        <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
            <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg border border-gray-200">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Create New Category</h2>

                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Title --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror">
                        @error('title')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image <span class="text-red-500">*</span></label>
                        <div class="relative flex items-center gap-4">
                            <label class="cursor-pointer px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200">
                                Choose File
                                <input type="file" name="images" accept="image/*" class="hidden @error('images') border-red-500 @enderror">
                            </label>
                            <span class="text-sm text-gray-500">No file chosen</span>
                        </div>
                        @error('images')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status"
                                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-500 @enderror">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('categories.index') }}"
                           class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800">
                            Back
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>

@endsection
