@extends('layouts.admin')

@section('pageTitle')
    Kullanıcı Listesi - Admin - {!! config('setting.Title') !!}
@endsection
@section('adminContent')

    @if(isset($error))
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">{{ __('Kullanıcı Listesi') }}
            <div class="float-right"><a href="{{ route('users.create') }}"><i class="fas fa-plus"></i> Yeni Kullanıcı
                    Ekle</a></div>
        </div>

        <div class="card-body">
            <table class="table table-dark table-borderless table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">İsim</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Düzenle</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{!! $user->id !!}</th>
                        <td>{!! $user->name !!}</td>
                        <td>{!! $user->email !!}</td>
                        <td>
                            <button class="btn btn-link" style="padding: 0; float: left; margin-right: 5px;"><a
                                    href="{{ route('users.edit', ['user' => $user->id]) }}"><i class="fas fa-edit"
                                                                                               aria-hidden="true"></i>&nbsp;</a>
                            </button>
                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST"
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
            {{ $users->links() }}
        </div>
    </div>

@endsection
