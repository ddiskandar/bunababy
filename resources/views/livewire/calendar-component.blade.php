<!-- Calendars: Week View -->
<div class="flex flex-col">
    <!-- Header -->
    <div
      class="grid flex-none grid-cols-1 items-center gap-2 pb-3 sm:grid-cols-2"
    >
      <h2 class="text-center text-2xl font-bold sm:text-left">July 2025</h2>
      <div class="flex items-center justify-center gap-2 sm:justify-end">
        <div class="inline-flex">
          <button
            type="button"
            class="inline-flex items-center justify-center gap-2 rounded-l-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold leading-5 text-gray-800 hover:z-1 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:z-1 focus:ring focus:ring-gray-300/25 active:z-1 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              class="hi-mini hi-chevron-left -mx-1 inline-block size-5"
            >
              <path
                fill-rule="evenodd"
                d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                clip-rule="evenodd"
              />
            </svg>
            <span class="sr-only">Previous Month</span>
          </button>
          <button
            type="button"
            class="-ml-px inline-flex items-center justify-center gap-2 rounded-r-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold leading-5 text-gray-800 hover:z-1 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:z-1 focus:ring focus:ring-gray-300/25 active:z-1 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              class="hi-mini hi-chevron-right -mx-1 inline-block size-5"
            >
              <path
                fill-rule="evenodd"
                d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                clip-rule="evenodd"
              />
            </svg>
            <span class="sr-only">Next Month</span>
          </button>
        </div>
        <button
          type="button"
          class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-semibold leading-5 text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:ring focus:ring-gray-300/25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-900/50 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700"
        >
          <span>Today</span>
        </button>
        <div class="inline-flex">
          <button
            type="button"
            class="inline-flex items-center justify-center gap-2 rounded-l-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold leading-5 text-gray-800 hover:z-1 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:z-1 focus:ring focus:ring-gray-300/25 active:z-1 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700"
          >
            <span class="hidden xl:inline">Month</span>
            <span class="xl:hidden">M</span>
          </button>
          <button
            type="button"
            class="-ml-px inline-flex items-center justify-center gap-2 border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-semibold leading-5 text-gray-800 hover:z-1 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:z-1 focus:ring focus:ring-gray-300/25 active:z-1 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-900/50 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700"
          >
            <span class="hidden xl:inline">Week</span>
            <span class="xl:hidden">W</span>
          </button>
          <button
            type="button"
            class="-ml-px inline-flex items-center justify-center gap-2 rounded-r-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold leading-5 text-gray-800 hover:z-1 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:z-1 focus:ring focus:ring-gray-300/25 active:z-1 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700"
          >
            <span class="hidden xl:inline">Day</span>
            <span class="xl:hidden">D</span>
          </button>
        </div>
      </div>
    </div>
    <!-- END Header -->

    <div class="relative h-[44rem] overflow-y-auto">
      <!-- Days -->
      <div
        class="sticky top-0 z-10 flex gap-px overflow-hidden rounded-t-lg border border-gray-200 bg-gray-200 text-sm dark:border-gray-700 dark:bg-gray-700"
      >
        <div
          class="flex w-14 flex-none flex-col gap-px text-right text-gray-500 sm:w-20 dark:text-gray-400"
        >
          <div class="h-16 flex-none bg-white dark:bg-gray-800"></div>
          <div
            class="flex grow items-center justify-end bg-white p-1 dark:bg-gray-800"
          >
            All day
          </div>
        </div>
        <div class="grid grow grid-cols-7 grid-rows-[4rem_1fr] gap-px">
          <div
            class="flex items-center justify-center bg-white p-2 text-center font-medium dark:bg-gray-800"
          >
            <div>
              <span class="hidden text-gray-500 xl:inline dark:text-gray-400"
                >Monday</span
              >
              <span class="text-gray-500 xl:hidden dark:text-gray-400">Mon</span>
              <div class="text-base font-semibold">7</div>
            </div>
          </div>
          <div
            class="flex items-center justify-center bg-white p-2 text-center font-medium dark:bg-gray-800"
          >
            <div>
              <span class="hidden text-gray-500 xl:inline dark:text-gray-400"
                >Tuesday</span
              >
              <span class="text-gray-500 xl:hidden dark:text-gray-400">Tue</span>
              <div class="text-base font-semibold">8</div>
            </div>
          </div>
          <div
            class="flex items-center justify-center bg-white p-2 text-center font-medium dark:bg-gray-800"
          >
            <div>
              <span class="hidden text-gray-500 xl:inline dark:text-gray-400"
                >Wednesday</span
              >
              <span class="text-gray-500 xl:hidden dark:text-gray-400">Wed</span>
              <div class="text-base font-semibold">9</div>
            </div>
          </div>
          <div
            class="flex items-center justify-center bg-blue-50 p-2 text-center font-medium dark:bg-blue-950"
          >
            <div>
              <span class="hidden text-gray-500 xl:inline dark:text-gray-400"
                >Thursday</span
              >
              <span class="text-gray-500 xl:hidden dark:text-gray-400">Thu</span>
              <div
                class="text-base font-semibold text-blue-700 dark:text-blue-400"
              >
                10
              </div>
            </div>
          </div>
          <div
            class="flex items-center justify-center bg-white p-2 text-center font-medium dark:bg-gray-800"
          >
            <div>
              <span class="hidden text-gray-500 xl:inline dark:text-gray-400"
                >Friday</span
              >
              <span class="text-gray-500 xl:hidden dark:text-gray-400">Fri</span>
              <div class="text-base font-semibold">11</div>
            </div>
          </div>
          <div
            class="flex items-center justify-center bg-white p-2 text-center font-medium dark:bg-gray-800"
          >
            <div>
              <span class="hidden text-gray-500 xl:inline dark:text-gray-400"
                >Saturday</span
              >
              <span class="text-gray-500 xl:hidden dark:text-gray-400">Sat</span>
              <div class="text-base font-semibold">12</div>
            </div>
          </div>
          <div
            class="flex items-center justify-center bg-white p-2 text-center font-medium dark:bg-gray-800"
          >
            <div>
              <span class="hidden text-gray-500 xl:inline dark:text-gray-400"
                >Sunday</span
              >
              <span class="text-gray-500 xl:hidden dark:text-gray-400">Sun</span>
              <div class="text-base font-semibold">13</div>
            </div>
          </div>
          <div class="bg-white px-2 py-2.5 text-xs dark:bg-gray-800"></div>
          <div class="bg-white px-2 py-2.5 text-xs dark:bg-gray-800"></div>
          <div class="bg-white px-2 py-2.5 text-xs dark:bg-gray-800"></div>
          <div class="bg-white px-2 py-2.5 text-xs dark:bg-gray-800">
            <ol
              class="flex flex-wrap gap-0.5 lg:flex-col lg:flex-nowrap lg:gap-1"
            >
              <li>
                <a
                  href="javascript:void(0)"
                  class="flex size-2.5 items-center rounded-full bg-blue-700 text-white hover:bg-blue-600 active:opacity-75 lg:size-auto lg:rounded lg:px-2 lg:py-0.5"
                >
                  <span class="hidden truncate font-medium lg:inline-block"
                    >Hike Adventure</span
                  >
                </a>
              </li>
              <li>
                <a
                  href="javascript:void(0)"
                  class="flex size-2.5 items-center rounded-full bg-emerald-700 text-white hover:bg-emerald-600 active:opacity-75 lg:size-auto lg:rounded lg:px-1.5 lg:py-0.5"
                >
                  <span class="hidden truncate font-medium lg:inline-block"
                    >Day off</span
                  >
                </a>
              </li>
            </ol>
          </div>
          <div class="bg-white px-2 py-2.5 text-xs dark:bg-gray-800"></div>
          <div class="bg-white px-2 py-2.5 text-xs dark:bg-gray-800"></div>
          <div class="bg-white px-2 py-2.5 text-xs dark:bg-gray-800">
            <ol
              class="flex flex-wrap gap-0.5 lg:flex-col lg:flex-nowrap lg:gap-1"
            >
              <li>
                <a
                  href="javascript:void(0)"
                  class="flex size-2.5 items-center rounded-full bg-orange-700 text-white hover:bg-orange-600 active:opacity-75 lg:size-auto lg:rounded lg:px-1.5 lg:py-0.5"
                >
                  <span class="hidden truncate font-medium lg:inline-block"
                    >Side project X</span
                  >
                </a>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- END Days -->

      <!-- Event slots -->
      <div
        class="flex gap-px overflow-hidden rounded-b-lg border border-gray-200 bg-gray-200 text-xs dark:border-gray-700 dark:bg-gray-700"
      >
        <div
          class="flex w-14 flex-none flex-col gap-px text-right text-gray-500 sm:w-20 dark:text-gray-400 [&>*]:h-8"
        >
          <div class="bg-white p-1 text-right dark:bg-gray-800">00:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">01:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">02:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">03:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">04:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">05:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">06:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">07:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">08:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">09:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">10:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">11:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">12:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">13:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">14:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">15:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">16:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">17:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">18:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">19:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">20:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">21:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">22:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
          <div class="bg-white p-1 text-right dark:bg-gray-800">23:00</div>
          <div class="bg-white p-1 text-right dark:bg-gray-800"></div>
        </div>
        <div
          class="grid flex-none grow grid-cols-7 gap-px [&>*]:relative [&>*]:h-8"
        >
          <!-- 00:00 - 00:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 00:30 - 01:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 01:00 - 01:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800">
            <!--
              Overlaying an event on multiple time slots just requires to specify a height

              Notes:
              - Each 30 minute slot is 32px in height (h-8 class)
              - With each additional 30 minute slot we add, there is an 1px border between slots

              Calculating the height of an event:

              (number of 30 minute slots the event has) * 32px + (number of 30 minute slots the event has - 1) * 1px

              Example:

              01:00-04:00 - (6 x 30 minute slot)

              6 * 32px + 5 * 1px = 197px
            -->
            <div
              class="absolute left-0 right-0 top-0 z-[1] flex min-h-8 flex-col p-1"
              style="height: 197px"
            >
              <a
                href="javascript:void(0)"
                class="grow overflow-hidden rounded bg-blue-700 text-white hover:bg-blue-600 active:opacity-75 lg:px-1.5 lg:py-1"
              >
                <span class="hidden opacity-90 lg:inline">01:00-04:00</span>
                <span class="hidden font-medium lg:block"
                  >Overnight Flight EG2525</span
                >
              </a>
            </div>
          </div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 01:30 - 02:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 02:00 - 02:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 02:30 - 03:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 03:00 - 03:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 03:30 - 04:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 04:00 - 04:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 04:30 - 05:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 05:00 - 05:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800">
            <!--
              Overlaying an event on multiple time slots just requires to specify a height

              Notes:
              - Each 30 minute slot is 32px in height (h-8 class)
              - With each additional 30 minute slot we add, there is an 1px border between slots

              Calculating the height of an event:

              (number of 30 minute slots the event has) * 32px + (number of 30 minute slots the event has - 1) * 1px

              Example:

              05:00-06:30 - (3 x 30 minute slot)

              3 * 32px + 2 * 1px = 98px
            -->
            <div
              class="absolute left-0 right-0 top-0 z-[1] flex min-h-8 flex-col p-1"
              style="height: 98px"
            >
              <a
                href="javascript:void(0)"
                class="grow overflow-hidden rounded bg-blue-700 text-white hover:bg-blue-600 active:opacity-75 lg:px-1.5 lg:py-1"
              >
                <span class="hidden opacity-90 lg:inline">05:00-06:30</span>
                <span class="hidden font-medium lg:block">Morning walk</span>
              </a>
            </div>
          </div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 05:30 - 06:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 06:00 - 06:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800">
            <!--
              Overlaying an event on multiple time slots just requires to specify a height

              Notes:
              - Each 30 minute slot is 32px in height (h-8 class)
              - With each additional 30 minute slot we add, there is an 1px border between slots

              Calculating the height of an event:

              (number of 30 minute slots the event has) * 32px + (number of 30 minute slots the event has - 1) * 1px

              Example:

              06:00-07:00 - (2 x 30 minute slot)

              2 * 32px + 1 * 1px = 65px
            -->
            <div
              class="absolute left-0 right-0 top-0 z-[1] flex min-h-8 flex-col p-1"
              style="height: 65px"
            >
              <a
                href="javascript:void(0)"
                class="grow overflow-hidden rounded bg-rose-700 text-white hover:bg-rose-600 active:opacity-75 lg:px-1.5 lg:py-1"
              >
                <span class="hidden opacity-90 lg:inline">06:00-07:00</span>
                <span class="hidden font-medium lg:block">Online meeting</span>
              </a>
            </div>
          </div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 06:30 - 07:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 07:00 - 07:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 07:30 - 08:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 08:00 - 08:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 08:30 - 09:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 09:00 - 09:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 09:30 - 10:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 10:00 - 10:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 10:30 - 11:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 11:00 - 11:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 11:30 - 12:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 12:00 - 12:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 12:30 - 13:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 13:00 - 13:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 13:30 - 14:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 14:00 - 14:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 14:30 - 15:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 15:00 - 15:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 15:30 - 16:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 16:00 - 16:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 16:30 - 17:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 17:00 - 17:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 17:30 - 18:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 18:00 - 18:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 18:30 - 19:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 19:00 - 19:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 19:30 - 20:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 20:00 - 20:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 20:30 - 21:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 21:00 - 21:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 21:30 - 22:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 22:00 - 22:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 22:30 - 23:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 23:00 - 23:30 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>

          <!-- 23:30 - 00:00 -->
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
          <div class="bg-white dark:bg-gray-800"></div>
        </div>
      </div>
      <!-- END Event slots -->
    </div>
  </div>
  <!-- END Calendars: Week View -->
