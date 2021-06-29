<x-guest-layout>
    <div class="container" style="display:flex; justify-content:center;">
        <div class="row" style=" width: 100%; margin-top: 50px; margin-left:120px ;">
            <div class="col-md-offset-2">
                <div class="panel panel-default">
                   Enter the pin from Google Authenticator app:<br/><br/>

                    @if($errors->any())
                    <span style="color:red">{{$errors->first()}}</span>
                    @endif
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('verify2fa') }}">
                            @csrf

                            <div class="form-group">
                                <label for="one_time_password" class="col-md-4 control-label">One Time Password</label>

                                <div class="col-md-6">
                                    <input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top:20px">
                                <div class="col-md-6 col-md-offset-4">
                                    <x-button>
                                        Login
                                    </x-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>