<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Astuce</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
     <div class="container">
    <h1>Edit Astuce</h1>

    <form action="{{ route('admin.astuces.update', $astuce->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
              <label for="category" class="form-label">Category</label>
               <select name="category" id="category" class="form-control" required>
                 <option value="visage" {{ $astuce->category === 'visage' ? 'selected' : '' }}>Visage</option>
                <option value="corps" {{ $astuce->category === 'corps' ? 'selected' : '' }}>Corps</option>
                <option value="mains et pieds" {{ $astuce->category === 'mains et pieds' ? 'selected' : '' }}>Mains et Pieds</option>
                <option value="cheveux" {{ $astuce->category === 'cheveux' ? 'selected' : '' }}>Cheveux</option>
              </select>
          </div>

         <div class="mb-3">
             <label for="text" class="form-label">Text</label>
           <textarea name="text" id="text" class="form-control" required>{{ $astuce->text }}</textarea>
         </div>

           <div class="mb-3">
               <label for="image" class="form-label">Image</label>
                 <input type="file" name="image" id="image" class="form-control"  accept="image/*">
               @if($astuce->image)
               <img src="{{ asset( $astuce->image) }}" alt="Astuce Image" style="max-width: 100px;" class="mt-2">
              @endif
         </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.astuces.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

