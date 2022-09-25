@extends('app')

@section('page_title')
    Podešavanja polisa
@endsection

@section('page_content')
    <div class="row">
        <div class="col-md-2">
            <div class="mb-2">
                <div class="row py-2 px-2 mx-1 rounded  hoverItemActive">
                    <a href="#" class="hoverTextActive nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M12 3H4a1 1 0 0 0-1 1v2.5H2V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2.5h-1V4a1 1 0 0 0-1-1zM2 9.5h1V12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V9.5h1V12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9.5zm-1.5-2a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H.5z"/>
                        </svg>
                    </span>
                        <span class="sidebar-text ps-2">Polisa</span>
                    </a>
                </div>
            </div>
            <div class="mb-2">
                <div class="row py-2 px-2 mx-1 rounded  hoverItem">
                    <a href="{{route('settings.categories.index')}}" class="hoverText nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z"/>
                            <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/>                        </svg>
                    </span>
                        <span class="sidebar-text ps-2">Kategorije</span>
                    </a>
                </div>
            </div>
            <div class="mb-2">
                <div class="row py-2 px-2 mx-1 rounded  hoverItem">
                    <a href="{{route('settings.genres.index')}}" class="hoverText nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>                        </svg>
                    </span>
                        <span class="sidebar-text ps-2">Žanrovi</span>
                    </a>
                </div>
            </div>
            <div class="mb-2">
                <div class="row py-2 px-2 mx-1 rounded  hoverItem">
                    <a href="{{route('settings.publishers.index')}}" class="hoverText nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                             <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>                        </svg>
                        </span>
                        <span class="sidebar-text ps-2">Izdavači</span>
                    </a>
                </div>
            </div>
            <div class="mb-2">
                <div class="row py-2 px-2 mx-1 rounded  hoverItem">
                    <a href="{{route('settings.covers.index')}}" class="hoverText nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
                             <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>                        </svg>
                    </span>
                        <span class="sidebar-text ps-2">Povezi</span>
                    </a>
                </div>
            </div>
            <div class="mb-2">
                <div class="row py-2 px-2 mx-1 rounded  hoverItem">
                    <a href="{{route('settings.formats.index')}}" class="hoverText nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zM0 2a2 2 0 0 1 3.937-.5h8.126A2 2 0 1 1 14.5 3.937v8.126a2 2 0 1 1-2.437 2.437H3.937A2 2 0 1 1 1.5 12.063V3.937A2 2 0 0 1 0 2zm2.5 1.937v8.126c.703.18 1.256.734 1.437 1.437h8.126a2.004 2.004 0 0 1 1.437-1.437V3.937A2.004 2.004 0 0 1 12.063 2.5H3.937A2.004 2.004 0 0 1 2.5 3.937zM14 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zM2 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm12 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg>
                    </span>
                        <span class="sidebar-text ps-2">Formati</span>
                    </a>
                </div>
            </div>
            <div class="mb-2">
                <div class="row py-2 px-2 mx-1 rounded  hoverItem">
                    <a href="{{route('settings.scripts.index')}}" class="hoverText nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="m2.244 13.081.943-2.803H6.66l.944 2.803H8.86L5.54 3.75H4.322L1 13.081h1.244zm2.7-7.923L6.34 9.314H3.51l1.4-4.156h.034zm9.146 7.027h.035v.896h1.128V8.125c0-1.51-1.114-2.345-2.646-2.345-1.736 0-2.59.916-2.666 2.174h1.108c.068-.718.595-1.19 1.517-1.19.971 0 1.518.52 1.518 1.464v.731H12.19c-1.647.007-2.522.8-2.522 2.058 0 1.319.957 2.18 2.345 2.18 1.06 0 1.716-.43 2.078-1.011zm-1.763.035c-.752 0-1.456-.397-1.456-1.244 0-.65.424-1.115 1.408-1.115h1.805v.834c0 .896-.752 1.525-1.757 1.525z"/>
                        </svg>
                    </span>
                        <span class="sidebar-text ps-2">Pisma</span>
                    </a>
                </div>
            </div>
            <div class="mb-2">
                <div class="row py-2 px-2 mx-1 rounded  hoverItem">
                    <a href="{{route('settings.languages.index')}}" class="hoverText nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286H4.545zm1.634-.736L5.5 3.956h-.049l-.679 2.022H6.18z"/>
                         <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2zm7.138 9.995c.193.301.402.583.63.846-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6.066 6.066 0 0 1-.415-.492 1.988 1.988 0 0 1-.94.31z"/>                        </svg>
                    </span>
                        <span class="sidebar-text ps-2">Jezici</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row bg-white py-2 px-2 mx-1 rounded">
                <div class="bg-white">
                    <div class="col">
                        <form id="reservationDeadlineForm" action="{{ route('settings.policies.update', $policies[1]->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="form-label" for="value">Rok Rezervacije</label>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores error illum, inventore itaque nemo neque, numquam omnis placeat porro quam quasi quidem veritatis. Consequuntur deleniti enim facere labore vel voluptates.</p>
                                    <input type="hidden" id="reservationPolicyId" value="{{$policies[1]->id}}">
                                </div>
                                <div class="col-md-2">
                                    <div class="pt-3">
                                        <div class="input-group">
                                            <input class="form-control" name="value{{$policies[1]->id}}" id="reservationDeadline" type="number" min="1" max="100" value="{{ old("value{$policies[1]->id}", $policies[1]->value) }}"/>
                                            <span class="input-group-text">dana</span>
                                        </div>
                                    </div>
                                    <p class="mt-5" style="color:red; display: none;" id="reservationErrorMessageByJs"></p>
                                    <p class="mt-5" style="color:green; display: none;" id="reservationSuccessMessageByJs"></p>
                                    <div id="reservationMessageByJs"></div>
                                </div>
                            </div>
                        </form>
                        <li role="separator" class="dropdown-divider mt-2 mb-3 border-gray-200"></li>
                        <form id="returnDeadlineForm" action="{{ route('settings.policies.update', $policies[0]->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="form-label" for="value">Rok vraćanja</label>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores error illum, inventore itaque nemo neque, numquam omnis placeat porro quam quasi quidem veritatis. Consequuntur deleniti enim facere labore vel voluptates.</p>
                                    <input type="hidden" id="returnPolicyId" value="{{$policies[0]->id}}"></div>
                                <div class="col-md-2">
                                    <div class="pt-3">
                                        <div class="input-group">
                                            <input class="form-control" id="returnDeadline" name="value{{$policies[0]->id}}" type="number" min="1" max="100" value="{{ old("value{$policies[0]->id}", $policies[0]->value) }}"/>
                                            <span class="input-group-text">dana</span>
                                        </div>
                                    </div>
                                    <div id="returnMessageByJs"></div>
                                </div>
                            </div>
                        </form>
                        <li role="separator" class="dropdown-divider mt-2 mb-3 border-gray-200"></li>
                        <form id="conflictDeadlineForm" action="{{ route('settings.policies.update', $policies[2]->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="form-label" for="value">Rok konflikta</label>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores error illum, inventore itaque nemo neque, numquam omnis placeat porro quam quasi quidem veritatis. Consequuntur deleniti enim facere labore vel voluptates.</p>
                                    <input type="hidden" id="conflictPolicyId" value="{{$policies[2]->id}}">
                                </div>
                                <div class="col-md-2">
                                    <div class="pt-3">
                                        <div class="input-group">
                                            <input class="form-control" id="conflictDeadline" name="value{{$policies[2]->id}}" type="number" min="1" max="100" value="{{ old("value{$policies[2]->id}", $policies[2]->value) }}"/>
                                            <span class="input-group-text">dana</span>
                                        </div>
                                    </div>
                                    @error("value{$policies[2]->id}")
                                    <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                    @enderror
                                    <div id="conflictMessageByJs"></div>
                                </div>
                            </div>
                        </form>
                        <li role="separator" class="dropdown-divider mt-2 mb-3 border-gray-200"></li>
                        <form id="maxBooksPerUserForm"
                              action="{{ route('settings.policies.update', $policies[3]->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="form-label" for="value">Broj aktivnih knjiga po učeniku</label>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores error illum, inventore itaque nemo neque, numquam omnis placeat porro quam quasi quidem veritatis. Consequuntur deleniti enim facere labore vel voluptates.</p>
                                    <input type="hidden" id="maxBooksPerUserPolicyId" value="{{ $policies[3]->id }}">
                                </div>
                                <div class="col-md-2">
                                    <div class="pt-3">
                                        <div class="input-group">
                                            <input class="form-control" id="maxBooksPerUser"
                                                   name="value{{ $policies[3]->id }}" type="number" min="1" max="5"
                                                   value="{{ old("value{$policies[3]->id}", $policies[3]->value) }}"/>
                                            <span class="input-group-text">knjiga</span>
                                        </div>
                                    </div>
                                    @error("value{$policies[3]->id}")
                                    <p style="color:red;" id="errorMessageByLaravel"><i
                                            class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                    @enderror
                                    <div id="maxBooksPerUserMessageByJs"></div>
                                </div>
                            </div>
                        </form>
                        <li role="separator" class="dropdown-divider mt-2 mb-3 border-gray-200"></li>
                        <form id="multipleBookCopiesPerUserForm"
                              action="{{ route('settings.policies.update', $policies[4]->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="form-label" for="value">Više <b>istih</b> knjiga po korisniku</label>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores error illum, inventore itaque nemo neque, numquam omnis placeat porro quam quasi quidem veritatis. Consequuntur deleniti enim facere labore vel voluptates.</p>
                                    <input type="hidden" id="multipleBookCopiesPerUserPolicyId" value="{{ $policies[4]->id }}">
                                </div>
                                <div class="col-md-2">
                                    <div class="pt-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" value="{{ old('value' . $policies[4]->id, $policies[4]->value) }}"
                                                   id="multipleBookCopiesPerUser" name="value{{ $policies[4]->id }}" type="checkbox" role="switch" @if ($policies[4]->value === 2) checked @endif>
                                        </div>
                                    </div>
                                    @error("value{$policies[4]->id}")
                                    <p style="color:red;" id="errorMessageByLaravel"><i
                                            class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                    @enderror
                                    <div id="multipleBookCopiesPerUserMessageByJs"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
