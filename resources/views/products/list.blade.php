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
          <a href="{{route('products.create')}}" class="btn btn-dark mt-4">Create</a>
        </div>
        @if(Session::has('success'))
            <div class="col-md-10">
              <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <strong>{{Session::get('success')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                
            </div>
        @endif    
        <div class="col-md-10 ">
          <div class="card my-4 border-0 shadow-lg">
            <div class="card-header bg-dark">
              <h3 class="text-white">Poroducts</h3>
            </div>
            <div class="card-body">
              <table class="table table-striped">
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>SKU</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
                @if($products->isNotEmpty())
                    @foreach($products as $item)
                      <tr>
                        <td>{{$item->id}}</td>
                        <td>
                            @if($item->image != "")
                              <img width="50" src="{{asset('uplods/products/'.$item->image)}}">
                            @endif
                        </td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->sku}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{\Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}</td>
                        <td>
                          <a href="#" class="btn btn-dark">Edit</a>
                          <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                      
                      </tr>
                    @endforeach
                  
                @endif
                
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>