@extends('app')

@section('title', $title)

@section('css')

    <!-- DataTables -->
    {!! Html::style('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}
    {!! Html::style('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}

@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="pb-3">
                                    <a href="{{ route('admin.stock_in.create') }}" class="btn btn-info btn-sm pull-left">
                                        <span class="fa"> &nbsp;</span> Учет прихода товара
                                    </a>
                                    <a href="{{ route('admin.sales.create') }}" class="btn btn-info btn-sm pull-left">
                                        <span class="fa"> Учет продаж товара</span>
                                    </a>
                                </div>

                                <table id="itemList" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Товар</th>
                                        <th>Время</th>
                                        <th>Количество</th>
                                    </tr>
                                    </thead>
                                    <tfoot>

                                    </tfoot>
                                </table>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </section>
        <!-- /.content -->

        @endsection

        @section('js')

            <!-- DataTables  & Plugins -->
            {!! Html::script('/plugins/datatables/jquery.dataTables.min.js') !!}
            {!! Html::script('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}
            {!! Html::script('/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}
            {!! Html::script('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}
            {!! Html::script('/plugins/datatables-buttons/js/dataTables.buttons.min.js') !!}
            {!! Html::script('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') !!}
            {!! Html::script('/plugins/pdfmake/pdfmake.min.js') !!}
            {!! Html::script('/plugins/pdfmake/vfs_fonts.js') !!}
            {!! Html::script('/plugins/datatables-buttons/js/buttons.html5.min.js') !!}
            {!! Html::script('/plugins/datatables-buttons/js/buttons.print.min.js') !!}
            {!! Html::script('/plugins/datatables-buttons/js/buttons.colVis.min.js') !!}

            <script>

                $(function (){

                    $("#itemList").DataTable({
                        "oLanguage": {
                            "sLengthMenu": "Отображено _MENU_ записей на страницу",
                            "sZeroRecords": "Ничего не найдено - извините",
                            "sInfo": "Показано с _START_ по _END_ из _TOTAL_ записей",
                            "sInfoEmpty": "Показано с 0 по 0 из 0 записей",
                            "sInfoFiltered": "(отфильтровано  _MAX_ всего записей)",
                            "oPaginate": {
                                "sFirst": "Первая",
                                "sLast": "Посл.",
                                "sNext": "След.",
                                "sPrevious": "Пред.",
                            },
                            "sSearch": ' <i class="fas fa-search" aria-hidden="true"></i>'
                        },
                        'createdRow': function (row, data, dataIndex) {
                            $(row).attr('id', 'rowid_' + data['id']);
                        },
                        "processing": true,
                        "responsive": true,
                        "autoWidth": true,
                        'serverSide': true,
                        'ajax': {
                            url: '{{ route('admin.datatable.stock') }}'
                        },
                        'columns': [
                            {data: 'name', name: 'name'},
                            {data: 'created_at', name: 'created_at'},
                            {data: 'quantity', name: 'quantity', searchable: false},
                        ]
                    });
                });

            </script>

@endsection
