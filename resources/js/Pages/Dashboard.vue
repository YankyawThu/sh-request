<template>
    <app-layout>
        <div class="border-b ml-3 text-xs" style="line-height:0.1em;">
            <span class="bg-gray-50 px-2">Status</span>
        </div>
        <div class="border flex flex-wrap justify-around bg-gray-100 pt-3 mb-3">
            <div :class="countStyle">
                <inertia-link href="/live" :class="linkStyle"><i class="fas fa-circle text-green-500 mr-2"></i>Live : {{$page.stateCount[0]}}</inertia-link>
            </div>
            <div :class="countStyle">
                <inertia-link href="/" :class="linkStyle"><i class="fas fa-circle text-yellow-500 mr-2"></i>Upcoming : {{$page.stateCount[1]}}</inertia-link>
            </div>
            <div :class="countStyle">
                <inertia-link href="/end" :class="linkStyle"><i class="fas fa-circle text-red-500 mr-2"></i>End : {{$page.stateCount[2]}}</inertia-link>
            </div>
        </div>
        <div class="border-b ml-3 text-xs" style="line-height:0.1em;">
            <span class="bg-gray-50 px-2">Content</span>
        </div>
        <div class="border pt-3">
            <slot></slot>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome
        },
        data() {
            return {
                th: 'text-center py-2 text-gray-300',
                td: 'text-center py-2',
                countStyle: 'bg-white border-2 border-green-500 transform hover:scale-110 duration-300 motion-reduce:transform-none w-80 rounded-lg text-md font-bold text-center mb-3 md:w-52',
                linkStyle: 'w-full block py-3'
            }
        },
    }
</script>
