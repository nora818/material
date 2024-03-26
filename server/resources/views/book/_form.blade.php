<div class="row">
    <div class="col-md-8">
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label text-end">Book Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" autofocus required value="{{ $name }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="author" class="col-sm-2 col-form-label text-end">Author</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="author" name="author" required value="{{ $author }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="thumb" class="col-sm-2 col-form-label text-end">Cover</label>
            <input type="hidden" name="thumb" id="thumbInput" value="{{ $thumb }}">
            <div class="col-sm-10" style="display: flex; align-items: center;">
                <div class="layui-upload-drag" id="thumb" style="width: 80%;">
                    <i class="layui-icon layui-icon-upload" style="font-size: 30px;"></i>
                    <p>Book Cover, click to upload or drag and drop here</p>
                </div>
                <div id="thumb-preview" class="layui-hide" style="margin-left: 10px;">
                    <img src="" style="max-width: 50%; max-height: 50%;">
                </div>
            </div>
            <script>
                // 在编辑状态下，将输入框的值设置为图像的 src 属性
                $(document).ready(function() {
                    var thumbInputValue = $('#thumbInput').val();
                    if (thumbInputValue) {
                        $('#thumb-preview').removeClass('layui-hide')
                            .find('img').attr('src', "/storage/" + thumbInputValue);
                    }
                });

                layui.use(function() {
                    var upload = layui.upload;
                    var $ = layui.$;
                    // 渲染
                    upload.render({
                        elem: '#thumb',
                        url: '{{ route("upload") }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        exts: 'jpg|png|jpeg|gif|svg',
                        done: function(res) {
                            layer.msg('Upload successful');
                            console.log(res)
                            $('#thumb-preview').removeClass('layui-hide')
                                .find('img').attr('src', "/storage/" + res.path);
                            $('input[name="thumb"]').val(res.path);
                        }
                    });
                });
            </script>
        </div>
        <div class="mb-3 row">
            <label for="introduction" class="col-sm-2 col-form-label text-end">
                Introduction
            </label>
            <div class="col-sm-10">
                <textarea class="form-control" name="introduction" rows="4" id="introduction">{{ $introduction }}</textarea>
            </div>
        </div>
    </div>
</div>