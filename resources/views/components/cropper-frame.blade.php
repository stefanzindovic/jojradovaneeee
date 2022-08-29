<div style="width: 100vw; height: 100vh" class="bg-black bg-opacity-80 absolute z-50 hidden" id="cropperFrame">
    <div class="bg-white shadow-lg rounded-md px-[10px] py-[7px] w-[45%] mx-auto mt-[100px] relative">
        <h1 class="mb-[20px]">Prilagodite fotografiju</h1>
        <div class="flex justify-center">
            <img id="cropper-placeholder" style="width: 40%; aspect-ratio: 1/1;" src="{{asset('imgs/profile-picture-placeholder.jpg')}}" alt="Odabran slika nije ucitana. Pokušajte ponovo.">
        </div>
        <div class="relative mt-[50px] right-0 bottom-0 w-full">
            <div class="flex flex-row">
                <div class="inline-block w-full text-white text-right py-[7px]">
                    <button type="button" id="canelCropperBtn"
                            class="btn-animation shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                         <i class="fas fa-times ml-[4px]"></i>
                    </button>
                    <button id="confirmCropBtn" type="button"
                            class="btn-animation shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]"
                    >
                         <i class="fas fa-check ml-[4px]"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
