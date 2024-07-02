<div class="relative hidden z-10" id="share-modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
          <div class="sm:flex sm:items-start">
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left flex flex-col gap-y-3">
              <h2 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Notiz teilen</h2>

                <div class="flex items-center ml-0 gap-x-3 border-solid border p-2 rounded mt-1" style="border-color: #6b7280;">
                    <label>Passwort?</label>
                    <label class="relative inline-flex cursor-pointer items-center">
                        <input id="enable-password" type="checkbox" class="peer sr-only" value="1" />
                        <label for="enable-password" class="hidden"></label>
                        <div class="peer h-4 w-11 rounded-full border bg-slate-200 after:absolute after:-top-1 after:left-0 after:h-6 after:w-6 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-green-300 peer-checked:after:translate-x-full peer-focus:ring-green-300"></div>
                    </label>
                </div>
                <input type="text" name="password" id="password" class="rounded border-blue-gray-200 w-full md:w-auto" />
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
