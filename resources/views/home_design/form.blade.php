<div>
    <label class="block font-medium">Title</label>
    <input type="text" name="title" value="{{ old('title', $home->title ?? '') }}" class="form-input w-full" required>
    @error('title') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
</div>

<div>
    <label class="block font-medium">Image</label>
    <input type="file" name="image" class="form-input w-full" {{ isset($home) ? '' : 'required' }}>
    @if(isset($home) && $home->image)
        <img src="{{ asset('storage/' . $home->image) }}" class="w-24 h-24 mt-2 object-cover">
    @endif
    @error('image') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
</div>

<div>
    <label class="block font-medium">Description</label>
    <textarea name="description" class="form-textarea w-full" required>{{ old('description', $home->description ?? '') }}</textarea>
    @error('description') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
</div>

<div>
    <label class="block font-medium">Phone Number</label>
    <input type="text" name="phone_no" value="{{ old('phone_no', $home->phone_no ?? '') }}" class="form-input w-full" required>
    @error('phone_no') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
</div>

<div>
    <label class="block font-medium">Address</label>
    <input type="text" name="address" value="{{ old('address', $home->address ?? '') }}" class="form-input w-full" required>
    @error('address') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
</div>

<div>
    <label class="block font-medium">Email</label>
    <input type="email" name="email" value="{{ old('email', $home->email ?? '') }}" class="form-input w-full" required>
    @error('email') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
</div>
