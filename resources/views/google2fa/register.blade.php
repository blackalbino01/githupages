<x-guest-layout>
    <div class="container" style="display: flex; justify-content:center; margin-top: 40px;">
        <div class="row" style="display:flex; justify-content: center;">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading " style="text-align:center;">Set up Google Authenticator</div>

                    <div class="panel-body" style="text-align: center;">
                        <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use the code {{ $secret }}</p>
                        <div style="display: flex; justify-content: center;">
                            <img src="{{ $QR_Image }}">
                        </div>
                        <p>You must set up your Google Authenticator app before continuing. You will be unable to login otherwise</p>
                        <div>
                            <a href="{{ route('postRegister') }}"><x-button>Complete Registration</x-button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>