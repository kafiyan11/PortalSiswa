<!-- resources/views/social-links/edit.blade.php -->
<form action="{{ route('social-links.update') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="twitter">Twitter</label>
        <input type="url" name="twitter" class="form-control" value="{{ $socialLinks->twitter }}">
    </div>
    <div class="form-group">
        <label for="facebook">Facebook</label>
        <input type="url" name="facebook" class="form-control" value="{{ $socialLinks->facebook }}">
    </div>
    <div class="form-group">
        <label for="instagram">Instagram</label>
        <input type="url" name="instagram" class="form-control" value="{{ $socialLinks->instagram }}">
    </div>
    <div class="form-group">
        <label for="youtube">YouTube</label>
        <input type="url" name="youtube" class="form-control" value="{{ $socialLinks->youtube }}">
    </div>
    <button type="submit" class="btn btn-success">Update Links</button>
</form>
