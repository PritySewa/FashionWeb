@php $about = $about ?? null; @endphp

    <!-- Name -->
<div class="mb-3">
    <label class="block font-medium mb-1">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $about->name ?? '') }}"
           class="w-full border p-2 rounded @error('name') border-red-500 @enderror" required>
    @error('name')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Introduction -->
<div class="mb-3">
    <label class="block font-medium mb-1">Introduction</label>
    <input type="text" name="introduction" class="form-control" value="{{ old('introduction', $about->introduction ?? '') }}"
           class="w-full border p-2 rounded @error('introduction') border-red-500 @enderror" required>
    @error('introduction')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Description -->
<div class="mb-4">
    <label class="block font-medium mb-1">Description</label>
    <input type="text" name="description" class="form-control" value="{{ old('description', $about->description ?? '') }}"
           class="w-full border p-2 rounded @error('description') border-red-500 @enderror" required>
    @error('description')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Features -->
<div class="mb-4">
    <label class="block font-medium mb-1">Features</label>
    <input type="text" name="features" class="form-control" value="{{ old('features', $about->features ?? '') }}"
           class="w-full border p-2 rounded @error('features') border-red-500 @enderror" required>
    @error('features')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Image Upload -->
<div class="mb-4">
    <label class="block font-medium mb-1">Image</label>
    <input type="file" name="images" class="w-full border p-2 rounded @error('images') border-red-500 @enderror">
    @error('images')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror

    @if (!empty($about?->images))
        <img src="{{ asset('storage/' . $about->images) }}" class="w-16 h-16 mt-2 object-cover rounded shadow">
    @endif
</div>
