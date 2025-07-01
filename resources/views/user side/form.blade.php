@php $about = $about ?? null; @endphp

<div>
    <label class="block font-medium">Name</label>
    <input type="text" name="name" value="{{ old('name', $about->name ?? '') }}" class="w-full border p-2 rounded" required>
</div>

<div>
    <label class="block font-medium">Introduction</label>
    <input type="text" name="introduction" value="{{ old('introduction', $about->introduction ?? '') }}" class="w-full border p-2 rounded" required>
</div>

<div>
    <label class="block font-medium">Description</label>
    <input type="text" name="description" value="{{ old('description', $about->description ?? '') }}" class="w-full border p-2 rounded" required>
</div>

<div>
    <label class="block font-medium">Features</label>
    <input type="text" name="features" value="{{ old('features', $about->features ?? '') }}" class="w-full border p-2 rounded" required>
</div>

<div>
    <label class="block font-medium">Image</label>
    <input type="file" name="images" class="w-full border p-2 rounded">
    @if (!empty($about->images))
        <img src="{{ asset('storage/' . $about->images) }}" class="w-24 h-24 mt-2 object-cover">
    @endif
</div>
