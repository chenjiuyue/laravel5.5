@extends('layouts.blog')
@section('title','数据库操作')

@section('content')

    <table class="table table-bordered" style="width:60%;margin-left:20%;">
        <center><h3>laravel数据库操作</h3></center>
        <div style="width:60%;margin-left:20%;margin-bottom:5px;"> <button type="button" class="btn btn-success btn-sm btn-modal">+新增</button></div>
        <thead>
        <tr>
            <th>名称</th>
            <th>城市</th>
            <th>人口</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($country as $v)
            <tr>
                <td>{{$v->code}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->population}}</td>
                <td width="10%" style="white-space: normal;">
                    <a href="{{route('curd-update',$v->code)}}" title="查看或修改" class="detail"  draggable="false"><span class="glyphicon glyphicon-eye-open" style="color:green;"></span></a>
                    &nbsp;&nbsp;
                    <a href="" title="删除" aria-label="删除" data-code="{{$v->code}}" class="delete"  draggable="false"><span class="glyphicon glyphicon-trash" style="color: red"></span></a>
                    &nbsp;&nbsp;
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {!! csrf_field() !!}



    <script>
        //删除
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".delete").click(function(){
                var code=$(this).data('code');
                $.post("{{route('curd_delete')}}",{code:code},function(msg){
                    if(msg=='{{Config::get('constants.WELL')}}'){
                        alert('删除成功');
                        window.location.reload();
                    }
                })
            })
        })
     //显示模态框
        $(function(){
            $('.btn-modal').click(function(){
                $('#myModal').modal('show');
            })
        })
     //添加信息
        $(function(){

            $('.btn-add').click(function(){
                var data=$('.form').serialize();
                $.ajax({
                    url:"{{route('curd_add')}}",
                    type:'post',
                    data:data,
                    success:function(msg){
                        if(msg=='{{Config::get('constants.WELL')}}'){
                            alert('新增成功');
                            window.location.reload();
                        }
                    }
                })

            })
        })
    </script>

@stop
        <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">添加记录</h4>
                </div>
                <form role="form" class="form">
                    <div class="form-group" style="width: 90%;margin-left: 5%">
                        <label for="name">名称</label>
                        <input type="text" class="form-control" placeholder="名称" name="code">
                    </div>
                    <div class="form-group" style="width: 90%;margin-left: 5%">
                        <label for="name">城市</label>
                        <input type="text" class="form-control" placeholder="城市" name="name">
                    </div>
                    <div class="form-group" style="width: 90%;margin-left: 5%">
                        <label for="name">人口</label>
                        <input type="text" class="form-control" placeholder="人口" name="population">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary btn-add">添加</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

                                                                                                                                                                                                                                                                                                                     