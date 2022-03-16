                {{--
                =======================================
                 # ok_message
                 / color : success
                =======================================
                --}}
                @if ( session('ok_message') )
                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill h3 mb-0 me-3"></i>
                    {{ session('ok_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif


                {{--
                =======================================
                 # err_message
                 / color : danger
                =======================================
                --}}
                @if ( session('err_message') )
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill h3 mb-0 me-3"></i>                    <div>
                    {{ session('err_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
