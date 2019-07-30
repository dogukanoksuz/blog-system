@extends('layouts.admin')

@section('pageTitle')
Kategoriler - Admin - {!! config('setting.Title') !!}
@endsection
@section('adminContent')
    @if(isset($error))
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">{{ __('Kategoriler') }} <div class="float-right"><a href="{{ route('categories.create') }}"><i class="fas fa-plus"></i> Yeni Kategori Ekle</a></div></div>

        <div class="card-body">
            <table class="table table-dark table-borderless table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Başlık</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Düzenle</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{!! $category->id !!}</th>
                        <td>{!! $category->title !!}</td>
                        <td>{!! $category->slug !!}</td>
                        <td>
                            <button class="btn btn-link" style="padding: 0; float: left; margin-right: 5px;"><a href="{{ route('categories.edit', ['category' => $category->id]) }}"><i class="fas fa-edit"
                                                                                                                                                                           aria-hidden="true"></i>&nbsp;</a>
                            </button>
                            <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST" onsubmit="confirm('Emin misiniz?')">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-link" style="padding: 0; float: left;"><i class="fas fa-times"
                                                                                                 aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>

@endsection
