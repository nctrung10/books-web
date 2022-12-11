@extends('adminmaster')
@section('title')
<title>DANH MỤC SẢN PHẨM</title>

@endsection('title')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">QUẢN LÝ DANH MỤC SẢN PHẨM</h3>
                    </div>
                    <div class="row m-2">
                        <div class="col">
                            <!-- HIỂN THỊ THÔNG BÁO -->
                            <div class="thong-bao">
                                @if ( Session::has('success') )
                                <div class="alert alert-success alert-dismissible text-center" role="alert">
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                </div>
                                @endif
                                @if ( Session::has('error') )
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                </div>
                                @endif
                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TÊN DANH MỤC</th>
                                    <th>TÊN DANH MỤC CHA</th>
                                    <th>MÔ TẢ</th>
                                    <th>TRẠNG THÁI</th>
                                    <th>NGÀY THÊM</th>
                                    <th>SỬA</th>
                                    <th>XÓA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $danhmucs as $danhmuc)
                                <tr>
                                    <td>{{ $danhmuc->id }}</td>
                                    <td>{{ $danhmuc->tenDM }}</td>
                                    <td>
                                        @if($danhmuc->parent_id == 0)
                                        {{ '' }}
                                        @else
                                        @foreach($danhmucs as $row)
                                        @if($row->id == $danhmuc->parent_id)
                                        {{ $row->tenDM }}
                                        @endif
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $danhmuc->moTa }}</td>
                                    <td class="text-center">
                                        @if( $danhmuc->trangThai == 0)
                                        <form action="{{ Route('admin.edithien',$danhmuc->id) }}" method="POST">
                                            @csrf
                                            @method('post')
                                            <button class="btn btn-outline-light" type="submit"><i class="fas fa-thumbs-down" style="color : red; font-size:30px"></i></button>
                                        </form>
                                        @else
                                        <form action="{{ Route('admin.editan',$danhmuc->id) }}" method="POST">
                                            @csrf
                                            @method('post')
                                            <button class="btn btn-outline-light" type="submit"><i class="fas fa-thumbs-up" style="color : green; font-size:30px"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/Y',strtotime($danhmuc->created_at))  }}</td>
                                    <td>
                                        <a href="{{ Route('admin.danhmucsanphamedit',$danhmuc->id) }}"><button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa thông tin">
                                                <i class="fas fa-edit"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ Route('admin.deletedanhmuc',$danhmuc->id) }}" onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không?')"> <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row  justify-content-end">
                            {!! $danhmucs->links() !!}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.card -->

@endsection('content')