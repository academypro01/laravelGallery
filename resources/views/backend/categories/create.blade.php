@extends('backend.layouts.app')

@section('title')
    ساخت دسته بندی جدید
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">ساخت دسته بندی جدید</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('category.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">عنوان دسته بندی</label>

                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="عنوان دسته بندی را وارد کنید" spellcheck="false" required autofocus>
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
