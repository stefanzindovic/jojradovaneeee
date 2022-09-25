<style>
    #cropper-wrapper {
        height: 100%;
        width: 100%;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        background: rgba(0, 0, 0, 0.85);
    }

    #cropper-frame {
        margin: 1.25rem auto;
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 1.25rem;

    }

    #cropper-image-frame {
        max-width: 80vw;
        max-height: 60vh;
    }

    #cropper-preview {
        width: 100%;
    }

    #cropper-image-frame {
        min-width: 25vw;
        min-height: 25vh;
    }

    #cropper-action-btns {
        margin-top: 1.25rem;
    }
</style>

<div id="cropper-wrapper" style="display: none;">
    <div id="cropper-frame" class="bg-white shadow-lg">
        <div id="cropper-image-frame">
            <img src="{{ asset('img/login.jpg') }}" alt="" id="cropper-preview">
        </div>

        <div id="cropper-action-btns" class="mx-2">
            <button id="cropper-cancle-btn" type="button" class="btn btn-danger">
                Otkaži
            </button>
            <button id="cropper-crop-btn" type="button"  class="btn btn-primary">
                Sačuvaj
            </button>
        </div>
    </div>
</div>
