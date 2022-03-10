@extends('backend.layouts.app')

@section('title')
   ویرایش دسته بندی: {{$category->title}}
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">ویرایش دسته بندی</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('category.update', [$category->id]) }}">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">عنوان دسته بندی</label>

                        <div class="col-sm-10">
                            <input value="{{ $category->title }}" type="text" name="title" class="form-control" id="inputEmail3" placeholder="عنوان دسته بندی را وارد کنید" spellcheck="false" required autofocus>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">بروزرسانی</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
@endsection
