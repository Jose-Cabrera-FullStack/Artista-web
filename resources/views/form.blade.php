@extends('admin.layouts.dashboard')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ !empty($category->id) ? 'Editar' : 'Crear' }} Categoría</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="{{route('participaciones-categorias.index')}}">
        <button class="btn btn-sm btn-outline-secondary">
          <span data-feather="skip-back"></span>
          
        </button>
       </a>
    </div>
  </div>

  <div class="row">
    <div class="col">
      
      @if (Session::get('message'))
          <div class="alert alert-success">
              <span class="glyphicon glyphicon-info-sign"></span> {{ Session::get('message') }}
          </div>
      @endif

      <form method="POST" action="{{ empty($category->id) ? route('participaciones-categorias.store') : route('participaciones-categorias.update', [ 'id' => $category->id ]) }}" class="needs-validation" novalidate>
        
        @if(!empty($category->id))
          {{method_field('PUT')}}
        @endif

        {{ csrf_field() }}


        <div class="form-row">

          <div class="form-group col-md">
            <label for="name">*Nombre</label>
            <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" id="name" placeholder="name" 
            value="{{ (old('name') ? old('name') : $category->name ) }}" required>
             
            <div class="invalid-feedback">
              @if($errors->has('name'))
                @foreach ($errors->get('name') as $message) 
                    {{$message}}
                @endforeach
              @else
                Por favor selecciona un Nombre.
              @endif
            </div>
          </div>

          <div class="form-group col-md">
            <label for="position">Posición</label>
            <select  id="position" name="position" class="form-control">
              <option value="0">1</option>
              @for($x = 1; $x <= $categoriesQ; $x++)
                <option value="{{$x}}" 
                  @if(old('position') && old('position') == $x)  
                    selected  
                  @elseif(isset($category->position) && $category->position == $x)    
                    selected 
                  @endif>
                  {{$x+1}}
                 </option>
              @endfor
            </select>
          </div>
          
          
          
        </div>

        <div class="form-row">
         
          <div class="form-group col-md">
            <label for="brief">Introducción</label>
             <textarea class="form-control" name="brief" id="brief" rows="3" maxlength="255">{{ (Request::old('brief') ? Request::old('brief') : $category->brief ) }}</textarea>
          </div>

        </div> 

        <div class="form-row">
         
          <div class="form-group col-md">
            <label for="description">Descripción</label>
             <textarea class="form-control" name="description" id="description" rows="3" maxlength="255">{{ (Request::old('description') ? Request::old('description') : $category->description ) }}</textarea>
          </div>

        </div> 

       <!--<div class="form-row">
         
          <div class="form-group col-md">
            <label for="color1">Color 1</label>
             <input type="color"  name="color1" id="color1" placeholder="color1" 
            value="{{ (old('color1') ? old('color1') : $category->color1 ) }}" >
          </div>

          <div class="form-group col-md">
            <label for="color2">Color 2</label>
             <input type="color"  name="color2" id="color2" placeholder="color2" 
            value="{{ (old('color2') ? old('color2') : $category->color2 ) }}" >
          </div>

          <div class="form-group col-md">
            <label for="button_text">Texto del botón</label>
             <input type="text" class="form-control" name="button_text" id="button_text" placeholder="button_text" 
            value="{{ (old('button_text') ? old('button_text') : $category->button_text ) }}" >
          </div>

        </div> -->
        <div class="row">
          <!--<div class="form-group col-12 p">
            <label for="author">Slider Principal (Por lo menos subir 1 imagen)</label>
          </div>-->

          @for($x = 0; $x < 1; $x++)
            <!--<div class="col-4 mt-2 mb-2">-->
              <div class="col-6 col-md-2 mt-2 mb-2">
              <label>Ícono</label>
              <div id="finalB64Containercategory{{$x}}">
                @if(old('photo-category'.$x))
                  <img class="img-fluid"  src="{{ (old('photo-category'.$x) ? old('photo-category'.$x).'?v='.uniqid() : '' ) }}">
                @elseif( $category->getIcon())
                  <img class="img-fluid" id="img-category{{$x}}" data-imageid="{{$category->getIcon()->id}}" src="{{ asset('public/storage/'.$category->getIcon()->getOwnerType().'/'.$category->getIcon()->filename).'?v='.uniqid()}}">
                 
                  <div class="row">
                    @if(count($category->images) > 1)
                    <div class="col-9">
                      <div class="form-group mt-2">
                        <label for="">Reemplazar por foto</label>
                        <select class="replace-position" data-category="category" data-original="{{$x}}" data-imageid="{{$category->getIcon()->id}}" data-item="category">
                          @for($i = 2; $i < $imagesQ; $i++)
                            @if( $category->getImage($category->id, 'App\CollaborationCategory', $type = 'mainImage', $i))
                              <option @if($i == $x) selected @endif
                                value="{{$i}}"> 
                                {{$i+1}}
                              </option>
                            @endif
                          @endfor
                        </select>
                        <input type="hidden" name="replace-photo-place{{$x}}" id="replace-photo-place{{$x}}" value=""> 
                        <input type="hidden" name="replacewith-photo-place{{$x}}" id="replacewith-photo-place{{$x}}" value=""> 
                      </div>
                    </div>
                    @endif
                    <!--<div class="col-3">
                      <button type="button" class="btn btn-sm delete-image"  data-category="category" data-imageid="{{$category->getIcon()->id}}" data-position="{{$x}}">
                        <span data-feather="trash"></span>
                      </button>
                      <input type="hidden" name="delete-photo-category{{$x}}" id="delete-photo-category{{$x}}" value=""> 
                    </div>-->
                  </div>
                  
                @endif
              </div>
              <input type="file" id="file-category{{$x}}" class="mb-2">
              <input type="hidden" name="photo-category{{$x}}" id="photo-category{{$x}}" value="{{ (old('photo-category'.$x) ? old('photo-category'.$x) : '' ) }}">
              @if($category->getIcon())
                <input type="hidden" name="photoid-category{{$x}}" value="{{ $category->getIcon()->id }}">
              @endif
              <div class="progress d-none m-4" id="progress-category">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar">Cargando...</div>
              </div>
            </div>
            <hr>
          @endfor

        </div>
        
        <div class="form-row">
          <div class="form-group col-md ml-auto">
            <label for="html_title_tag">Activo</label><br>
            <label class="switch">
              <input type="checkbox" name="active" 
                @if(old('active') == 'Y') 
                  checked 
                @else 
                  @if($category->active == 'Y')
                    checked 
                  @endif
                @endif
              >
              <span class="slider round"></span>
            </label>
          </div>
        </div> 
        <div class="row">
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Guardar</button>
          </div>
        </div>
        
      </form>
    </div>
  </div>

  
  
</main>
@endsection

@section('inline-scripts')
<script>
  $("#modal").css("width", 300);
  $(document).on('change','#file-category0' , function(){ 
    uploadFile(this.files[0], "category0", 48, 48) 
  });
</script>
@stop

