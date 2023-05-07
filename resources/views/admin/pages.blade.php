@extends('layouts.admin')

@section('pageTitle')
    Sayfalar - Admin - {!! config('setting.Title') !!}
@endsection
@section('adminContent')

    @if(isset($error))
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">{{ __('Sayfalar') }}
            <div class="float-right"><a href="{{ route('pages.create') }}"><i class="fas fa-plus"></i> Yeni Sayfa
                    Ekle</a></div>
        </div>

        <div class="card-body">
            <table class="table table-dark table-borderless table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sayfa</th>
                    <th scope="col">Kullanıcı</th>
                    <th scope="col">Düzenle</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <th scope="row">{!! $page->id !!}</th>
                        <td>{!! $page->title !!}</td>
                        <td>
                            @foreach ($page->user()->get() as $user)
                                {{ $user->name }}
                            @endforeach
                        </td>
                        <td>
                            <button class="btn btn-link" style="padding: 0; float: left; margin-right: 5px;"><a
                                    href="{{ route('pages.edit', ['page' => $page->id]) }}"><i class="fas fa-edit"
                                                                                               aria-hidden="true"></i>&nbsp;</a>
                            </button>
                            <form action="{{ route('pages.destroy', ['page' => $page->id]) }}" method="POST"
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
            {{ $pages->links() }}
        </div>
    </div>

@endsection
