@extends('layouts.user')

@section('title')
    {{Auth::user()->name}}
@endsection

@section('main')

    <main id="main" style="padding-top: 3%; !important;">

        <section id="profile" class="values">
            <div class="container-xxl" data-aos="fade-up">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex justify-content-center">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <img style="max-height: 120px;border-radius: 100%"
                                                         src="{{ Auth::user()->picture !== 'profile-picture-placeholder.jpg' ? (Auth::user()->role_id == 3 ? asset('storage/uploads/students/' . Auth::user()->picture) : asset('storage/uploads/librarians/' . Auth::user()->picture)) : asset('imgs/' . Auth::user()->picture) }}" alt="">
                                                </div>
                                                <div class="col-auto d-flex align-items-center">
                                                    <div>
                                                        <h1 class="h1">{{Auth::user()->name}}</h1>
                                                        <h4 class="text-gray">{{"@".Auth::user()->username}}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center flex-column">
                                            <a class="btn btn-outline-primary" href="{{route('profil.edit')}}">Izmijeni profil</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </main>

@endsection

