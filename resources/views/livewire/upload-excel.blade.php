<div>
    <form wire:submit.prevent="save" class="flex items-center justify-between bg-grey-lighter">
        <div class="flex flex-col items-center bg-grey-lighter">
            <label class="flex items-center px-2 py-1 bg-white text-blue rounded-lg shadow-lg tracking-wide border border-blue cursor-pointer hover:bg-indigo-700 hover:text-white">
                <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                </svg>
                <span class="ml-2 text-base leading-normal">Seleccionar Archivo</span>
                <input type='file' wire:model="excel" class="hidden" />
            </label>
            <div class="text-sm text-gray-500">
                @error('excel') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <button type="submit" class="ml-2 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border rounded-md shadow-sm text-base font-medium text-blue bg-white">Enviar</button>

    </form>
</div>
