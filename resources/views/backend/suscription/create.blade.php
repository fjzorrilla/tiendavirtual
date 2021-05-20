@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Agregar Suscripcion</h5>
    <div class="card-body">
      <form method="post" action="{{route('suscription.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo</label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="regular" class="col-form-label">Precio Regular <span class="text-danger">*</span></label>
          <input id="regular" type="text" name="regular" placeholder="Precio Regular" class="form-control">
          @error('regular')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="premium" class="col-form-label">Precio Premium <span class="text-danger">*</span></label>
          <input id="premium" type="text" name="premium" placeholder="Precio Premium" class="form-control">
          @error('premium')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="superpremium" class="col-form-label">Precio Super Premium <span class="text-danger">*</span></label>
          <input id="superpremium" type="text" name="superpremium" placeholder="Precio Super Premium" class="form-control">
          @error('superpremium')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Activa</option>
              <option value="inactive">Inactiva</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="card-body">
          <div class="table-responsive">
            @if(count($products)>0)
            <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S.N.</th>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Precio</th>
                  <th>Descuento</th>
                  <th>Condición</th>
                  <th>Marcas</th>
                  <th>Stock</th>
                  <th>Fotos</th>
                  <th>Estatus</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>S.N.</th>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Precio</th>
                  <th>Descuento</th>
                  <th>Condición</th>
                  <th>Stock</th>
                  <th>Fotos</th>
                  <th>Estatus</th>
                </tr>
              </tfoot>
              <tbody>

                @foreach($products as $product)
                  @php
                    $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
                    $brands=DB::table('brands')->select('title')->where('id',$product->brand_id)->get();
                  @endphp
                    <tr>
                        <td><input type="checkbox" name="productos[]" value="{{$product->id}}"></td>
                        <td>{{$product->title}}</td>
                        <td>{{$product->cat_info['title']}}
                          <sub>
                            @foreach($sub_cat_info as $data)
                              {{$data->title}}
                            @endforeach
                          </sub>
                        </td>
                        @if($product->discount > 0)
                          <td><span style="text-decoration: line-through;">{{$product->price}}</span> / {{$product->price - ($product->price * $product->discount) / 100}}</td>
                        @else
                          <td>{{$product->price}}</td>
                        @endif
                        <td>{{$product->discount}}%</td>
                        <td>{{$product->condition}}</td>
                        <td>@foreach($brands as $brand) {{$brand->title}} @endforeach</td>
                        <td>
                          @if($product->stock>0)
                          <span class="badge badge-primary">{{$product->stock}}</span>
                          @else
                          <span class="badge badge-danger">{{$product->stock}}</span>
                          @endif
                        </td>
                        <td>
                            @if($product->photo)
                                @php
                                  $photo=explode(',',$product->photo);
                                  // dd($photo);
                                @endphp
                                <img src="{{$photo[0]}}" class="img-fluid zoom" style="max-width:80px" alt="{{$product->photo}}">
                            @else
                                <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                            @endif
                        </td>
                        <td>
                            @if($product->status=='active')
                                <span class="badge badge-success">{{$product->status}}</span>
                            @else
                                <span class="badge badge-warning">{{$product->status}}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            
            @else
              <h6 class="text-center">¡No se han encontrado productos! Por favor crea producto</h6>
            @endif
          </div>
        </div>
            <div class="form-group mb-3">
              <button type="reset" class="btn btn-warning">Reset</button>
               <button class="btn btn-success" type="submit">Guardar</button>
            </div>
          </form>
        </div>
    </div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Write short description.....",
          tabsize: 2,
          height: 120
      });
    });
</script>

<script>
  $('#is_parent').change(function(){
    var is_checked=$('#is_parent').prop('checked');
    // alert(is_checked);
    if(is_checked){
      $('#parent_cat_div').addClass('d-none');
      $('#parent_cat_div').val('');
    }
    else{
      $('#parent_cat_div').removeClass('d-none');
    }
  })
</script>
@endpush