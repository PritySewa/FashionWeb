<div class="mb-3">
    <label class="form-label">Title *</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $badge->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Icon Image *</label>
    <input type="file" name="icon_image" class="form-control" required>
</div>


<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $badge->description ?? '') }}</textarea>
</div>
