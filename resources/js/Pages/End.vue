<template>
    <Dashboard>
        <div class="flex flex-wrap justify-around mx-3">
            <div v-for="(data,index) in $page.end" :key="index" class="rounded shadow-md mb-3">
                <div class="bg-gray-700 text-white py-2 px-3 rounded-t">
                    <div class="inline pr-2"><i class="far fa-calendar-alt text-3xl"></i></div>
                    <div class="inline-block">
                        <div class="flex justify-between">
                            <div class="capitalize font-semibold">{{data.title}}</div>
                            
                        </div>
                        <div class="text-xs mt-1">{{data.meeting_date}} @ {{data.s_time}} - {{data.e_time}} | Room - {{data.room}} <i class="fas fa-video mx-2"></i></div>
                    </div>
                </div>
                <div class="flex justify-around py-3">
                    <div class="overflow-hidden text-center truncate w-32 mt-1 capitalize" :title="$page.end[index].host">{{data.host}}</div>
                    <div><i class="fas fa-volume-up mt-2"></i></div>
                    <div class="overflow-hidden text-center truncate w-32 mt-1 capitalize" :title="$page.end[index].join">{{data.join}}</div>
                </div>

                <div class="flex justify-between border-t py-2 px-3">
                    <!-- <div><i class="fas fa-circle text-yellow-500 mr-1"></i>Upcoming</div> -->
                    <div class="capitalize text-xs">@{{data.name}} | {{data.pos}}, {{data.dept}}</div>
                    <div class="">
                        <inertia-link :href="'view/'+($page.end[index].id).toString()"><i class="fas fa-share text-blue-500"></i></inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </Dashboard>
</template>

<script>
import Dashboard from './Dashboard'
export default {
    name: 'End',
    components: { Dashboard }
}
</script>