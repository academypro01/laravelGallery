@extends('backend.layouts.app')

@section('title')
    ویرایش پست: {{$post->title}}
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">ویرایش پست</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('post.update', [$post->id]) }}">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">عنوان پست</label>

                        <div class="col-sm-10">
                            <input value="{{ $post->title }}" type="text" name="title" class="form-control" id="title" placeholder="عنوان پست را وارد کنید" spellcheck="false" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug" class="col-sm-2 control-label">نام مستعار</label>

                        <div class="col-sm-10">
                            <input value="{{ $post->slug }}" type="text" name="slug" class="form-control" id="slug" placeholder="نام مستعار پست را وارد کنید"  required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categories" class="col-sm-2 control-label">دسته بندی</label>
                        <div class="col-sm-10">
                            <select name="category_id[]" id="categories" multiple class="form-control" required>
                                @foreach($categories as $category)
                                        <option

                                            @foreach($post->categories as $post_category)
                                                @if($category->id == $post_category->id)
                                                    selected
                                                @endif
                                            @endforeach

                                            value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">توضیحات پست</label>

                        <div class="col-sm-10">
                            <textarea type="text" name="description" class="form-control" cols="10" rows="10" id="description" placeholder="توضیحات پست را وارد کنید"  required >{{ $post->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">وضعیت پست</label>

                        <div class="col-sm-10">
                            <select required name="status" id="status" class="form-control">
                                <option value="0" {{ ($post->status == '0') ? 'selected' : '' }}>غیرفعال</option>
                                <option value="1" {{ ($post->status == '1') ? 'selected' : '' }}>فعال</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <img src="{{ asset($post->photos[0]->path) }}" class="img-fluid img-bordered" width="100" alt="">
                        <input type="hidden" name="photo_id" value="{{ $post->photos[0]->id }}">
                        <label for="photoUpload">آپلود تصویر</label>
                        <div class="col-sm-10">
                            <div class="dropzone" id="dropzone">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">ذخیره</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css">
@endsection

@section('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script !src="">
        Dropzone.autoDiscover = false;
        new Dropzone('#dropzone', {
            url: '{{route('photo.upload')}}',
            paraName: 'file',
            method : 'post',
            uploadMultiple: false,
            maxFiles: 1,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            headers: {
                'x-csrf-token': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            success: function (file, response) {
                document.querySelector("input[name='photo_id']").value = response.photo_id;
            },
        });
    </script>
@endsection
