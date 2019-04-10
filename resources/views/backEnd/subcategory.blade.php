@extends('backEnd.layout')

@section('content')
<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
    <?php
          $uploadPath = "public/uploads/categories/";
          $category_id = 1;
    ?>
    <div class="padding">
        <div class="box">

            <div class="box-header dker">
                <h3>{{ trans('backLang.category') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a href="">{{ trans('backLang.settings') }}</a>
                </small>
            </div>

           
                    <div class="col-lg-4 mt-3">
                        {{Form::open(array('url'=>'', 'files'=>true))}}
                            <div class="form-group">
                                <label for="">Categories</label>
                                <select class="form-control input-sm" name="category" id="category">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">SubCategories</label>
                                <?php
                                $subcategories = App\Category::find($category_id)->subcategories;
                                ?>
                                <select name="subcategory" class="form-control input-sm" id="subcategory">
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}">{{$subcategory->subcategory}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                        {{Form::close()}}
                   </div>
          
                <script>
                    $('#category').on('change', function(e){
                        console.log(e);
                        
                        var cat_id = e.target.value;

                        //ajax
                        $.get('/ajax-subcat?cat_id='+ cat_id, function(data){
                            //success data
                            $('#subcategory').empty();
                            console.log(data);
                            $.each(data, function(index, subcatObj)){
                                $('#subcategory').append('<option value="'+ subcatObj.id+'">'+subcatObj.subcategory + '</option>');
                            }
                        })
                    })
                </script>

             

              
        </div>
    </div>
     
@endsection
@section('footerInclude')
     
@endsection
