@extends('app')

@section('page_title')
    Podešavanja polisa
@endsection

@section('page_content')
    <section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
        <!-- Heading of content -->
        <x-settings-header></x-settings-header>

        <div class="height-ucenikProfile pb-[30px] scroll">
            <!-- Space for content -->
            <div class="section- mt-[20px]">
                <div class="flex flex-col">
                    <div class="pl-[30px] flex border-b-[1px] border-[#e4dfdf]  pb-[20px]">
                        <div>
                            <h3>
                                Rok za rezervaciju
                            </h3>
                            <p class="pt-[15px] max-w-[400px]">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum eligendi nihil, vel
                                necessitatibus saepe laboriosam! Perspiciatis laboriosam culpa veritatis ea
                                voluptatum commodi tempora unde, dolorum debitis quia id dicta vitae.
                            </p>
                        </div>
                        <div class="relative flex ml-[60px] mt-[20px]">
                            <form id="reservationDeadlineForm"
                                action="{{ route('settings.policies.update', $policies[1]->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" id="reservationPolicyId" value="{{ $policies[1]->id }}">
                                <input style="min-width: 250px; max-width: 250px;" name="value{{ $policies[1]->id }}"
                                    id="reservationDeadline" type="number" min="1" max="100"
                                    value="{{ old("value{$policies[1]->id}", $policies[1]->value) }}"
                                    class="policyInput h-[50px] flex-1 w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 bg-white border-[1px]  border-[#e4dfdf] rounded-lg shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                                    placeholder="..." required />
                                @error("value{$policies[1]->id}")
                                    <p style="color:red;" id="errorMessageByLaravel"><i
                                            class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                                <p class="mt-[10px]" style="color:red; display: none;" id="reservationErrorMessageByJs"></p>
                                <p class="mt-[10px]" style="color:green; display: none;" id="reservationSuccessMessageByJs">
                                </p>
                                <div id="reservationMessageByJs"></div>


                            </form>
                            <p class="ml-[10px] mt-[10px]">dana</p>
                        </div>
                    </div>
                    <div class="pl-[30px] flex border-b-[1px] border-[#e4dfdf]  py-[20px]">
                        <div>
                            <h3>
                                Rok vracanja
                            </h3>
                            <p class="pt-[15px] max-w-[400px]">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum eligendi nihil, vel
                                necessitatibus saepe laboriosam! Perspiciatis laboriosam culpa veritatis ea
                                voluptatum commodi tempora unde, dolorum debitis quia id dicta vitae.
                            </p>
                        </div>
                        <div class="relative flex ml-[60px] mt-[20px]">
                            <form id="returnDeadlineForm" action="{{ route('settings.policies.update', $policies[0]->id) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" id="returnPolicyId" value="{{ $policies[0]->id }}">
                                <input id="returnDeadline" style="min-width: 250px; max-width: 250px;"
                                    name="value{{ $policies[0]->id }}" type="number" min="1" max="100"
                                    value="{{ old("value{$policies[0]->id}", $policies[0]->value) }}"
                                    class="policyInput h-[50px] flex-1 w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 bg-white border-[1px]  border-[#e4dfdf]  rounded-lg shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                                    placeholder="..." required />
                                @error("value{$policies[0]->id}")
                                    <p style="color:red;" id="errorMessageByLaravel"><i
                                            class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                                <div id="returnMessageByJs"></div>
                            </form>
                            <p class="ml-[10px] mt-[10px]">dana</p>
                        </div>
                    </div>
                    <div class="pl-[30px] flex border-b-[1px] border-[#e4dfdf]  py-[20px]">
                        <div>
                            <h3>
                                Rok konflikta
                            </h3>
                            <p class="pt-[15px] max-w-[400px]">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum eligendi nihil, vel
                                necessitatibus saepe laboriosam! Perspiciatis laboriosam culpa veritatis ea
                                voluptatum commodi tempora unde, dolorum debitis quia id dicta vitae.
                            </p>
                        </div>
                        <div class="relative flex ml-[60px] mt-[20px]">
                            <form id="conflictDeadlineForm"
                                action="{{ route('settings.policies.update', $policies[2]->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" id="conflictPolicyId" value="{{ $policies[2]->id }}">
                                <input id="conflictDeadline" style="min-width: 250px; max-width: 250px;"
                                    name="value{{ $policies[2]->id }}" type="number" min="1" max="100"
                                    value="{{ old("value{$policies[2]->id}", $policies[2]->value) }}"
                                    class="policyInput h-[50px] flex-1 w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 bg-white border-[1px]  border-[#e4dfdf]  rounded-lg shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                                    placeholder="..." />
                                @error("value{$policies[2]->id}")
                                    <p style="color:red;" id="errorMessageByLaravel"><i
                                            class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                                <div id="conflictMessageByJs"></div>
                            </form>
                            <p class="ml-[10px] mt-[10px]">dana</p>
                        </div>
                    </div>
                    <div class="pl-[30px] flex border-b-[1px] border-[#e4dfdf]  py-[20px]">
                        <div>
                            <h3>
                                Broj aktivnih knjiga po učeniku
                            </h3>
                            <p class="pt-[15px] max-w-[400px]">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum eligendi nihil, vel
                                necessitatibus saepe laboriosam! Perspiciatis laboriosam culpa veritatis ea
                                voluptatum commodi tempora unde, dolorum debitis quia id dicta vitae.
                            </p>
                        </div>
                        <div class="relative flex ml-[60px] mt-[20px]">
                            <form id="maxBooksPerUserForm"
                                action="{{ route('settings.policies.update', $policies[3]->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" id="maxBooksPerUserPolicyId" value="{{ $policies[3]->id }}">
                                <input id="maxBooksPerUser" style="min-width: 250px; max-width: 250px;"
                                    name="value{{ $policies[3]->id }}" type="number" min="1" max="5"
                                    value="{{ old("value{$policies[3]->id}", $policies[3]->value) }}"
                                    class="policyInput h-[50px] flex-1 w-full px-4 py-2 text-sm text-gray-700 placeholder-gray-400 bg-white border-[1px]  border-[#e4dfdf]  rounded-lg shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                                    placeholder="..." />
                                @error("value{$policies[3]->id}")
                                    <p style="color:red;" id="errorMessageByLaravel"><i
                                            class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                                <div id="maxBooksPerUserMessageByJs"></div>
                            </form>
                            <p class="ml-[10px] mt-[10px]">dana</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
