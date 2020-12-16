<div>
    <div class="container max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <div class="my-3 w-1/2">

            @if($saveDealSuccess === 'success')
                <div class="rounded-md bg-green-100 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800">Deal created successfully</h3>
                        </div>
                    </div>
                </div>
            @elseif($saveDealSuccess === 'fail')
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">An error occurred while creating the deal</h3>
                </div>
            @endif
            @if($saveTaskSuccess === 'success')
                <div class="rounded-md bg-green-100 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800">Task created successfully</h3>
                        </div>
                    </div>
                </div>
            @elseif($saveTaskSuccess === 'fail')
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">An error occurred while creating the task</h3>
                </div>
            @endif

            <div class="sm:col-span-6">

                <div class="mt-1">
                    <input id="name" wire:model="deal.name" name="name"
                           placeholder="deal name"
                           class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base dealing-normal transition duration-150 ease-in-out sm:text-sm sm:dealing-5"
                    >
                    @error('deal.name') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mt-1">
                    <input id="task_subject" wire:model="deal.task_subject" name="task_subject"
                           placeholder="task subject"
                           class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base dealing-normal transition duration-150 ease-in-out sm:text-sm sm:dealing-5"
                    >
                    @error('deal.task_subject') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div wire:click="saveDeal"
                 class="inline-flex
                 mt-3
                 justify-center px-4 py-2
                 text-sm font-medium dealing-5
                 text-white transition duration-150 ease-in-out bg-indigo-500 border border-transparent rounded-md hover:bg-indigo-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 cursor-pointer">
                Create
            </div>
        </div>
    </div>
</div>
