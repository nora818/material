@extends('layout')

@section("styles")
<style>
    .custom-thumbnail {
        background-color: transparent;
    }
</style>
@stop

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Comment management</li>
        <li class="breadcrumb-item active" aria-current="page">Comment list</li>
    </ol>
</nav>
@stop

@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-6 text-right">
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-sm-12">

            @include('partials.errors')
            @include('partials.success')

            <table id="comments-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Comments</th>
                        <th>Commentator</th>
                        <th>Time</th>
                        <th data-sortable="false">Operate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->created_at }}</td>
                        <td>
                            <a type="button" href="/comment/{{ $comment->id }}/edit" class="btn btn-xs btn-primary">
                                <i class="fa fa-edit"></i>Edit
                            </a>
                            <button data-id="{{ $comment->id }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete">
                                <i class="fa fa-edit"></i>Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm pop-up window</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i>
                        Are you sure you want to delete this comment?
                    </p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="{{ route('comment.destroy', 0) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Yes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@stop

@section('scripts')
<script>
    $(document).ready(function() {
        // 捕获模态框显示事件
        $('#modal-delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // 触发模态框的按钮
            var id = button.data('id'); // 从按钮获取ID

            // 动态设置表单的action属性
            var form = $('#deleteForm');
            var action = "{{ route('comment.destroy', 0) }}";
            action = action.replace('/comment/0', '/comment/' + id);
            form.attr('action', action);
        });
    });

    layui.use('layer', function() {
        var layer = layui.layer;
        // 查看大图的函数
        window.viewImage = function(imgUrl) {
            layer.photos({
                photos: {
                    data: [{
                        src: imgUrl
                    }]
                },
                anim: 5 // 控制大图查看器的弹出动画效果
            });
        };
    });
</script>
@stop
