@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Editar Pagina</h5>
    <div class="card-body">
    <form method="post" action="{{route('deliverySetting.update')}}">
        @csrf 
        {{-- @method('PATCH') --}}
        {{-- {{dd($data)}} --}}
        <div class="form-group">
          <label for="title" class="col-form-label">Titulo de la Página <span class="text-danger">*</span></label>
          <input class="form-control" id="title" name="title" value="{{$data->title}}">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="description1" class="col-form-label">Descripcion Delivery Gratis <span class="text-danger">*</span></label>
          <textarea class="form-control" id="description1" name="description1">{{$data->description1}}</textarea>
          @error('description1')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="description2" class="col-form-label">Descripcion Delivery Pago <span class="text-danger">*</span></label>
          <textarea class="form-control" id="description2" name="description2">{{$data->description2}}</textarea>
          @error('description2')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="description3" class="col-form-label">Descripcion General <span class="text-danger">*</span></label>
          <textarea class="form-control" id="description3" name="description3">{{$data->description3}}</textarea>
          @error('description3')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Actualizar</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager();
    $('#lfm1').filemanager('image');
    
    $(document).ready(function() {
      $('#description1').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 400
      });
      $('#description2').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 400
      });
      $('#description3').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 400
      });
    });
</script>
@endpush