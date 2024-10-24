<div class="relative hidden z-10" id="redirect-modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0"
  -->
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
      <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
        <h2 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Weiterleitung</h2>
          <div class="grid grid-cols-1 md:flex md:items-start">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                <input type="hidden" name="url" id="url" value="">
                <div class="grid mb-2 md:mb-0 md:flex gap-4 md:gap-2">
                  @include('private.modals.parts.floating-label-input', ['id' => 'name', 'name' => 'name', 'label' => 'Name'])
                  @include('private.modals.parts.floating-label-input', ['id' => 'target', 'name' => 'target', 'label' => 'Target Url'])
                  <select name="code" id="code" class="rounded w-full md:w-auto">
                    <option value="301">301</option>
                    <option value="302">302</option>
                    <option value="303">303</option>
                    <option value="304">304</option>
                    <option value="305">305</option>
                    <option value="306">306</option>
                    <option value="307">307</option>
                    <option value="308">308</option>
                  </select>
                </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
          <button type="button" id="close-copy" class=" bg-gradient-to-br from-rose-700 via-purple-700 to-gray-500 hover:to-gray-500 hover:via-purple-700 hover:from-gray-500 text-white     mt-3 inline-flex w-full justify-center rounded-md bg-green-300 px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:ml-3">Schließen und URL Kopieren</button>
          <button type="button" id="close" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Schließen</button>
        </div>
      </div>
    </div>
  </div>
</div>

