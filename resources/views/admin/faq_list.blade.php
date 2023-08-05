@extends('.admin.template.master')

@section('title', 'FAQs')
@include('admin.template.header')
<style>
    button.right {
        margin-bottom: 10px;
        float: right;
        background-color: #ff5722;
    }

    .orbg {
        background-color: #ff5722;
    }

    .color {
        color: white;
    }
</style>

@section('content')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>FAQs</h2>
            </div>
            <a href="/faq-form"><button type="button" class="btn right float-right">
                    <span class="color"><i class="fa fa-plus"></i> Add Question</span>
                </button></a>
        </div>
        @php($sno = 1)
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>All Questions</h2>
                    </div>
                </div>
                <div class="table_section padding_infor_info ">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead style="text-align: left;">
                                <tr>
                                    <th>#</th>
                                    <th>Questions</th>
                                    <th colspan="2">Operations</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: left;">
                            @foreach($faq as $faqs)
                                <tr class="remove_faq">
                                    <td>{{$sno++}}</td>
                                    <td>{{$faqs->title}}</td>
                                    <td colspan="2"><a href="/faq-form/{{$faqs->id}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a> | <span data-id="{{$faqs->id}}" id="delete" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(this).on('click', '#delete', function() {
            var id = $(this).attr('data-id');
            var el = $(this);
            $.ajax({
                type: 'GET',
                url: "{{url('delete-faq/{id}')}}",
                data: {
                    id: id,
                    "_token": "{{csrf_token()}}"
                },
                success: function(res) {
                    console.log(res);
                    if (res.code == 300) {
                        alert(res.msg);
                    }
                    el.closest(".remove_faq").remove();
                }
            });
        });
    });
</script>
@endsection