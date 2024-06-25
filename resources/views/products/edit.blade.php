<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Laravel 11 CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
      <h3 class="text-white text-center">Simple Laravel 11 CRUD</h3>
    </div>
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10 d-flex justify-content-end">
          <a href="{{route('products.index')}}" class="btn btn-dark mt-4">Back</a>
        </div>
        <div class="col-md-10 ">
          <div class="card my-4 border-0 shadow-lg">
            <div class="card-header bg-dark">
              <h3 class="text-white">Edit Poroduct</h3>
            </div>
            <form enctype="multipart/form-data" action="{{route('products.update',$product->id)}}" method="POST">
                @method('put')
              @csrf
              <div class="card-body">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" value="{{old('name',$product->name)}}" class=" @error('name') is-invalid @enderror form-control form-control-lg" name="name">
                  @error('name')
                    <p class="invalid-feedback">{{$message}}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="sku" class="form-label">SKU</label>
                  <input type="text" value="{{old('sku',$product->sku)}}" class=" @error('sku') is-invalid @enderror form-control form-control-lg" name="sku">
                  @error('sku')
                    <p class="invalid-feedback">{{$message}}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="price" class="form-label">Price</label>
                  <input type="text" value="{{old('price',$product->price)}}" class=" @error('price') is-invalid @enderror form-control form-control-lg" name="price">
                  @error('price')
                    <p class="invalid-feedback">{{$message}}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="price" class="form-label">Description</label>
                  <textarea class="form-control"  value="{{old('description',$product->description)}}" name="description" cols="30" rows="5"></textarea>
                </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Image</label>
                  <input type="file" class="form-control form-control-lg" name="image">
                    @if($product->image != "")
                        <img class="w-50 my-3" src="{{asset('uplods/products/'.$product->image)}}">
                    @endif
                </div>
                <div class="mb-3 d-grid">
                  <button type="submit" class="btn btn-lg btn-primary" >Update</button>
                </div>
              </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>