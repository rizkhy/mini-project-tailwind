<section>
    <div class="px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
        <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 sm:grid-cols-2 dark:text-white">
            <div class="card bg-gray-200 dark:bg-gray-700 rounded-lg p-10">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $user }}</dt>
                    <dd class="font-normal text-gray-500 dark:text-gray-400">User</dd>
                </div>
            </div>
            <div class="card bg-gray-200 dark:bg-gray-700 rounded-lg p-10">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $reimbursement }}</dt>
                    <dd class="font-normal text-gray-500 dark:text-gray-400">Reimbursement</dd>
                </div>
            </div>
        </dl>
    </div>
</section>
