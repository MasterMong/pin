<div class="toast-wrapper" data-controller="toast">
    <template id="toast">
        <div class="toast rounded shadow-sm bg-white mb-3"
             role="alert"
             aria-live="assertive"
             aria-atomic="true"
             data-bs-delay="5000"
             data-bs-autohide="true">
            <div class="toast-body p-3 d-flex">
                <p class="mb-0">
                    <span class="text-{type}">
                        <x-orchid-icon path="bs.circle-fill" class="me-2"/>
                    </span>
                    {message}
                </p>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </template>


    @if (session()->has(\Orchid\Alert\Toast::SESSION_MESSAGE))
        
    <div class="toaster position-fixed bottom-0 end-0 p-3" style="z-index: 5">
        <div class="toast show" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <svg class="docs-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
              <rect width="100%" height="100%" fill="#007aff"></rect>
            </svg><strong class="me-auto">Bootstrap</strong><small>11 mins ago</small>
            <button class="btn-close" type="button" data-coreui-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">{!! session(\Orchid\Alert\Toast::SESSION_MESSAGE) !!}</div>
        </div>
    </div>
    @endif

</div>
