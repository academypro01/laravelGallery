@extends('backend.layouts.app')

@section('title')
    دسته بندی ها
@endsection

@section('content')
    <div class="card">

        <div class="card-header row justify-content-between">

            <h3 class="card-title">لیست دسته بندی ها</h3>
            <a href="{{ route('category.create') }}" class="btn btn-app">
                <i class="fa fa-plus"></i> جدید
            </a>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th style="width: 10px">شناسه</th>
                    <th>عنوان</th>
                    <th>کاربر</th>
                    <th>عملیات</th>
                </tr>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->user->name }}</td>
                    <td>
                        <form action="{{ route('category.destroy', [$category->id]) }}" method="post" id="deleteCategoryForm">
                            @csrf
                            @method('delete')
                        </form>
                        <a href="{{ route('category.edit', [$category->id]) }}"><button class="btn btn-success">ویرایش</button></a>
                        <button onclick="deleteForm()" class="btn btn-danger">حذف</button>
                    </td>
                </tr>
                @endforeach
                </tbody></table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                {{$categories->links()}}
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
