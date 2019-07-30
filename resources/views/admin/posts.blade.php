@extends('layouts.admin')

@section('pageTitle')
    Yazılar - Admin - {!! config('setting.Title') !!}
@endsection
@section('adminContent')

    @if(isset($error))
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">{{ __('Yazılar') }}
            <div class="float-right"><a href="{{ route('posts.create') }}"><i class="fas fa-plus"></i> Yeni Yazı
                    Ekle</a></div>
        </div>

        <div class="card-body">
            <table class="table table-dark table-borderless table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Yazı</th>
                    <th scope="col">Kullanıcı</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Düzenle</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{!! $post->id !!}</th>
                        <td>{!! $post->title !!}</td>
                        <td>
                            @foreach ($post->user()->get() as $user)
                                {{ $user->name }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($post->category()->get() as $category)
                                <a href="{{ route('categories.edit', $category->id) }}">{{ $category->title }}</a>,
                            @endforeach
                        </td>
                        <td>
                            <button class="btn btn-link" style="padding: 0; float: left; margin-right: 5px;"><a
                                    href="{{ route('posts.edit', ['post' => $post->id]) }}"><i class="fas fa-edit"
                                                                                               aria-hidden="true"></i>&nbsp;</a>
                            </button>
                            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST"
                                  onsubmit="confirm('Emin misiniz?')">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-link" style="padding: 0; float: left;"><i class="fas fa-times"
                                                                                                 aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>

@endsection
