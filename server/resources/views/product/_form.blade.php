<div class="row">
    <div class="col-md-8">
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label text-end">Material Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" autofocus required value="{{ $name }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="score" class="col-sm-2 col-form-label text-end">Score</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="score" name="score" required value="{{ $score }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="grade" class="col-sm-2 col-form-label text-end">Grade</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="grade" name="grade" required value="{{ $grade }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="grade_url" class="col-sm-2 col-form-label text-end">Material Picture</label>
            <input type="hidden" name="grade_url" id="thumbInput" value="{{ $grade_url }}">
            <div class="col-sm-10" style="display: flex; align-items: center;">
                <div class="layui-upload-drag" id="thumb" style="width: 80%;">
                    <i class="layui-icon layui-icon-upload" style="font-size: 30px;"></i>
                    <p>Material Picture.Click to upload or drag and drop here</p>
                </div>
                <div id="thumb-preview" class="layui-hide" style="margin-left: 10px;">
                    <img src="" style="max-width: 50%; max-height: 50%;">
                </div>
            </div>
            <script>
                // 在编辑状态下，将输入框的值设置为图像的 src 属性
                $(document).ready(function () {
                    var thumbInputValue = $('#thumbInput').val();
                    if (thumbInputValue) {
                        $('#thumb-preview').removeClass('layui-hide')
                            .find('img').attr('src', "/storage/" + thumbInputValue);
                    }
                });

                layui.use(function () {
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
                        done: function (res) {
                            layer.msg('Upload successful');
                            console.log(res)
                            $('#thumb-preview').removeClass('layui-hide')
                                .find('img').attr('src', "/storage/" + res.path);
                            $('input[name="grade_url"]').val(res.path);
                        }
                    });
                });
            </script>
        </div>
        <div class="mb-3 row">
            <label for="introduction" class="col-sm-2 col-form-label text-end">
                Details
            </label>
            <div class="col-sm-10">
                <textarea class="form-control" name="content" rows="4" id="introduction">{{ $content }}</textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="product_url" class="col-sm-2 col-form-label text-end">Grade Picture</label>
            <input type="hidden" name="product_url" id="product_url" value="{{ $product_url }}">
            <div class="col-sm-10" style="display: flex; align-items: center;">
                <div class="layui-upload-drag" id="product_url_drag" style="width: 80%;">
                    <i class="layui-icon layui-icon-upload" style="font-size: 30px;"></i>
                    <p>Grade picture.Click to upload or drag and drop here</p>
                </div>
                <div id="product_url_preview" class="layui-hide" style="margin-left: 10px;">
                    <img src="" style="max-width: 50%; max-height: 50%;">
                </div>
            </div>
            <script>
                // 在编辑状态下，将输入框的值设置为图像的 src 属性
                $(document).ready(function () {
                    var product_url = $('#product_url').val();
                    if (product_url) {
                        $('#product_url_preview').removeClass('layui-hide')
                            .find('img').attr('src', "/storage/" + product_url);
                    }
                });

                layui.use(function () {
                    var upload = layui.upload;
                    var $ = layui.$;
                    // 渲染
                    upload.render({
                        elem: '#product_url_drag',
                        url: '{{ route("upload") }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        exts: 'jpg|png|jpeg|gif|svg',
                        done: function (res) {
                            layer.msg('Upload successful');
                            console.log(res)
                            $('#product_url_preview').removeClass('layui-hide')
                                .find('img').attr('src', "/storage/" + res.path);
                            $('input[name="product_url"]').val(res.path);
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
