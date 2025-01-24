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
                        {!! Form::open(['url' => isset($row) ? route('admin.products.update') : route('admin.products.store'), 'method' => isset($row) ? 'put' : 'post']) !!}

                        {!! isset($row) ? Form::hidden('id', $row->id) : '' !!}

                        <div class="card-body">

                            <p>*-обязательные поля</p>

                            <div class="form-group">

                                {!! Form::label('name', 'название') !!}

                                {!! Form::text('name', old('name', $row->name ?? null), ['class' => 'form-control', 'placeholder' => 'название']) !!}

                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="form-group">

                                {!! Form::label('code', 'код') !!}

                                {!! Form::text('code', old('code', $row->code ?? null), ['class' => 'form-control', 'placeholder' => 'код']) !!}

                                @if ($errors->has('code'))
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                @endif
                            </div>

                            <div class="form-group">

                                {!! Form::label('description', 'Описание') !!}

                                {!! Form::textarea('description', old('description', $row->description ?? null), [ 'placeholder' => 'Описание', 'rows' => 3, 'class' => 'form-control']) !!}

                                @if ($errors->has('description'))
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                @endif

                            </div>

                            <div class="form-group">

                                {!! Form::label('price', 'цена') !!}

                                {!! Form::text('price', old('price', $row->price ?? 0.01), ['class' => 'form-control', 'step' => "0.01", 'placeholder' => 'цена']) !!}

                                @if ($errors->has('price'))
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                @endif
                            </div>



                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($row) ? 'редактировать' : 'добавить' }}
                            </button>
                            <a class="btn btn-default float-sm-right" href="{{ route('admin.products.index') }}">
                                назад
                            </a>
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
