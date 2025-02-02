<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Add New Astuce</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
       <div class="container">
      <h1>Add New Astuce</h1>
  
          <form action="{{ route('admin.astuces.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
          <div class="mb-3">
               <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-control" required>
                      <option value="visage">Visage</option>
                      <option value="corps">Corps</option>
                      <option value="mains et pieds">Mains et Pieds</option>
                      <option value="cheveux">Cheveux</option>
                 </select>
             </div>
              <div class="mb-3">
                  <label for="text" class="form-label">Text</label>
                   <textarea name="text" id="text" class="form-control" required></textarea>
               </div>
              <div class="mb-3">
                  <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control"  accept="image/*">
             </div>
          
               <button type="submit" class="btn btn-primary">Add</button>
                  <a href="{{ route('admin.astuces.index') }}" class="btn btn-secondary">Cancel</a>

         </form>
     </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>