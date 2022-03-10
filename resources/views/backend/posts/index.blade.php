@extends('backend.layouts.app')

@section('title')
    پست ها
@endsection

@section('content')
    <div class="card">

        <div class="card-header row justify-content-between">

            <h3 class="card-title">لیست دسته بندی ها</h3>
            <a href="{{ route('post.create') }}" class="btn btn-app">
                <i class="fa fa-plus"></i> جدید
            </a>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th style="width: 10px">شناسه</th>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>کاربر</th>
                    <th>دسته بندی</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        <img src="{{ asset($post->photos[0]->path) }}" alt="" width="70" height="70" class="img-fluid rounded">
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        <ul class="list-group">
                        @foreach($post->categories as $category)
                            <li class="list-group-item">{{$category->title}}</li>
                        @endforeach
                        </ul>
                    </td>
                    <td>
                        @if($post->status == '0')
                            <button type="button" class="btn btn-danger">غیرفعال</button>
                        @else
                            <button type="button" class="btn btn-success">فعال</button>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('post.destroy', [$post->id]) }}" method="post" id="deleteCategoryForm">
                            @csrf
                            @method('delete')
                        </form>
                        <a href="{{ route('post.edit', [$post->id]) }}"><button class="btn btn-success">ویرایش</button></a>
                        <button onclick="deleteForm()" class="btn btn-danger">حذف</button>
                    </td>
                </tr>
                @endforeach
                </tbody></table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                {{$posts->links()}}
            </ul>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function deleteForm() {
            document.getElementById('deleteCategoryForm').submit();
        }
    </script>
@endsection
