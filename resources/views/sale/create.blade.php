@extends('app')

@section('title', $title)

@section('css')

@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- general form elements -->
                    <header class="card card-primary">

                        <!-- form start -->
                        {!! Form::open(['url' => route('admin.products.store'), 'method' => 'post']) !!}

                        <div class="card-body">

                            <p>*-обязательные поля</p>

                            <div class="form-group">

                                {!! Form::label('product_id',  'Товар*') !!}

                                {!! Form::select('product_id', $options, old('product_id'), ['placeholder' => 'Товар', 'class' => 'custom-select']) !!}

                                @if ($errors->has('product_id'))
                                    <p class="text-danger">{{ $errors->first('product_id') }}</p>
                                @endif

                            </div>

                            <div class="form-group">

                                {!! Form::label('quantity', 'Количество*') !!}

                                {!! Form::text('quantity', old('quantity'), ['class' => 'form-control', 'placeholder' => 'Количество']) !!}

                                @if ($errors->has('quantity'))
                                    <p class="text-danger">{{ $errors->first('quantity') }}</p>
                                @endif
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                добавить
                            </button>
                        </div>

                        {!! Form::close() !!}

                    </header>

                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
    <!-- /.content -->

@endsection

@section('js')


@endsection
